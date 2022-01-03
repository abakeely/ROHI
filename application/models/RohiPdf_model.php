<?php
require(APPLICATION_PATH ."application/models/PdfRotate_model.php");

class RohiPdf_model extends PdfRotate
{
	public function init(){
		return new RohiPdf_model();
	}
	public function Header(){
		//Put the watermark
		$this->SetFont('Arial','B',90);
		$this->SetTextColor(255,192,203);
		$this->RotatedText(80,250,'ROHI',45);
	}

	public function RotatedText($x, $y, $txt, $angle){
		//Text rotated around its origin
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
}

?>
