<?php

use TT\BaseController;
use TT\Entity\Evaluation as EvaluationEntity;
use TT\Entity\EvaluationApreciation;
use TT\Entity\EvaluationPeriod;
use TT\Entity\EvaluationQuestion;
use TT\Entity\QuestionsHistory;
use TT\Entity\Rohi\Candidat;
use TT\ModelAdapter;
use TT\Repository\ElementNotationRepository;
use TT\Repository\EvaluationRepository;
use TT\Repository\QuestionsRepository;
use TT\Repository\RohiRepository;
use TT\Utils;
use Illuminate\Database\Capsule\Manager as DB;
require_once __DIR__ . '../../src/bootstrap.php';

class Evaluations extends BaseController {

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
        $this->evaluationRepository->department = $this->filter('dep');
        $auth = $this->check($this->userConnected, $this->agent);
    }

    public function xhr_data_user(){
        $decision = ModelAdapter::decision($this);
        $account = $this->userAccess();
        $page  = isset($_GET['page']) ? $_GET['page'] : 1;
        $search  = isset($_GET['_k']) ? $_GET['_k'] : null;
        $order      = $this->get_order_query_sidebar();
        $sortDirection = $this->get_order_direction_query_sidebar();
        if ( $this->userAccess() == COMPTE_AUTORITE ){
            $attachedUser = $decision->get_user_authority(
                $this->userConnected['id'], $this->filter('dep'), 10, $page, $search, $order, $sortDirection
            );
        } else {
            $attachedUser     = $decision->get_all_User_rattache(
                $this->userConnected, $this->agent, $this->userConnected['id'], $account, $totalPage, 10, $page,
                "ASC", "c.id", $this->filter('dep'), $search
            );
        }

        foreach( $attachedUser as $k=>$agent ){
            $agent['is_evaluated'] = $this->evaluationRepository->isEvaluated( (int) $agent['id'] );
            $agent['_url_action']    = !$agent['is_evaluated'] ?
                '/evaluations/evaluate_user/?_uid='.Utils::encrypt($agent['id']) :
                '/evaluations/notes_agent/?_uid='.Utils::encrypt($agent['id']);
            $attachedUser[$k] = $agent;
        }
        $this->assign('current_user', $this->userConnected);
        $this->assign('account', $account);

        $out = new \stdClass();
        $out->size = 0;
        $out->data = [];
        if ( sizeof($attachedUser) ){
            $out->size = sizeof($attachedUser);
            foreach( $attachedUser as $user ){
                $out->data[] = $this->fetch('partials/item/user-item.tpl', [
                    'user' => $user
                ]);
            }
        }
        //print(json_encode($out));
        return $this->output
            ->set_content_type('text/plain')
            ->set_output(trim(json_encode($out)));

    }



    public function index(){
        $this->sidebar();
        $en = new ElementNotationRepository();

        $departmentModel = ModelAdapter::department($this);
        if ( $this->userAccess() != COMPTE_EVALUATEUR and $this->userAccess() != COMPTE_AUTORITE ){
            redirect('/evaluations/agent');
        }
        $current_trimestre = $this->evaluationRepository->current_trimestre();
        $decision = ModelAdapter::decision($this);
        $current_structure = $decision->current_structure_connected($this->userConnected['id']);
        $decision->get_visible_structure($current_structure->structureId);
        $st = $decision->in_structure_array;
        $current_st = $decision->current_structure_connected($this->userConnected['id'], true);
        $this->display('index.html.tpl', [
            'departments' => $this->evaluationRepository->get_department(),
            'sts'  => $st,
            'current_structure' => array_values($current_st),
            'current_structure_id' => $current_structure->structureId,
            'periods'  => EvaluationPeriod::where('id', '!=', $current_trimestre->id )->orderBy('started_at', 'ASC')->get()->toArray(),
            'compare_data'  => $this->get_data_compare(),
            'current_trimestre'  => $this->evaluationRepository->getCurrentTrimestre()
        ]);

    }

    private function get_data_compare(){
        $decision = ModelAdapter::decision($this);
        $current_path = $decision->current_structure_connected( $this->userConnected['id'], true );
        $sub_structure  = $decision->get_sub_structure($this->userConnected['id']);
        $size_path_current = sizeof( explode( '/', array_values($current_path)[0][1] ) );
        if ( !$sub_structure )
            return false;
        $data  = [];
        foreach ( $sub_structure as $st  ){
            $path_size  = sizeof( explode( '/', $st->path ) );
            if ( $path_size == ( $size_path_current + 1 ) ){
                $data[$st->rang] = $st->rang;
            }
        }
        $data['___DIR___'] = '___DIR___';
        return array_values( $data );
    }

    public function charts(){
        $out  = new \stdClass();
        $out->view = [];
        $out->chartData = [];
        $out->hasdata = false;
        $out->average = 0;

        if ( $this->userAccess() == COMPTE_EVALUATEUR or
            $this->userAccess() == COMPTE_AUTORITE or
            $this->userAccess() == COMPTE_AGENT
        ){
            $typeData = null;
            switch ( $this->userAccess() ){
                case COMPTE_EVALUATEUR:
                    $typeData = 'evaluator';
                    break;
                case COMPTE_AUTORITE:
                    $typeData = 'authority';
                    break;
                case COMPTE_AGENT:
                    $typeData = 'agent';
                    break;
            }
            $data = $this->evaluationRepository->getChartData(
                $this->userConnected['id'], $typeData, false, ModelAdapter::decision($this)
            );


            if ( is_array($data) and sizeof( $data ) ){
                $out->hasdata = true;
                /**
                 * Donut chart
                 */
                $current_trimestre = $this->evaluationRepository->getCurrentTrimestre();
                
                $average_donut  = $this->evaluationRepository->getAverageByPeriod(
                    $current_trimestre['id'], $this->filter('dep'),
                    $this->userAccess(),
                    $this->userConnected['id'],
                    ModelAdapter::decision($this)
                );
                $note = 0;
                $coef = 0;
                $note_current = 0;
                $coef_current = 0;
                foreach( $data as $item ){
                    if( $item->id_evaluation_periode == $current_trimestre['id'] ){
                        $note_current += $item->moyenne;
                        $coef_current ++;
                    }
                    $note += $item->moyenne;
                    $coef ++;
                }

                /*if ( $note_current > 0 and $coef_current > 0 ){
                    $out->average = number_format($note_current / $coef_current, 1);
                } else {
                    $out->average = 0;
                    //$out->average = number_format($note / $coef, 1);
                }
                */
                $out->average =  !$average_donut  ? 0 : number_format( $average_donut->moyenne_period, 1 );
                $out->evp = $current_trimestre;
                $out->average_donut = $average_donut;
                $out->data = $data;
                $out->chartData['donut'] = [
                    20 - $out->average, ($out->average)
                ];

                /**
                 * Radar chart
                 */
                $groups = $this->evaluationRepository->getGroupsAgent($this->userConnected['id']);

                $elementsNotations = $this->getElementNotationRadarChart(
                    $this->evaluationRepository->getChartData(
                        $this->userConnected['id'], $typeData, true, ModelAdapter::decision($this)
                    )
                    , $this->userAccess());
                $out->radar_data = $elementsNotations;

                /**
                 * Line chart
                 */
                $evaluationPeriod = EvaluationPeriod::orderBy('started_at', "ASC")->get()->toArray();
                $dataPeriod = [];
                $dataPeriod['average_rang'] = false;
                $structure  = $this->get_data_compare();
                $now  = new \DateTime($current_trimestre['ended_at']);
                foreach ( $evaluationPeriod as $period ){
                    //$now = new \DateTime('now');



                    $periodStart = new \DateTime( $period['started_at'] );
                    if ( $now >= $periodStart ){

                        /** @var structure */
                        if ( is_array( $structure ) and sizeof( $structure ) ){
                            foreach ( $structure as $st ){
                                if ( $st != '___DIR___' ){
                                    $average_st = $this->evaluationRepository->getAverageByPeriod(
                                        $period['id'], $this->filter('dep'),
                                        $this->userAccess(),
                                        $this->userConnected['id'],
                                        ModelAdapter::decision($this),
                                        $st,
                                        $this
                                    );
                                    $dataPeriod['average_rang'][$st][] = number_format((int)$average_st->moyenne_period, 1);;
                                }
                            }
                        }

                        $label   = explode(' ', $period['short_label']);
                        //array_push($label, $period['year']);
                        $dataPeriod['labels'][] = $label;
                        $average  = $this->evaluationRepository->getAverageByPeriod(
                            $period['id'], $this->filter('dep'),
                            $this->userAccess(),
                            $this->userConnected['id'],
                            ModelAdapter::decision($this)
                        );

                        $dataPeriod['average'][] = number_format((int)$average->moyenne_period, 1);
                    }
                }
                //echo '<pre>', print_r($dataPeriod), '</pre>', exit;

                $dataPeriod['sce']  = ["10.0", "7.0", "3.0", "17.0", "12.0", "13.0"];
                $out->line_data = $dataPeriod;
                $out->has_line =  sizeof( $dataPeriod ) ? true : false;
            }


        }


        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    public function xhr_remove_agent(){
        if( $this->userAccess() == COMPTE_EVALUATEUR ){

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->update_agent('remove')));
        }
    }

    private function checkAgent($agent_id, $evaluatuer_id, $is_user_id = false){
        $sub = $this->evaluationRepository->getAllUserSubordonnees(
            ModelAdapter::decision($this),
            $this->userConnected, $this->agent, $this->userConnected['id'], $this->userAccess()
        );

        $candidat = ( !is_null($this->filter('_uid')) ) ? (new RohiRepository())->getCandidatById($this->filter('_uid')) : null;
        $id  = ( $is_user_id ) ? $agent_id : $candidat->user_id;
        return in_array( $id, explode(',', $sub) );
    }

    private function update_agent($mode){
        if( $this->userAccess() == COMPTE_EVALUATEUR ){
            $out = new \stdClass();
            $out->results = [];
            $out->success = false;

            $agentID = isset($_GET['_aid']) ? $_GET['_aid'] : false;
            $current_evaluator = isset($_GET['_cu']) ? $_GET['_cu']  : false;
            if( $agentID ){
                $out->success = true;
                $sub = $this->evaluationRepository->getAllUserSubordonnees(
                    ModelAdapter::decision($this),
                    $this->userConnected, $this->agent, $this->userConnected['id'], $this->userAccess()
                );
                switch ($mode){
                    case 'add':
                        $sub = str_replace(',','-',$sub);
                        if ( !$this->checkAgent( $agentID, $this->userConnected['id'], true ) )
                            $sub .= '-' . $agentID;
                        break;
                    case 'remove':
                        $sub_a = [];
                        foreach (explode(',', $sub) as $agent){
                            if ( $agent != $agentID )
                                $sub_a[] = $agent;
                        }
                        $sub = implode('-', $sub_a);
                        break;
                }
                $this->evaluationRepository
                    ->update_agent( $sub, $this->userConnected['id']);
                if ( $current_evaluator and $current_evaluator != null and $current_evaluator != 'null' ){
                    list ($evaluation_userId, $evaluation_userAutoriteId) = explode('.', $current_evaluator);
                    $this->evaluationRepository->remove_agent_from_evaluator(
                        $agentID, $evaluation_userId, $evaluation_userAutoriteId
                    );
                }
            }

            return $out;
        }
    }

    public function xhr_add_agent(){
        if( $this->userAccess() == COMPTE_EVALUATEUR ){

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->update_agent('add')));
        }
    }

    private function getNumberAgentEvaluePerGroup(array $evaluations, int $group){
        $agentOnGroup = [
            1 => 0, 2 => 0
        ];
        foreach ( $evaluations as $evaluation ){
            if ( $evaluation->id_groupe == 1 )
                $agentOnGroup[1]++;
            if ( $evaluation->id_groupe == 2 )
                $agentOnGroup[2]++;
        }
        return $agentOnGroup[$group];
    }

    public function filter_date(){
        if ( $this->userAccess() == COMPTE_EVALUATEUR or $this->userAccess() == COMPTE_AUTORITE ){

            $uc  = $this->userConnected;
            $ev  = $this->evaluationRepository
                ->get_evaluation_by_date_range( $uc['id'], $this, $_GET['from'], $_GET['to'], $_GET['_dep'], $this->userAccess() );
            $out = new \stdClass();
            $out->has_result = $ev ? true : false;
            $out->data_results = !$ev ? [] : $this->getElementNotationRadarChart( $ev, COMPTE_EVALUATEUR );
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($out));
        }
    }

    public function compare( ){
        if ( $this->userAccess() == COMPTE_EVALUATEUR or $this->userAccess() == COMPTE_AUTORITE ){
            $uc  = $this->userConnected;
            $ev  = $this->evaluationRepository
                ->get_evaluation_by_rang( $uc['id'], $_GET['_d'], $this, $_GET['from'], $_GET['to'], $_GET['_dep'], $this->userAccess() );

            $out = new \stdClass();
            $out->has_result = $ev ? true : false;
            if ( $ev ){
                foreach ( $ev as $ev_rang ){
                    $out->data[] = [
                        'st' => $ev_rang['st'],
                        'notes' => $this->getElementNotationRadarChart( $ev_rang['evaluation'], COMPTE_EVALUATEUR )
                    ];
                }
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($out));

        }
    }

    private function radar_element(array $data, $element, $evaluations, $account, \Transactions $transaction_model){
        $data['elements'][$element->id] = $element->name;
        $data['elements_all'][$element->id] = $element->name;
        $data['elements_data'][] = $element;
        $data['note_element'][$element->id] = 0;
        $data['dividende'][$element->id] = 0;
        $data['pointage'] = 0;
        $data['div_pointage'] = 0;

        foreach(  $evaluations as $evaluation ){

            if ( $evaluation->id_groupe == $element->id_group ){
                $response = (new QuestionsRepository())
                    ->getAppreciationByElement($evaluation->id, $element->id);
                $noteByElement = 0;
                foreach ( $response as $el ){
                    $noteByElement += ( $el->moyenne > 0 ) ? $el->moyenne
                        : ($el->min + $el->max) / 2;
                }
                $data['note_element'][$element->id] += $noteByElement / 2;
                $data['dividende'][$element->id]++;

                //assiduité
                $date_start = new \DateTime( $evaluation->evp_started_at );
                if ( $account == COMPTE_AGENT ){
                    if ( $evaluations[0]->id_groupe == 2 ){
                        $note_pointage  = $transaction_model->TempsDeTravailDunAgentAvecDenominateur(
                            $evaluation->matricule,
                            $date_start->format('Y-m-d')
                            , $date_start->modify('last day of')->format('Y-m-d')
                            , $den
                            , $this
                            , $date_start->format('Y')
                            , 11.5
                        );
                        $data['pointage'] += $note_pointage;
                        $data['div_pointage']++;
                    }
                } else {
                    if ( $evaluation->id_groupe == 2 ){
                        $note_pointage  = $transaction_model->TempsDeTravailDunAgentAvecDenominateur(
                            $evaluation->matricule,
                            $date_start->format('Y-m-d')
                            , $date_start->modify('last day of')->format('Y-m-d')
                            , $den
                            , $this
                            , $date_start->format('Y')
                            , 11.5
                        );
                        $data['pointage'] += $note_pointage;
                        $data['div_pointage']++;
                    
                    }
                }

            }

        }
        return $data;
    }

    private function getElementNotationRadarChart(array $evaluations, $account = COMPTE_AGENT){
        $en_repos = new ElementNotationRepository();
        $all      = $en_repos->getAll();
        $data = [];

        $transaction_model = ModelAdapter::transacrion($this);

        /**
         * update 10 / 06
         */
        $element_notation = [];
        $element_notation_group = [];
        $pointage  = new \stdClass();
        $pointage->id = 999999;
        $pointage->display_order = 6;
        $pointage->name = 'Assiduité au service';
        $pointage->id_group = 2;
        foreach ( $all as $element ){

            $element_notation[ $element->id ] = [
                'label' => $element->name,
                'order' => $element->display_order,
                'note' => []
            ];
            if ( $element->id_group == 1 ){
                $element_notation_group[1][] = $element;
            }
            if ( $element->id_group == 2 ){
                $element_notation_group[2][] = $element;
            }
        }
        $element_notation_group[2][] = $pointage;
        $element_notation[ $pointage->id ] = [
            'label' => $pointage->name,
            'order' => $pointage->display_order,
            'note' => []
        ];
        
        foreach ( $evaluations as $evaluation ){
            foreach ( $element_notation_group as $id_group => $notations ){
                if ( $id_group == $evaluation->id_groupe ){
                    foreach ( $notations as $notation ){
                        $response = (new QuestionsRepository())
                            ->getAppreciationByElement($evaluation->id, $notation->id);
                        
                        if ( $response ){
                            $noteByElement = [];
                            foreach ( $response as $el ){
                                $noteByElement[] = ( $el->moyenne > 0 ) ? $el->moyenne
                                    : ($el->min + $el->max) / 2;
                            }
                            if ( sizeof( $noteByElement ) ){
                                $element_notation[ $notation->id ]['note'][] = array_sum( $noteByElement ) / count( $noteByElement );
                            }
                        }
                        $date_start = new \DateTime( $evaluation->evp_started_at );
                        if ( $id_group == 2 and $notation->id == 999999 ){
                            $element_notation[ 999999 ]['note'][] = $transaction_model->TempsDeTravailDunAgentAvecDenominateur(
                                $evaluation->matricule,
                                $date_start->format('Y-m-d')
                                , $date_start->modify('last day of')->format('Y-m-d')
                                , $den
                                , $this
                                , $date_start->format('Y')
                                , 11.5
                            );
                        }
                    }

                }
            }

        }

        $data_update  = [];
        $element_notation  = $this->orderElementNotationArray( $element_notation );
        foreach ( $element_notation as $el ){
            $data_update['labels'][] = $el['label'];
            $data_update['notes'][] = sizeof( $el['note'] ) ?
                (array_sum( $el['note'] ) / count( $el['note'] ))
                : 0;

        }
        $data_update['has_radar_data'] = ( (array_sum( $data_update['notes'] ) / count( $data_update['notes'] ))  ) > 0
            ? true : false;

        //echo '<pre>', print_r($data_update), '</pre>', exit;



        /*
        foreach ( $all as $k => $element ){
            if ( $account == COMPTE_AGENT ){
                if ( $element->id_group == $evaluations[0]->id_groupe ){
                    $data = $this->radar_element(
                        $data, $element, $evaluations, $account, $transaction_model
                    );

                }
            }  else {
                $data = $this->radar_element(
                    $data, $element, $evaluations, $account, $transaction_model
                );

            }

        }*/

        /*foreach ( $data['note_element'] as $k => $v ){
            if ( $v == 0 ){
                unset($data['note_element'][$k]);
                unset($data['dividende'][$k]);
                unset($data['elements'][$k]);
            }
        }*/
        
        /*
        $data['note_element'] = array_values($data['note_element']);
        $data['dividende'] = array_values($data['dividende']);
        $data['elements'] = array_values($data['elements']);
        */
        /*if ( $account == COMPTE_AGENT ){
            if ( $evaluations[0]->id_groupe == 2 ){
                $data['elements'][] = 'Assiduité au Service';
                $data['note_element'][] = $data['pointage'];
                $data['dividende'][] = $data['div_pointage'];
            }
        } else {

            $data['elements'][] = 'Assiduité au Service';
            $data['note_element'][] = $data['pointage'];
            $data['dividende'][] = $data['div_pointage'];
        }*/
        /*
        $data['elements'][] = 'Assiduité au Service';
        $data['note_element'][] = $data['pointage'];
        $data['dividende'][] = $data['div_pointage'];


        
        //echo '<pre>', print_r($data), '</pre>';
        $data['in_group'][1] = $this->getNumberAgentEvaluePerGroup($evaluations, 1);
        $data['in_group'][2] = $this->getNumberAgentEvaluePerGroup($evaluations, 2);
        $data['new_data'] = $data_update;*/

        return $data_update;
    }

    private function orderElementNotationArray( array $els){
        $out  = [];
        foreach ( $els as $el ){
            $out[$el['order']] = $el;
        }
        ksort($out);
        return $out;
    }

    public function post_group(){
        $jobGroup = $this->formInput->post('job_group')[0];
        Utils::storeData('job_group_' . Utils::decrypt($this->formInput->post('_uid')),
            $jobGroup);
        $url  = isset($_POST['_remind']) ? '/evaluations/evaluate_user/?_remind&_evid='.$this->formInput->post('_evid')
            : ( isset( $_POST['_reload'] ) ? '/evaluations/evaluate_user/?_reload&_evp='.$this->formInput->post('_evp').'&_uid='.$this->formInput->post('_uid')
                : '/evaluations/evaluate_user/?_uid='.$this->formInput->post('_uid') );
        redirect( $url );
    }

    public function post_note_question(){
        if ( $this->userAccess() == COMPTE_EVALUATEUR ){
            
            $transaction_model = ModelAdapter::transacrion($this);
            $data = $this->formInput->post();
            $date_start = new \DateTime('now');
            $note = 0;
            $coeff = 0;
            $serial_note_response = [];
            $agent   = (new Candidat( $data['id_agent'] ))->get();
            $assiduite = $transaction_model->TempsDeTravailDunAgentAvecDenominateur(
                $agent->matricule,
                $date_start->format('Y-m-d')
                , $date_start->modify('last day of')->format('Y-m-d')
                , $den
                , $this
                , $date_start->format('Y')
                , 11.5
            );
            foreach( $data['question'] as $questionId => $response ){
                $note_question = 0;
                foreach ( $response as $appreciation_id ){
                    $element = (new ElementNotationRepository())->getAverage($appreciation_id);
                    $m  =  ( (int)$element->moyenne != 0 )
                        ? $element->moyenne
                        : ($element->min + $element->max) / 2;
                    $note_question += $m;
                    $serial_note_response[] = $m;
                }
                //$element = (new ElementNotationRepository())->getAverage($response);
                //echo '<pre>', print_r($element), '</pre>', exit;
                /*if ( (int)$element->moyenne != 0 ){
                    $note += $element->moyenne;
                } else */

                /*$m  =  ( (int)$element->moyenne != 0 )
                    ? $element->moyenne
                    : ($element->min + $element->max) / 2;*/
                $note += $note_question / 2;

                $coeff++;
            }
            $average = $data['id_groupe'] == 2
                ? ($note + $assiduite) / ($coeff+1)
                : $note / $coeff;

            if ( $this->evaluationRepository->is_first_evaluation( $data['id_agent'] ) ){
                /**
                 * Premiere evaluation
                 */
                $data['average'] = number_format($average, 2);
            } else {
                /**
                 * Evalution ulterieur
                 */
                $note = $average;
                //median des notes par appreciation
                $median = Utils::calculate_median($serial_note_response);
                if ( ($note - 1) < 15 ){
                    $av  = ( $median * ( $note - 1 ) ) / 15;
                    $data['average'] = number_format($av, 2);
                } elseif ( ($note - 1) >= 15 ){
                    $data['average'] = number_format($average, 2);
                }
            }
            
            Utils::storeData('evaluation_user_'.$data['id_agent'], $data);
            /*$url  = isset($_POST['_remind']) ? '/evaluations/general_appreciation/?_remind&_evid='.$this->formInput->post('_evid')
                : '/evaluations/general_appreciation/?_uid='.Utils::encrypt($this->formInput->post('id_agent'));
*/
            $url  = isset($_POST['_remind']) ? '/evaluations/general_appreciation/?_remind&_evid='.$this->formInput->post('_evid')
                : ( isset( $_POST['_reload'] ) ? '/evaluations/general_appreciation/?_reload&_evp='.$this->formInput->post('_evp').'&_uid='.Utils::encrypt($this->formInput->post('id_agent'))
                    : '/evaluations/general_appreciation/?_uid='.Utils::encrypt($this->formInput->post('id_agent')) );
            redirect($url);

        }
    }

    public function general_appreciation(){
        if ( $this->userAccess() == COMPTE_EVALUATEUR ){

            if ( !isset($_GET['_uid'])
                and !isset($_GET['_evid'])
                and !isset($_GET['_remind'])
                and !isset($_GET['_reload'])
                and !isset($_GET['_evp'])){
                show_404(); exit;
            }
            if ( !$this->checkAgent( $_GET['_uid'], $this->userConnected['id'] ) ){
                show_404(); exit;
            }
            $this->sidebar();
            if ( isset( $_GET['_remind'] ) ){
                $remind_evaluation = $this->evaluationRepository->get_evaluation(
                    $this->filter( '_evid' ), " and type_evaluation='auto'"
                );
                $userId = $remind_evaluation->id_agent;
            } else
                $userId = $this->filter('_uid');
            $previousData = Utils::getStoredData('evaluation_user_'.$userId);

            if ( is_null($previousData) ){
                $url  = isset($_POST['_remind']) ? '/evaluations/evaluate_user/?_remind&_evid='.$_GET['_evid']
                    : ( isset( $_POST['_reload'] ) ? '/evaluations/evaluate_user/?_reload&_evp='.$this->formInput->post('_evp').'&_uid='.$_GET['_uid']
                        : '/evaluations/evaluate_user/?_uid='.$_GET['_uid']);
                redirect($url);
            }
            $questionAppreciation = [];
            for ( $i=1; $i<4; $i++ ){
                $questionAppreciation[] = $this
                    ->evaluationRepository
                    ->getAppreciationGeneralByAverageAndLevel(
                        $previousData['average'], $i
                    );
            }
            $candidat = (new RohiRepository())->getCandidatById($userId);
            $this->display('pages/evaluate_user/fiche-appreciation.tpl', [
                'candidat' => $candidat,
                'questions' => $questionAppreciation,
                'remind' => isset($_GET['_remind']),
                'is_evaluation_time' => $this->evaluationRepository->is_time_to_evaluate(),
                'is_evaluated' => false,
                'appreciation_label' => $questionAppreciation[0]->appreciation_label
            ]);
        }
    }

    public function post_final(){

        if ( $this->userAccess() == COMPTE_EVALUATEUR ){
            $data = $this->formInput->post();
            //$data['id_agent'] = Utils::decrypt($data['id_agent']);
            $previousData = Utils::getStoredData('evaluation_user_'.$data['id_agent']);

            if ( isset($previousData['_remind']) ){
                //rappel evaluation
                $id_evaluation = Utils::decrypt($previousData['_evid']);
                /*$ev = $this->evaluationRepository->get_evaluation(
                    Utils::decrypt($previousData['_evid']), ' and type_evaluation=\'auto\''
                );*/
                //supprimer l'evaluation auto
                EvaluationEntity::where('id', $id_evaluation)->delete();
                EvaluationApreciation::where('id_evaluation', $id_evaluation)->delete();
            }
            //dd($previousData); exit;
            //save evaluation
            $evaluation = EvaluationEntity::create([
                'id_agent' => $previousData['id_agent'],
                'id_evaluateur' => $previousData['id_evaluateur'],
                'id_evaluation_periode' => $previousData['id_evaluation_periode'],
                'date' => new \DateTime('now'),
                'id_groupe' => $previousData['id_groupe'],
                'moyenne' => $previousData['average'],
                'id_appreciation_generale' => $data['id_appreciation_general'],
                'type_evaluation' => 'manual',
                'id_agent_user_id' => $previousData['id_agent_user_id']
            ]);
            //evaluation question
            foreach ( $previousData['question'] as $id_element_notation => $questions ){
                foreach ( $questions as $id_question => $id_appreciation_question ){
                    EvaluationQuestion::create([
                        'id_evaluation' => $evaluation->id,
                        'id_question_evaluation' => $id_question,
                        'id_apreciation_question' => $id_appreciation_question,
                        'note' => $this->evaluationRepository->get_note_appreciation_question($id_appreciation_question)
                    ]);
                    //history
                    QuestionsHistory::create([
                        'id_agent' => $previousData['id_agent'],
                        'id_groupe_fonction' => $previousData['id_groupe'],
                        'id_question_evaluation' => $id_question,
                        'id_element_notation' => $id_element_notation,
                        'questioned_at' => new \DateTime('now')
                    ]);
                }

            }
            EvaluationApreciation::create([
                'id_evaluation' => $evaluation->id,
                'id_agent' => $data['id_agent'],
                'id_appreciation' => $data['id_appreciation_general'],
                'id_appreciation_general' => $data['appreciation_general'][0]
            ]);
            unset($_SESSION['evaluation_user_'.$data['id_agent']]);
            unset($_SESSION['job_group_'.$data['id_agent']]);

            redirect('/evaluations');
        }
    }

    private function getQuestion($notation, $max = 2){
        $out = [];
        $qr  = new QuestionsRepository();
        for( $i=0; $i<$max; $i++ ){
            $ignore = sizeof( $out ) > 0 ? $out[0]->id : 0;
            $question = $qr->getQuestionByElement($notation, null, 1, $ignore)[0];
            $out[] = $question;
        }
        return $out;
    }

    public function evaluate_date(){
        if ( $this->userAccess() == COMPTE_EVALUATEUR ){
            if ( !isset($_GET['_evp']) ){
                show_404(); exit;
            }
            /*$evaluation_auto = $this->evaluationRepository->get_evaluation(
                $this->filter('_evid'), "and type_evaluation='auto'"
            );*/
            redirect('/evaluations/evaluate_user/?_reload&_evp='.$_GET['_evp'].'&_uid='.$_GET['_uid']);
        } else
            show_404();
    }

    public function evaluate_remind(){
        $account = $this->userAccess();
        if ( $account == COMPTE_EVALUATEUR ){
            if ( !isset($_GET['_evid']) ){
                show_404(); exit;
            }
            /*$evaluation_auto = $this->evaluationRepository->get_evaluation(
                $this->filter('_evid'), "and type_evaluation='auto'"
            );*/
            redirect('/evaluations/evaluate_user/?_remind&_evid='.$_GET['_evid']);
        } else
            show_404();
    }

    public function evaluate_user(){

        $account = $this->userAccess();
        if ( $account == COMPTE_EVALUATEUR ){

            if ( !isset($_GET['_uid'])
                and !isset($_GET['_evid'])
                and !isset($_GET['_remind'])
                and !isset($_GET['_reload'])
                and !isset($_GET['_evp'])){
                show_404(); exit;
            }

            if ( !$this->checkAgent( $_GET['_uid'], $this->userConnected['id'] ) ){
                show_404(); exit;
            }

            $this->sidebar();
            $questionRepository = new QuestionsRepository();
            if ( isset($_GET['_remind']) ){
                //Rappel evaluation auto
                $remind_evaluation = $this->evaluationRepository->get_evaluation(
                    $this->filter( '_evid' ), " and type_evaluation='auto'"
                );
                $userIdToEvaluate = $remind_evaluation->id_agent;
                $periode  = EvaluationPeriod::where('id', $remind_evaluation->id_evaluation_periode)
                    ->first()->toArray();
            } elseif( isset( $_GET['_reload'] ) ) {
                // Evaluation des periode sans evaluations
                $userIdToEvaluate = $this->filter('_uid');
                $periode  = EvaluationPeriod::where('id', $this->filter('_evp'))
                    ->first()->toArray();
            } else {
                //Evaluation manuel
                $userIdToEvaluate = $this->filter('_uid');
                $periode = $this->evaluationRepository->getCurrentTrimestre();
            }
            
            
            $candidat = (new RohiRepository())->getCandidatById($userIdToEvaluate);

            $questions = [];
            if ( Utils::getStoredData('job_group_'.$candidat->id) !== null ){

                if ( sizeof($candidat->notations) ){
                    foreach( $candidat->notations as $notation ){
                        $q = $this->getQuestion( $notation, 2 );
                        $questions[] = [
                            "elements" => $notation,
                            "questions" => $q
                        ];
                    }
                }
            }

            $appreciationQuestion = $questionRepository->appreciationQuestion();
            $this->display('pages/evaluate_user/fiche-trimestre.tpl', [
                'candidat' => $candidat,
                'periode'  => $periode,
                'reload'  => isset($_GET['_reload']),
                'questions' => $questions,
                'is_evaluation_time' => $this->evaluationRepository->is_time_to_evaluate(),
                'remind'  => isset($_GET['_remind']),
                'evid'  => isset($_GET['_remind']) ? $this->filter( '_evid' ) : null,
                'evp'  => isset($_GET['_reload']) ? $this->filter( '_evp' ) : null,
                'is_evaluated' => $this->evaluationRepository->isEvaluated($userIdToEvaluate),
                'appreciations_questions' => $appreciationQuestion,
                'job_group' => Utils::getStoredData('job_group_'.$candidat->id)
            ]);
        } else
            show_404();


    }

    public function search_agent(){
        $results = $this->evaluationRepository->searchUnattachedAgent(
            ModelAdapter::decision($this),
            $this->userConnected, $this->agent, $this->userConnected['id'], $this->userAccess(),
            (isset($_GET['_s']) ? $_GET['_s'] : null)
        );
        foreach ($results as $k=>$v){
            $v->status = $this->evaluationRepository->is_attached_by_evaluator($v->user_id);
            $results[$k] = $v;
        }
        //echo '<pre>', print_r($results), '</pre>', exit;
        $out = new stdClass();
        $out->has_result = false;

        if ( is_array($results) and sizeof($results) ){
            $out->has_result = true;
            $out->data_results = $results;
        } else {
            if ( $this->evaluationRepository->isAlreadyAttached( (isset($_GET['_s']) ? $_GET['_s'] : null), $this->userConnected['id']  ) ){
                $out->status = 'already-attached';
            } else {
                $out->status = 'no-results';
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    public function notes_agent(){
        if ( $this->userAccess() == COMPTE_AGENT )
            redirect('/evaluations/agent/show_notes');

        $page  = is_null( $this->filter('_p_') ) ? 1 : $this->filter('_p_');
        $this->sidebar();
        $user = $this->filter('_uid');
        $candidat = (new RohiRepository())->getCandidatById($user);
        $page_total = sizeof($this->evaluationRepository->getNoteAgent($candidat->user_id));
        $notes = $this->evaluationRepository->getNoteAgent(
            $candidat->user_id, "id_agent_user_id", $this->note_per_page_table, $page - 1 );
        $page_prev_date  = is_null( $this->filter('_pdt_') ) ? 1 : $this->filter('_pdt_');
        $prev_date_no_evaluations = $this->evaluationRepository->get_prev_date_without_evaluation( $candidat->user_id
            , $this->note_per_page_table, $page_prev_date - 1
        );
        $prev_date_total  = sizeof(
            $this->evaluationRepository->get_prev_date_without_evaluation( $candidat->user_id )
        );
        $this->display('pages/agent/notes.tpl', [
            'candidat' => $candidat,
            'is_evaluated' => $this->evaluationRepository->isEvaluated($user),
            'notes'  => $notes,
            'page'  => $page,
            'prev_date'  => $prev_date_no_evaluations,
            'row_count' => $page_total,
            'total_page' => ceil( $page_total / $this->note_per_page_table ),
            'pagination_dates' => [
                'page'  => $page_prev_date,
                'row_count' => $prev_date_total,
                'total_page' => ceil( $prev_date_total / $this->note_per_page_table ),
            ]
        ]);

    }

    public function global_show(){
        $this->sidebar();
        $this->load_my_view_Common('show.tpl', [], 1);
    }




}