<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use TT\BaseController;
use TT\Entity\Theme;
use TT\ModelAdapter;
use TT\Repository\EvaluationRepository;
use TT\Repository\RohiRepository;

require_once __DIR__ . '../../src/bootstrap.php';

class Agent extends BaseController
{
    protected $moduleName = 'evaluations';

    /**
     * @var EvaluationRepository;
     */
    protected $evaluationRepository;

    public function __construct()
    {
        global $oSmarty;
        parent::__construct($oSmarty);
        $this->evaluationRepository = new EvaluationRepository();
        $auth = $this->check($this->userConnected, $this->agent);
    }

    public function index(){
        if ( $this->userAccess() == COMPTE_AGENT ){
            $this->sidebar();
            $is_evaluated = $this->evaluationRepository->isEvaluated(
                $this->userConnected['id'], false, 'id_agent_user_id'
            );

            $this->display('index.html.tpl', [
                'departments' => [],
                'is_evaluated' => $is_evaluated
            ]);
        }

    }

    public function show_notes(){

        if ( $this->userAccess() == COMPTE_AGENT ){
            $page  = is_null( $this->filter('_p_') ) ? 1 : $this->filter('_p_');
            $this->sidebar();
            $candidat = (new RohiRepository())->getAgent($this->userConnected['id']);
            $page_total = sizeof($this->evaluationRepository->getNoteAgent($candidat->user_id));
            $notes   = $this->evaluationRepository
                ->getNoteAgent( $candidat->user_id, "id_agent_user_id", $this->note_per_page_table, $page - 1 );

            $this->display('pages/agent/notes.tpl', [
                'departments' => [],
                'is_evaluated' => $this->evaluationRepository->isEvaluated($candidat->id),
                'candidat' => $candidat,
                'row_count' => $page_total,
                'page'  => $page,
                'notes' => $notes,
                'total_page' => ceil( $page_total / $this->note_per_page_table )
            ]);
        }
    }
    
    public function update_theme(){
        $data = $_POST;
        $uid = $this->userConnected['id'];
        $builder = Theme::where('id_user', $uid);
        if ( $builder->first() ){
            $builder->update($data);
        } else {
            $data['id_user'] = $uid;
            Theme::create($data);
        }
        //echo '<pre>', print_r($_POST), '</pre>', exit;
    }

    public function print_bin(){
        if ( $this->userAccess() == COMPTE_EVALUATEUR or $this->userAccess() == COMPTE_AUTORITE){
            $year =  isset($_GET['_y']) ? $_GET['_y'] : null;
            $agentId = $this->filter('_uid');
            $data   = $this->evaluationRepository->get_bin($year, $agentId);
            
            $html = $this->fetch('pdf/bin.tpl', [
                'data'  => $data
            ]);
            
            $domPdf = new Dompdf();
            $domPdf->loadHtml($html);
            $domPdf->setPaper('A4', 'portrait');
            $domPdf->render();
            $domPdf->stream('bin_'.$data['agent']->matricule.'_'.$year.'.pdf', [
                'Attachment' => true
            ]);
        }
    }

    public function print_fiche(){
        if ( $this->userAccess() == COMPTE_EVALUATEUR or $this->userAccess() == COMPTE_AUTORITE ){
            $evaluationId = $this->filter('_eid');
            $gcap = ModelAdapter::gcap($this);
            $decision = ModelAdapter::decision( $this );
            $data = $this->evaluationRepository->get_data_fiche_pdf( $evaluationId );
            
            $data['path'] = [
                'direction' => $gcap->get_Organisation(
                    $data['agent']->departement, 'direction', 1, $data['agent']->direction
                ),
                'service' => $gcap->get_Organisation(
                    $data['agent']->direction, 'service', 2, $data['agent']->service
                ),
                'division' => $gcap->get_Organisation(
                    $data['agent']->service, 'module', 3, $data['agent']->service
                )
            ];

            $data['path']['path'] = $decision->get_path( $data['agent']->structure_path );
            $period_name_pdf = str_replace(' ', '_', $data['agent']->periode_evaluation);
            //echo '<pre>', print_r($data), '</pre>', exit;
            $html = $this->fetch('pdf/fiche-evaluation.tpl', [
                'data'  => $data
            ]);
            //echo '<pre>', print_r($data), '</pre>', exit;
            $option = new Options();
            $domPdf = new Dompdf();
            $domPdf->loadHtml($html);
            $domPdf->setPaper('A4', 'portrait');
            $domPdf->render();
            $domPdf->stream('evaluation_'.$data['agent']->matricule.'_'.$period_name_pdf.'.pdf', [
                'Attachment' => true
            ]);
        }
    }


}