<?php
/* Modif Îles aux trésors 
 redimensionnement et deplacement d'une image
*/
//error_reporting(E_ALL);

function setCorrumpt($_zCorrumpt){
	$_zKey="123";
	
	$_zKey = md5($_zKey);
	$zLetter = -1;
	$zNews = '';
	$_zCorrumpt = base64_decode($_zCorrumpt);
	$strlen = strlen($_zCorrumpt);
	for ( $i = 0; $i < $strlen; $i++ ){
		$zLetter++;
		if ( $zLetter > 31 ){
			$zLetter = 0;
		}
		$iOrdre = ord($_zCorrumpt{$i}) - ord($_zKey{$zLetter});
		if ( $iOrdre < 1 ){
			$iOrdre += 256;
		}
		$zNews .= chr($iOrdre);
	}
	return $zNews;

	return $_zCorrumpt;
}

global $db;

function resizePictureA ($_sImagePath, $_sImageResPath, $_iMaxWidth = 0, $_iMaxHeight = 0)
{

	
	//$_sImageResPath = PATH_ROOT_DIR . "/assets/upload/". $_sImageResPath ; 
	
	@ini_set ("memory_limit", -1) ;

	$tsImageInfos = getimagesize ($_sImagePath) ;

	$sImageMimeType = $tsImageInfos["mime"] ;
	$tsTokens = explode ("/", $sImageMimeType) ;
	$sImageType = strtoupper (trim ($tsTokens[1])) ;


	$createImageFromXXX = "imageCreateFrom" . $sImageType ;
	$imageXXX = "image" . $sImageType ;

	$oImgSrc = $createImageFromXXX ($_sImagePath) ;
	$iWidth = $tsImageInfos[0] ;
	$iHeight = $tsImageInfos[1] ;
	$iOrigWidth = $iWidth ;
	$iOrigHeight = $iHeight ;

	if (($iWidth < $_iMaxWidth) && ($iHeight < $_iMaxHeight))
	{
		@copy ($_sImagePath, $_sImageResPath) ;
	}
	elseif (($iWidth >= $_iMaxWidth) && ($iHeight >= $_iMaxHeight))
	{

		$rRatioWidth = $_iMaxWidth / $iWidth ;
		$rRationHeight = $_iMaxHeight / $iHeight ;

		$rRatio = ($rRatioWidth < $rRationHeight)  ? $rRatioWidth : $rRationHeight ;

		$iWidth = ceil ($iWidth * $rRatio) ;
		$iHeight = ceil ($iHeight * $rRatio) ;

		$oNewImg = imageCreateTrueColor ($iWidth, $iHeight) ;
		imageCopyResampled ($oNewImg, $oImgSrc, 0, 0, 0, 0, $iWidth, $iHeight, $iOrigWidth, $iOrigHeight) ;
		$imageXXX ($oNewImg, $_sImageResPath) ;

	}
	elseif ($iWidth >= $_iMaxWidth)
	{
		
		$rRatioWidth = $_iMaxWidth / $iWidth ;

		$iWidth = ceil ($iWidth * $rRatioWidth) ;
		$iHeight = ceil ($iHeight * $rRatioWidth) ;

		$oNewImg = imageCreateTrueColor ($iWidth, $iHeight) ;
		imageCopyResampled ($oNewImg, $oImgSrc, 0, 0, 0, 0, $iWidth, $iHeight, $iOrigWidth, $iOrigHeight) ;
		$imageXXX ($oNewImg, $_sImageResPath) ;

	}
	else
	{
		
		$rRationHeight = $_iMaxHeight / $iHeight ;
		
		$iWidth = ceil ($iWidth * $rRationHeight) ;
		$iHeight = ceil ($iHeight * $rRationHeight) ;

		$oNewImg = imageCreateTrueColor ($iWidth, $iHeight) ;
		imageCopyResampled ($oNewImg, $oImgSrc, 0, 0, 0, 0, $iWidth, $iHeight, $iOrigWidth, $iOrigHeight) ;
		$imageXXX ($oNewImg, $_sImageResPath) ;

	}
	
	@chmod ($_sImageResPath, 0666) ;

}

