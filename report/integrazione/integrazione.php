<?php

/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once  '../../vendor/autoload.php';
require_once  '../../model/istanze.php';
require_once  '../../functions.php';

//$rep = getReportId($_GET['id']);
//$user = getIstanza($rep['id_RAM']);
///$dettagli = getDettReport($_GET['id']);
//$tipo = $_GET['tipo'];
//$tipo_istanza= getTipoIstanza($user['tipo_istanza']);

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 2),true);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->pdf->SetProtection(array('print','copy'));
    $html2pdf->setDefaultFont('times', 'serif');
    ob_start();
    //include dirname(__FILE__).'/res/test.php';
    
     
    
    //$content = ob_get_clean();
    //$path = $pathReport;
    //$html2pdf->writeHTML($content);
    $filename = $rep['id']."_".$rep['id_RAM']."_".time();
    
    //$html2pdf->createIndex('Sommaire', 30, 12, false, true, 2, null, '10mm');
    if($tipo =="P"){
        $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
        $html2pdf->output($filename.".pdf",'I');
    }
    if($tipo =="D"){
        $html2pdf->output($path.$filename.".pdf",'FD');
    }
    if($tipo =="S"){
        $html2pdf->output($path.$filename.".pdf",'F');
        echo $filename.".pdf";
    }
    
   
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
