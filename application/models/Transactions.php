<?php


class Transactions  extends Transaction_pointage_model
{

    /**
     * @param $sql
     * @return array
     */
    public function executeQuery($sql){

        $oConnection	= $this->load->database('pointage', TRUE);
        /*$zError			= odbc_exec($oConnection->conn_id,$_zSql) or die('Maintenance ');
        $oResult		= odbc_do ($oConnection->conn_id,$_zSql);*/
        $query = $oConnection->query($sql);
        return $query->result_array() ;
    }

    public function traitemetDateFin($_zDateFin, $_this) {
        $_zDateFin = $_this->date_fr_to_en($_zDateFin,'/','-');
        $_zDateFin = date('Y-m-d h:i:s', strtotime($_zDateFin.' + 1 DAY'));
        return $_zDateFin;
    }

    public function table_transaction_exists($table){
        $sql  = "show tables like '$table'";
        return sizeof($this->executeQuery($sql));
    }

    public function TempsDeTravailDunAgentAvecDenominateur($_zInMatriculeUser, $_zDateDebut, $_zDateFin,&$iDenominateur, $_this, $_iAnnee="2018", $default = 0) {

        $table   = "acc_monitor_log_$_iAnnee";
        if ( !$this->table_transaction_exists( $table ) )
            return $default;

        $zInMatriculeUser = $_zInMatriculeUser ;

        if ($_zDateDebut == $_zDateFin) {
            //$zInsert = "  (datediff(day, time, '$_zDateDebut') = 0) " ;
            $zInsert = "  (time BETWEEN '".$_zDateDebut." 00:00:00.000' and '".$_zDateDebut." 23:00:00.000')  " ;
        } else {
            $_zDateFinTraitement = $this->traitemetDateFin($_zDateFin, $_this);
            $zInsert = " (time BETWEEN '$_zDateDebut 00:00:00.000'  and  '$_zDateFinTraitement')" ;

        }

        /*$zQuerySqlServer = "SELECT SENSORID,time,userInfo.USERID,CHECKTYPE FROM [ZKAccess".date('Y')."].[dbo].[USERINFO] userInfo
        INNER JOIN [ZKAccess".date('Y')."].[dbo].[acc_monitor_log]  ON ckIn.USERID = userInfo.USERID
        WHERE (userInfo.pin IN (". $zInMatriculeUser .")) AND ".$zInsert."
        GROUP BY userInfo.USERID, time, SENSORID,CHECKTYPE ORDER BY time";*/

        $zQuerySqlServer = " SELECT time,pin,event_point_name as terminal, CAST(
								 CASE 
									  WHEN SUBSTRING(event_point_name, 1, 1) = 'S' 
										 THEN 'O' 
									  ELSE 'I' 
								 END AS CHAR(1)) as CHECKTYPE
								 FROM transactions.$table
								 WHERE (pin IN (".$zInMatriculeUser.")) AND ".$zInsert."
								GROUP BY time,event_point_name,pin ORDER BY time";

        $oResult = $this->executeQuery($zQuerySqlServer);


        $toArrayResult = array();

        /*while($oArrayResult = odbc_fetch_array($oResult)){

            $oArray = array();
            $oArray['time']			= odbc_result($oResult,1);
            $oArray['pin']			= odbc_result($oResult,2);
            $oArray['CHECKTYPE']	= odbc_result($oResult,4);

            array_push($toArrayResult, $oArray);
        }*/
        $toArrayResult = $oResult;

        $iUserId = -1 ;
        $iRet = 0;
        $toAssignationUser = array();
        foreach ($toArrayResult as $oArrayResult) {
            if ($oArrayResult['pin'] != $iUserId) {
                $iUserId = $oArrayResult['pin'] ;
                $iRet = 1;
            }
            $toAssignationUser[$iUserId][] = $oArrayResult;

        }
        
        $toArray = array();
        $toArray1 = array();
        $toAssign = array();
        $toArrayArriveTot = array();
        $toArraySortietard = array();

        $iDateTest = "-1" ;

        $zDateTest = 0;
        $iDenominateur = 0;
        foreach ($toAssignationUser as $iUserId =>  $toReturn ) {

            for ($iBoucle=0;$iBoucle<sizeof($toReturn);$iBoucle++) {

                if ($iDateTest !=  date("Y-m-d",strtotime($toReturn[$iBoucle]['time']))) {
                    $iDateTest = date("Y-m-d",strtotime($toReturn[$iBoucle]['time'])) ;
                    $iDenominateur++;
                }

                $toAssign[$iUserId][$iDateTest][] = $toReturn[$iBoucle];

            }
        }

