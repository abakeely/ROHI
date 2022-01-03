<?php

require_once __DIR__ . '../../src/bootstrap.php';


use TT\BaseController;
use TT\Entity\EvaluationApreciation;
use TT\Entity\Rohi\Candidat;
use TT\ModelAdapter;
use TT\Repository\CronRepository;
use TT\Repository\EvaluationRepository;
use TT\Entity\Evaluation as EvaluationEntity;

class Cron extends BaseController
{

    /**
     * @var string
     */
    protected $moduleName = 'evaluations';

    /**
     * @var EvaluationRepository;
     */
    protected $evaluationRepository;

    /**
     * @var CronRepository
     */
    protected $cronRepository;

    /**
     * @var float
     */
    private $arbitrary_note = 11.5;
    
    public function __construct()
    {
        global $oSmarty;
        parent::__construct($oSmarty);
        $this->evaluationRepository = new EvaluationRepository();
        $this->cronRepository = new CronRepository();
    }

    /**
     * @throws Exception
     */
    public function auto(){
        $transaction_model = ModelAdapter::transacrion($this);
        $current_trim  = $this->evaluationRepository->getCurrentTrimestre();
        if ( $this->last_day() and $current_trim ){
            $all_agent  = $this->get_all_agent();
            
            foreach ( $all_agent as $authority => $data ){
                if ( sizeof( $data['agents_a_evaluer'] ) and $authority == 11 ){
                    foreach ( $data['agents_a_evaluer'] as $agent_user_id ){
                        $agent  = (new Candidat($agent_user_id, 'user_id'))->get();
                        //exclure les matricules ECD et compagnies
                        
                        if ( (int)$agent->matricule ){
                            $note_auto_rohi = $this->arbitrary_note;
                            //current date
                            $date_start  = new \DateTime("now");
                            //note anterieur manuel
                            $last_note = $this->cronRepository->get_last_agent_note($agent_user_id);
                            //note assiduite en cours
                            $note_pointage_current  = $transaction_model->TempsDeTravailDunAgentAvecDenominateur(
                                $agent->matricule,
                                $date_start->format('Y-m-d')
                                , $date_start->modify('last day of')->format('Y-m-d')
                                , $den
                                , $this
                                , $date_start->format('Y')
                            );

                            //note assiduite anterieur
                            $note_pointage_prev  = $transaction_model->TempsDeTravailDunAgentAvecDenominateur(
                                $agent->matricule,
                                $date_start->modify('-1 month')->modify('first day of')->format('Y-m-d')
                                , $date_start->modify('-1 month')->format('Y-m-d')
                                , $den
                                , $this
                                , $date_start->format('Y')
                            );

                            //calcul note
                            if ( $last_note == 0 and $note_pointage_current == 0 ){
                                $note_auto_rohi = $this->arbitrary_note;
                            }
                            if ( $last_note > 0 and $note_pointage_current == 0 ){
                                $note_auto_rohi = $last_note;
                            }
                            if ( $last_note > 0 and $note_pointage_current > 0 and $note_pointage_prev > 0 ){
                                $note_auto_rohi = ($note_pointage_current * $last_note) / $note_pointage_prev;
                            }
                            if ( $last_note == 0 and $note_pointage_current > 0 ){
                                $note_auto_rohi = $note_pointage_current;
                            }
                            if ( $last_note > 0 and $note_pointage_current > 0 and $note_pointage_prev == 0 ){
                                $note_auto_rohi = $last_note;
                            }

                            /**
                             * appreciation
                             */
                            //$appreciation = $this->evaluationRepository->getAppreciationByNote($note_auto_rohi);
                            $appreciation_general = $this->evaluationRepository->getAppreciationGeneralByAverageAndLevel($note_auto_rohi, 1);
                            /**
                             * Insertion evaluation
                             */
                            $evaluation = EvaluationEntity::create([
                                'id_agent' => $agent->id,
                                'id_evaluateur' => $authority,
                                'id_evaluation_periode' => $current_trim['id'],
                                'date' => new \DateTime('now'),
                                'id_groupe' => 1,
                                'moyenne' => $note_auto_rohi,
                                'id_appreciation_generale' => 1,
                                'type_evaluation' => 'auto',
                                'id_agent_user_id' => $agent->user_id
                            ]);
                            EvaluationApreciation::create([
                                'id_evaluation' => $evaluation->id,
                                'id_agent' => $agent->id,
                                'id_appreciation' => $appreciation_general->id_appreciation,
                                'id_appreciation_general' => $appreciation_general->id
                            ]);
                            $this->notify_authority($agent);
                            //echo '<pre>', print_r($evaluation->id), '</pre>', exit;
                        }

                    }
                }
            }
        }
    }
    
    private function notify_authority($agent){
        if ( !in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1', '154.126.11.151']) ){
            $this->smarty->assign('agent', $agent);
            $body  = $this->smarty->fetch( $this->getBaseModulePath() . '/views/email/notify.auto.evaluation.tpl' );
            $this->load->library('email');
            $this->email->from('admin@admin.rohi')
                ->to($agent->email)
                ->subject('Evaluation automatique par rohi. IM: '.$agent->matricule)
                ->message($body)
                ->set_mailtype('html');
            $this->emal->send();

        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    private function last_day(){
        $current_trim  = $this->evaluationRepository->current_trimestre();
        if ( !$current_trim )
            return false;
        $last_day = new \DateTime( $current_trim['ended_at'] );
        $now      = new \DateTime("now" );

        if ( $last_day->format('d-m') == $now->format('d-m') )
            return true;
        return false;
    }

    private function get_all_agent(){
        $all = $this->cronRepository->get_all_agent_with_evaluateur();
        if ( !is_array($all) or !sizeof($all) )
            return false;
        $out = [];
        foreach($all as $gcapEvaluation){
            $agents_gcap  = explode( '-', $gcapEvaluation->evaluation_userEvalue );
            $agents  = [];
            foreach ( $agents_gcap as $item ){
                if ( !$this->evaluationRepository->isEvaluated( $item, true, "id_agent_user_id" ) ){
                    $agents[] = $item;
                }
            }
            $authority = (new Candidat($gcapEvaluation->evaluation_userAutoriteId, 'user_id'))->get();
            if ( !is_null( $authority ) ){
                $out[$gcapEvaluation->evaluation_userAutoriteId] = [
                    'agents_a_evaluer' => $agents,
                    'authority'  => $authority
                ];
            }
        }
        return $out;
    }





}