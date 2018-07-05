<?php
function prep_pdf($orientarion='portrait')
{
	$CI =& get_instance();
	$CI->cezpdf->selectFont(base_url().'/fonts');
	$all=$CI->cezpdf->openObjet();
	$CI->cezpdf->saveState();
	$CI->cezpdf->setStrokeColor(0,0,0,1);
	if ($orientarion=='portrait') {
		$CI->cezpdf->ezSetMargins(50,70,50,50);
		$CI->cezpdf->ezStartPageNumbers(500,28,8,,'{PAGENUM}',1);
		$CI->cezpdf->Line(20,40,578,40);
		$CI->cezpdf->AddText(50,32,8,'printed on'. date('m/d/Y'));
		$CI->cezpdf->AddText(50,22,8,'aqui va algo');
	}else{
		$CI->cezpdf->ezStartPageNumbers(750,28,8,,'{PAGENUM}',1);
		$CI->cezpdf->Line(20,40,800,40);
		$CI->cezpdf->AddText(50,32,8,'printed on'. date('m/d/Y'));
		$CI->cezpdf->AddText(50,22,8,'aqui va algo');
	}
	$CI->cezpdf->restoreState();
	$CI->cezpdf->closeObjet();
	$CI->cezpdf->addObjet($all,'all');
}

?>