function imageCreateCorners($_iSourceImageFile, $iRadius = 20) {
	# test source image
	if (file_exists($_iSourceImageFile)) {
	  $iRes = is_array($oInfo = getimagesize($_iSourceImageFile));
	  }
	else $iRes = false;
 
	# open image
	if ($iRes) {
	  $iWidth = $oInfo[0];
	  $iHeight = $oInfo[1];
 
	  switch ($oInfo['mime']) {
		case 'image/jpeg': 
			$src = imagecreatefromjpeg($_iSourceImageFile);
		  break;
		case 'image/gif': 
			$src = imagecreatefromgif($_iSourceImageFile);
		  break;
		case 'image/png': 
			$src = imagecreatefrompng($_iSourceImageFile);
		  break;
		default:
		  $iRes = false;
		}
	  }
 
	# create corners
	if ($iRes) {
 
	  $iBorderQ = 10; # change this if you want
	  $iRadius *= $iBorderQ;
 
	  # find unique color
	  do {
		$r = rand(0, 255);
		$g = rand(0, 255);
		$b = rand(0, 255);
		}
	  while (imagecolorexact($src, $r, $g, $b) < 0);
 
	  $nw = $iWidth*$iBorderQ;
	  $nh = $iHeight*$iBorderQ;
 
	  $oImageg = imagecreatetruecolor($nw, $nh);
	  $alphacolor = imagecolorallocatealpha($oImageg, $r, $g, $b, 127);
	  imagealphablending($oImageg, false);
	  imagesavealpha($oImageg, true);
	  imagefilledrectangle($oImageg, 0, 0, $nw, $nh, $alphacolor);
 
	  imagefill($oImageg, 0, 0, $alphacolor);
	  imagecopyresampled($oImageg, $src, 0, 0, 0, 0, $nw, $nh, $iWidth, $iHeight);
 
	  imagearc($oImageg, $iRadius-1, $iRadius-1, $iRadius*2, $iRadius*2, 180, 270, $alphacolor);
	  imagefilltoborder($oImageg, 0, 0, $alphacolor, $alphacolor);
	  imagearc($oImageg, $nw-$iRadius, $iRadius-1, $iRadius*2, $iRadius*2, 270, 0, $alphacolor);
	  imagefilltoborder($oImageg, $nw-1, 0, $alphacolor, $alphacolor);
	  imagearc($oImageg, $iRadius-1, $nh-$iRadius, $iRadius*2, $iRadius*2, 90, 180, $alphacolor);
	  imagefilltoborder($oImageg, 0, $nh-1, $alphacolor, $alphacolor);
	  imagearc($oImageg, $nw-$iRadius, $nh-$iRadius, $iRadius*2, $iRadius*2, 0, 90, $alphacolor);
	  imagefilltoborder($oImageg, $nw-1, $nh-1, $alphacolor, $alphacolor);
	  imagealphablending($oImageg, true);
	  imagecolortransparent($oImageg, $alphacolor);
 
	  # resize image down
	  $dest = imagecreatetruecolor($iWidth, $iHeight);
	  imagealphablending($dest, false);
	  imagesavealpha($dest, true);
	  imagefilledrectangle($dest, 0, 0, $iWidth, $iHeight, $alphacolor);
	  imagecopyresampled($dest, $oImageg, 0, 0, 0, 0, $iWidth, $iHeight, $nw, $nh);
 
	  # output image
	  $iRes = $dest;
	  imagedestroy($src);
	  imagedestroy($oImageg);
	  }
 
	return $iRes;
}

function createRoundImage($_iSourceFile, $_zDestinationFile, $iRadius = 20){
	$roundImage = imageCreateCorners($_iSourceFile, $iRadius);
	imagepng($roundImage, $_zDestinationFile, 9);
 
	$zFilename = pathinfo($_zDestinationFile, PATHINFO_BASENAME);
	return $zFilename;
}
			
