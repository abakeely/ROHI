<?php


class EvaluationsModel extends Evaluation2_gcap_model
{


    public function agent_stat($department){
        global $db;
        $DB1 = $this->load->database('gcap', TRUE);

        $zDatabaseOrigin =  $db['default']['database'] ;

        $zSql  = " select noteevaluation2.*,(select periode_libelle from periode where periode_id = noteEvaluation_periodeId) as periode,(select CONCAT(nom,' ',prenom) FROM ".$zDatabaseOrigin.".candidat where user_id=noteevaluation_userSendNoteId) as nomEvaluateur,
		(select sigle_departement FROM ".$zDatabaseOrigin.".departement de where de.id=c.departement) as zSigleDepart,
		(select sigle_direction FROM ".$zDatabaseOrigin.".direction di where di.id=c.direction) as zSigleDirect,
		(select sigle_service FROM ".$zDatabaseOrigin.".service se where se.id=c.service) as zSigleService,
		c.id as iCandidatId 
		
		from noteevaluation2 INNER JOIN $zDatabaseOrigin.candidat c on c.user_id = noteevaluation_userNoteId where noteEvaluation_periodeId = 5 AND noteEvaluation_anneeNote like '%2018%'" ;

        if ( !is_null($department) )
            $zSql .= " and c.departement=".$department;

        $zQuery = $DB1->query($zSql);
        $toRow = $zQuery->result_array();

        $zQuery->free_result();
        $toResult = array();
        foreach ($toRow as $oRow){
            $oResult['noteEvaluation_id']			= $oRow['noteEvaluation_id'];
            $oResult['noteEvaluation_dateNotation'] = $oRow['noteEvaluation_dateNotation'];
            $oResult['nomEvaluateur']				= $oRow['nomEvaluateur'];
            $oResult['iCandidatId']					= $oRow['iCandidatId'];
            $oResult['zSigleDepart']				= $oRow['zSigleDepart'];
            $oResult['zSigleDirect']				= $oRow['zSigleDirect'];
            $oResult['zSigleService']				= $oRow['zSigleService'];
            $oResult['oEachNote']					= array();
            $toNoteAll = explode(";", $oRow['noteEvaluation_NoteAll']) ;

            $fMoyenneNote = 0;
            $iIncrement = 0;
            //$zCritereAndNote = "";
            $zCritereAndNoteArray = [];
            foreach ($toNoteAll as $oNoteAll){
                $toSplitNote = explode("-", $oNoteAll) ;
                array_push($oResult['oEachNote'], $toSplitNote);

                if (isset ($toSplitNote[1])) {
                    $fMoyenneNote += (double)$toSplitNote[1] ;
                    //$zCritereAndNote .= "- " . ucFirst($this->getCritereLibelle((int)$toSplitNote[0])) . " : " . (double)$toSplitNote[1] . "<br/>" ;
                    $zCritereAndNoteArray[] = [ucFirst($this->getCritereLibelle((int)$toSplitNote[0])), (double)$toSplitNote[1]];
                    $iIncrement++;
                }
            }

            if (sizeof($toNoteAll)>0 and ( $fMoyenneNote > 0 and $iIncrement > 0 )){
                $fMoyenneNote = ($fMoyenneNote / $iIncrement) * 4 ;
            }
            $oResult['fMoyenneNote']				= $fMoyenneNote;
            $oResult['noteEvaluation_evaluable']	= $oRow['noteEvaluation_evaluable'];
            $oResult['noteEvaluation_periodeId']	= $oRow['noteEvaluation_periodeId'];
            $oResult['periode']						= $oRow['periode'];
            //$oResult['zCritereAndNote']				= $zCritereAndNote;
            $oResult['zCritereAndNoteArray']				= $zCritereAndNoteArray;
            $oResult['noteEvaluation_anneeNote']	= $oRow['noteEvaluation_anneeNote'];
            array_push($toResult, $oResult);

        }
        //echo '<pre>', print_r($toResult), '</pre>', exit;

        return $toResult;
    }
}