        foreach ($toAssign as $iUserId =>  $toReturn ) {

            $iDiffTotalGeneral = 0;
            $zHeureArriveTot = 0;
            $zHeureSortieTard = 0;
            foreach ($toReturn as $iDateTest =>  $toReturn ) {

                $iDiff = 0;
                $iDiffTotal = 0 ;

                if (sizeof($toReturn)==1) {
                    $iDiffTotal = 0 ;
                } else {

                    $iTestPause = 0 ;
                    for ($iBoucle=0;$iBoucle<sizeof($toReturn)-2;$iBoucle++) {

                        $zDatetoDay = date("Y-m-d",strtotime($toReturn[$iBoucle]['time'])) ;

                        /* Heure de pause min */
                        $zHeurePauseMin = strtotime($zDatetoDay . " 12:00:00") ;

                        /* Heure de pause max */
                        $zHeurePauseMax = strtotime($zDatetoDay . " 14:00:00") ;

                        $zHeureDeSortieMax = strtotime($zDatetoDay . " 16:00:00") ;


                        if($toReturn[$iBoucle]['CHECKTYPE'] == 'O' &&  $toReturn[$iBoucle+1]['CHECKTYPE'] == 'I') {

                            $zDateDiffMin = $toReturn[$iBoucle]['time'] ;
                            $zDiffzDateMin = 0;
                            $zDiffzDateMax = 0;
                            if (strtotime($toReturn[$iBoucle]['time']) >= $zHeureDeSortieMax) {
                                $zDateDiffMin = $zHeureDeSortieMax ;
                                $zDiffzDateMin = strtotime($toReturn[$iBoucle]['time']) - $zHeureDeSortieMax ;
                            }

                            $zDateDiffMax = $toReturn[$iBoucle+1]['time'] ;
                            if (strtotime($toReturn[$iBoucle+1]['time']) >= $zHeureDeSortieMax) {
                                $zDateDiffMax = $zHeureDeSortieMax ;
                                $zDiffzDateMax = strtotime($toReturn[$iBoucle+1]['time']) - $zHeureDeSortieMax ;
                            }

                            $zHeureSortieTard -= ($zDiffzDateMax - $zDiffzDateMin) ;


                            if (!is_integer($zDateDiffMax)) {

                                $toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);

                            } else {

                                $zDateDiffMax = $toReturn[$iBoucle+1]['time'];
                                $toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);
                            }


                            //$toReturn[$iBoucle+1]['dateDiff'] = $this->dateDiff($zDateDiffMin, $zDateDiffMax, $_this,6);

                            /* Detection Pause 30 mn */
                            if ($iTestPause == 0) {
                                if (strtotime($toReturn[$iBoucle]['time']) >= $zHeurePauseMin  && strtotime($toReturn[$iBoucle+1]['time']) <= $zHeurePauseMax){
                                    if ($toReturn[$iBoucle+1]['dateDiff'] >= 1800){
                                        $iDiff -= 1800 ;
                                        $iTestPause = 1;

                                    } else {


                                        $iDiff -= (int)$toReturn[$iBoucle+1]['dateDiff'];

                                    }
                                }
                            }

                            $iDiff += $toReturn[$iBoucle+1]['dateDiff'] ;
                        }
                    }

                    $zDateMin = date("Y-m-d",strtotime($toReturn[0]['time'])) ;


                    /* heure minimale d'entrée à 08h du matin */
                    $zHeureMin = strtotime($zDateMin . " 08:00:00") ;

                    $zHeureEntree = strtotime($toReturn[0]['time']) ;

                    $zDateEntreeAgent = $toReturn[0]['time'] ;


                    /* si inférieur alors ça reste toujours 08*/
                    if ($zHeureEntree <= $zHeureMin ) {
                        $zDateEntreeAgent = $zDateMin . " 08:00:00" ;
                        //$zHeureArriveTot = $this->dateDiff($toReturn[0]['time'], $zDateEntreeAgent, $_this,7);
                        $zHeureArriveTot += $this->dateDiff($toReturn[0]['time'], $zDateEntreeAgent, $_this,6);
                    }

                    $zDateMax = date("Y-m-d",strtotime($toReturn[sizeof($toReturn)-1]['time'])) ;

                    /* heure maximale de sortie à 16h de l'après-midi */
                    $zHeureMax = strtotime($zDateMax . " 16:00:00") ;

                    $zHeureSortie = strtotime($toReturn[sizeof($toReturn)-1]['time']) ;

                    $zDateSortieAgent = $toReturn[sizeof($toReturn)-1]['time'] ;


                    /* si supérieur alors ça reste toujours 16*/
                    if ($zHeureSortie >= $zHeureMax ) {
                        $zDateSortieAgent = $zDateMax . " 16:00:00" ;
                        $zHeureSortieTard += $this->dateDiff($zDateSortieAgent, $toReturn[sizeof($toReturn)-1]['time'], $_this,6);
                    }

                    $toReturn[sizeof($toReturn)-1]['dateDiff'] = $this->dateDiff($zDateEntreeAgent, $zDateSortieAgent, $_this,6);
                    $iDiffTotal = $toReturn[sizeof($toReturn)-1]['dateDiff'];

                    if (strlen($iDiff) <= 4) {
                        $iDiffTotal -= $iDiff ;
                    }
                }

                $iDiffTotalGeneral += $iDiffTotal ;

            }

            $toArrayArriveTot[(int)$iUserId] = (int)$zHeureArriveTot + (int)$zHeureSortieTard;
            $iGrandTotalOrder = $iDiffTotalGeneral + (int)$zHeureArriveTot + (int)$zHeureSortieTard;

            $toAssignationUser[$iUserId]["dateDiff"] = $iDiffTotalGeneral;
            $toAssignationUser[$iUserId]["iGrandTotalOrder"] = $iGrandTotalOrder;

            array_push ($toArray, $toAssignationUser[$iUserId]["dateDiff"]);
            $toArray2[(int)$iUserId] = $toAssignationUser[$iUserId]["dateDiff"];

        }

        if (sizeof($toArray) > 0) {

            /* 8H = 8 * 3600 = 28 800*/
            $iMax = 28800 * (int)$iDenominateur ;

            $iTimeToAgent = $toArray2[$zInMatriculeUser] ;

            $iNote = ($iTimeToAgent * 100) / $iMax ;

            /* note sur 05 */
            $iNoteSur5 = ($iNote * 5)/100 ;

            /**
             * return note /20
             */
            return ($iNoteSur5 * 4);

        } else {
            return $default;
        }
    }

}