require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

$oPdf = new FPDF();
$oPdf->AddPage();






$oPdf->SetAutoPageBreak(290);

$oPdf->SetFillColor(255,255,255);
$oPdf->AddFont('trebuc','','trebuc.php');

$oPdf->SetFont('Arial','',11); 

if($type_photo == NULL){
	$zFilename = 'default.jpg';
	$zDestination = PATH_ROOT_DIR .'/assets/upload/'.$zFilename;
} else {
	$zFilename = $id.'.'.$type_photo;
	$zDestination = PATH_ROOT_DIR .'/assets/upload/'.$zFilename;
}

$iRadius = '100';

$oSize = getimagesize($zDestination, $info);

//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);

if($oSize[0]>300){
	resizePictureA($zDestination, $zDestination , "300", "300");
}


$oImage = imagecreatefrompng($zDestination);

$iSize = min(imagesx($oImage), imagesy($oImage));

$iDiff = (imagesy($oImage) - imagesx($oImage));

if(($iDiff > 1 && $iDiff < 20)){
	$iRadius = '140';
}

if( $iDiff == 0 && imagesx($oImage)<=300){
	$iRadius = '140';
}

if( $iDiff == 0 && imagesx($oImage)<150){
	$iRadius = '70';
}

if( $iDiff == 0 && empty(imagesx($oImage))){
	$iRadius = '135';
}

if( $iDiff >=20 && $iDiff <=70){
	$iRadius = '70';
}

$iCropWidth = imagesx($oImage);
$iCropHeight = imagesy($oImage);
	
$iSize = min($iCropWidth, $iCropHeight);


if($iCropWidth >= $iCropHeight) {
	 $oImagex= ($iCropWidth-$iCropHeight)/2;
	 $oImage2 = imagecrop($oImage, ['x' => $oImagex, 'y' => 0, 'width' => $iSize, 'height' => $iSize]);
}
else {
	$oImagey= ($iCropHeight-$iCropWidth)/2;
	$oImage2 = imagecrop($oImage, ['x' => 0, 'y' => $oImagey, 'width' => $iSize, 'height' => $iSize]);
}

if ($oImage2 !== FALSE) {
	if (file_exists(PATH_ROOT_DIR .'/assets/cv_ico/export-photo_'.$id.'.png')){
		unlink(PATH_ROOT_DIR .'/assets/cv_ico/export-photo_'.$id.'.png');
	}
	imagepng($oImage2, PATH_ROOT_DIR .'/assets/cv_ico/export-photo_'.$id.'.png');
}

if (file_exists(PATH_ROOT_DIR .'/assets/cv_ico/export-photo_'.$id.'.png')){
	$zDestination = PATH_ROOT_DIR.'/assets/cv_ico/export-photo_'.$id.'.png';
}

$oRoundedFilename = 'destination_'.$id.'.png';
$oRoundedDestination = PATH_ROOT_DIR .'/assets/cv_ico/'.$oRoundedFilename;

createRoundImage($zDestination, $oRoundedDestination, $iRadius);
$oPdf->SetX(0);
$oPdf->SetFillColor(56,122,169);
$zImage = PATH_ROOT_DIR .'/assets/cv_ico/destination_'.$id.'.png';

$oPdf->Rect($oPdf->getX(), $oPdf->getY()-10, 80, 900, 'F');
$oPdf->Cell(80,10,$oPdf->Image($zImage, $oPdf->getX()+20, $oPdf->getY()+10.5, 40),0,0,'C',1);


$zBorderLR = "";

$iIncrement = 70;
$oPdf->SetFont('Arial','',14); 
$oPdf->SetTextColor(255,255,255);
$oPdf->SetXY(0,$iIncrement);
$oPdf->SetFillColor(56,122,169);

$oPdf->multicell(80,6,utf8_decode(wordwrap($nom_prenom,20)),0,'C',1);

$oPdf->SetTextColor(0,0,0);

/*****************************************************************/
$iIncrement +=20;
$oPdf->SetXY(0,$iIncrement);
/*****************************************************************/

$oPdf->SetFont('Arial','',11); 

$zImage = PATH_ROOT_DIR .'/assets/cv_ico/tirer.png';
$oPdf->Cell(80,10,$oPdf->Image($zImage, $oPdf->getX()+5, $oPdf->getY(), 68),0,0,'C',0);

/*****************************************************************/
$iIncrement +=6;
$oPdf->SetXY(0,$iIncrement);
/*****************************************************************/

$zImage = PATH_ROOT_DIR .'/assets/cv_ico/adresse.png';
$oPdf->Cell(80,10,$oPdf->Image($zImage, $oPdf->getX()+36, $oPdf->getY(), 4),$zBorderLR,0,'C',0);

/*****************************************************************/
$iIncrement +=8;
$oPdf->SetXY(0,$iIncrement);
/*****************************************************************/

$zAdresse = utf8_decode($address);
$zAdresse1 = wordwrap($zAdresse, 30, "---");

$iNombreLigne =  substr_count($zAdresse1, '---', strpos($zAdresse1, '.') ); // 1
$iNombreLigne = ($iNombreLigne>1)?$iNombreLigne:0;


$oPdf->multicell(80,6,$zAdresse,$zBorderLR,'C',1);


/*****************************************************************/
$iIncrement +=10 + ($iNombreLigne*4);
$oPdf->SetXY(0,$iIncrement);
/*****************************************************************/

$zImage = PATH_ROOT_DIR .'/assets/cv_ico/tel.png';
$oPdf->Cell(80,10,$oPdf->Image($zImage, $oPdf->getX()+36, $oPdf->getY()+1, 5),$zBorderLR,0,'C',0);

/*****************************************************************/
$iIncrement +=10;
$oPdf->SetXY(0,$iIncrement);

$zPhone = $phone;
$zPhone = "+261 (0) " . substr($zPhone, 1, 14); 
//$zPhone = str_replace($phone[0], "+261 (0)",$zPhone);
/*****************************************************************/

$oPdf->multicell(80,6,$zPhone . "\n",$zBorderLR,'C');

/*****************************************************************/
$iIncrement +=10;
$oPdf->SetXY(0,$iIncrement);
/*****************************************************************/

$zImage = PATH_ROOT_DIR .'/assets/cv_ico/mails.png';
$oPdf->Cell(80,10,$oPdf->Image($zImage, $oPdf->getX()+35, $oPdf->getY()+1, 7.5),$zBorderLR,0,'C',0);

/*****************************************************************/
$iIncrement +=10;
$oPdf->SetXY(0,$iIncrement);
/*****************************************************************/

$oPdf->multicell(80,6,$email,$zBorderLR,'C');

/*****************************************************************/
$iIncrement +=10;
$oPdf->SetXY(0,$iIncrement);
/*****************************************************************/

$zImage = PATH_ROOT_DIR .'/assets/cv_ico/tirer.png';
$oPdf->Cell(80,10,$oPdf->Image($zImage, $oPdf->getX()+5, $oPdf->getY(), 68),$zBorderLR,0,'C',0);

/*****************************************************************/
$iIncrement +=10;
$oPdf->SetXY(5,$iIncrement);
/*****************************************************************/

$zImage = PATH_ROOT_DIR .'/assets/cv_ico/informations.png';
$oPdf->Cell(80,10,$oPdf->Image($zImage, $oPdf->getX()+12, $oPdf->getY()-5, 45),$zBorderLR,0,'C',0);

$zEnfant = "";
//$zInformation .= "Nationalité : Malagasy\n";
$zGenre = "";
if($genre==1){
	$zGenre = utf8_decode("Né");
} else {
	$zGenre = utf8_decode("Née");
}

$zNaissance = $zGenre . " le : ".utf8_decode($date_naiss)."";
$iIncrement +=8;
$oPdf->SetXY(5,$iIncrement);
$oPdf->multicell(75,6,$zNaissance,$zBorderLR,'L',1);

$zSituation = "Situation matrimoniale : ".utf8_decode($sit_mat)."\n";
$iIncrement +=8;
$oPdf->SetXY(5,$iIncrement);
$oPdf->multicell(75,6,$zSituation,$zBorderLR,'L',1);

if($nbr_enfant>0){
	$zS = "";
	if($nbr_enfant>1){
		$zS = "s";
	}
	$zEnfant = "Enfant".$zS." : ".$nbr_enfant."\n";
}
$iIncrement +=8;
$oPdf->SetXY(5,$iIncrement);
$oPdf->multicell(75,6,$zEnfant,$zBorderLR,'L',1);

/*****************************************************************/
$iIncrement +=10;
$oPdf->SetXY(0,$iIncrement);
/*****************************************************************/

$zImage = PATH_ROOT_DIR .'/assets/cv_ico/tirer.png';
$oPdf->Cell(80,10,$oPdf->Image($zImage, $oPdf->getX()+5, $oPdf->getY(), 68),$zBorderLR,0,'C',0);

/*****************************************************************/
$iIncrement +=8;
$oPdf->SetXY(5,$iIncrement);
/*****************************************************************/

$oPdf->SetFont('Arial','',14); 
$oPdf->SetTextColor(255,255,255);
$zTitre = "AUTRES";
$oPdf->multicell(75,6,$zTitre,$zBorderLR,'L',1);

$oPdf->SetFont('Arial','',11); 
$oPdf->SetTextColor(0,0,0);

$zInTeret = "";

$zUsername = setCorrumpt($db['default']['username']);
$zPassword = setCorrumpt($db['default']['password']);

$link = mysqli_connect($db['default']['hostname'], $zUsername, $zPassword, $db['default']['database']);

//$link = mysqli_connect("127.0.0.1", "root", "", "my_db");




$zSql = 'SELECT * FROM candidat_loisirs WHERE candidat_id ='.$id.''; 
$oQuery = mysqli_query($link,$zSql);
while ($oData = mysqli_fetch_array($oQuery)) {
	$zInTeret = $oData['libele'] ;
	/*****************************************************************/
	$iIncrement +=8;
	$oPdf->SetXY(5,$iIncrement);
	/*****************************************************************/
	$oPdf->multicell(75,6,$zInTeret,$zBorderLR,'L',1);
}

$zSql = 'SELECT * FROM candidat_loisirsannexe WHERE candidat_id ='.$id.''; 
$oQuery = mysqli_query($link,$zSql);
while ($oData = mysqli_fetch_array($oQuery)) {
	$zInTeret = utf8_decode($oData['libele']);
	/*****************************************************************/
	$iIncrement +=8;
	$oPdf->SetXY(5,$iIncrement);
	/*****************************************************************/
	$oPdf->multicell(75,6,$zInTeret,$zBorderLR,'L',1);
}


$oPdf->SetXY(82,10);
for ($iBoucle=1;$iBoucle<=8;$iBoucle++){

	$zBorder1 = "TLRB";
	$zBorder2 = "";
	if($iBoucle==10){
		$zBorder1 = "";
	} 
	$oPdf->SetFont('Arial','',11);
	$oPdf->SetTextColor(0,0,0);
	$oPdf->SetFillColor(255,255,255);
	$oPdf->SetX(81);

	$zSql = 'SELECT * FROM candidat_stage where candidat_id = '.$id.' AND stage_name != ""'; 
	$zQuery = $this->db->query($zSql);
	$toStage =  $zQuery->result_array();

	switch ($iBoucle){

		case 1:
			$zImage = PATH_ROOT_DIR .'/assets/cv_ico/diplome_obtenue.png';
			$oPdf->Cell(130,15,$oPdf->Image($zImage, $oPdf->getX()+1, $oPdf->getY()+1, 127),$zBorder2,0,'C',0);
			$oPdf->Ln();
			break;

		case 2:
			$zSql = 'SELECT * FROM candidat_diplome where candidat_id = '.$id.' AND diplome_name !="" order by diplome_date desc'; 
			$zQuery = mysqli_query($link,$zSql);
			while ($oData = mysqli_fetch_array($zQuery)) {
				$oPdf->SetX(85);
				$zData = utf8_decode($oData['diplome_date']).' : '.utf8_decode($oData['diplome_name']).', '.utf8_decode($oData['diplome_disc']).', '.utf8_decode($oData['diplome_etab']).', '.utf8_decode($oData['diplome_pays']);
				$zData = str_replace("?","'",$zData);
				$oPdf->multicell(130,6,wordwrap($zData,63),$zBorder2,'L',1);
				$oPdf->Ln(0);
			}
			$oPdf->SetX(85);
			$oPdf->multicell(130,2,'',$zBorder2,'L',1);
			break;

		
		case 3:
			
			if(sizeof($toStage)>0){
				$zImage = PATH_ROOT_DIR .'/assets/cv_ico/stage.png';
				$oPdf->Cell(130,15,$oPdf->Image($zImage, $oPdf->getX()+1, $oPdf->getY()+1, 127). "\n",$zBorder2,0,'C',0);
				$oPdf->Ln();
			}
			break;
		
		case 4:
			if(sizeof($toStage)>0){
				foreach($toStage as $oData) {
					$oPdf->SetX(85);
					$zData = utf8_decode($oData['stage_annee']).' : '.utf8_decode($oData['stage_name']).', '.utf8_decode($oData['stage_etablissement']).', '.utf8_decode($oData['stage_pays']);
					$zData = str_replace("?","'",$zData);
					$oPdf->multicell(130,6,wordwrap($zData,63),$zBorder2,'L',1);
					$oPdf->Ln(0);
				}
				$oPdf->SetX(85);
				$oPdf->multicell(130,2,'',$zBorder2,'L',1);
			}
			break;

		
		case 5:
			$zImage = PATH_ROOT_DIR .'/assets/cv_ico/experience.png';
			$oPdf->Cell(130,15,$oPdf->Image($zImage, $oPdf->getX()+1, $oPdf->getY()+1, 127),$zBorder2,0,'C',0);
			$oPdf->Ln();
			break;
		

		case 6:
			$zSql = 'SELECT * FROM candidat_parcours where candidat_id = '.$id.' AND date_debut !=""  order by date_debut desc'; 
			$zQuery = mysqli_query($link,$zSql);
			while ($oData = mysqli_fetch_array($zQuery)) {
				$oPdf->SetX(85);
				$zData = utf8_decode($oData['date_debut']).' - '.utf8_decode($oData['date_fin']).' : '.utf8_decode($oData['par_poste']).', '.utf8_decode($oData['par_departement']);
				$zData = str_replace("?","'",$zData);
				$oPdf->multicell(130,6,wordwrap($zData,63),$zBorder2,'L',1);
				$oPdf->Ln(0);
			}
			$oPdf->SetX(85);
			$oPdf->multicell(130,2,'',$zBorder2,'L',1);
			break;
		
		case 7:
			$zImage = PATH_ROOT_DIR .'/assets/cv_ico/competences.png';
			$oPdf->Cell(130,15,$oPdf->Image($zImage, $oPdf->getX()+1, $oPdf->getY()+1, 127),$zBorder2,0,'C',0);
			$oPdf->Ln();
			break;
		
		case 8:
			$oPdf->SetX(85);
			$zDomaine = utf8_decode($domaine);
			$zDomaine = str_replace("?","'",$zDomaine);
			$oPdf->multicell(130,6,$zDomaine,$zBorder2,'L',1);
			$oPdf->Ln();
			break;
		

		default:

			break;
	}
}

$oPdf->SetFont('Arial','',9);
$oPdf->SetTextColor(0,0,0);
$oPdf->SetXY(130,287);
$oPdf->multicell(75,6,utf8_decode("© 2019 : http://rohi.mef.gov.mg:8088/ROHI"),$zBorderLR,'C',1);


$oPdf->Ln();

$oPdf->Output();

?>