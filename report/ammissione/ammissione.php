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
$rep = getReportId($_GET['id']);
$user = getistanza($rep['id_RAM']);
$dettagli = getDettReport($_GET['id']);
$data_RAM = getistanzaView($rep['id_RAM']);
$tipo_istanza= getTipoIstanza($user['tipo_istanza']);
$contr_rottamazione = 0;
$check_rottamazione = checkMaggRottamazione($rep['id_RAM']);
$prot=0;
$data_prot='';
$data_verb='';
$prot_amm=0;
$data_doc='';

    foreach($dettagli as $dett){

        if($dett['tipo']==='1'){
            $prot_amm = $dett['descrizione'];
        }
        if($dett['tipo']==='2'){
            $data_prot = $dett['descrizione'];
        }
        if($dett['tipo']==='3'){
            $data_verb = $dett['descrizione'];
        }
        if($dett['tipo']==='4'){
            $prot = $dett['descrizione'];
        }
        if($dett['tipo']==='5'){
            $data_prot = $dett['descrizione'];
        }
    }
//svar_dump($data_prot, $data_verb,$rep);die;    
$data = reportAmmissione($rep['id_RAM']);
//var_dump($data); die;

$tot4=0;

$qnt5A1=0;
$tot5A1=0;

$qnt5A2=0;
$tot5A2=0;

$qnt5A3=0;
$tot5A3=0;

$qnt5A4=0;
$tot5A4=0;

$qnt5B1=0;
$tot5B1=0;
$qnt5B3=0;
$tot5B3=0;
$qnt5B2=0;
$tot5B2=0;





foreach ($data as $d){
    

    if ($d['art_dm'] =='5A1'){
        $qnt5A1 = $d['qta'];
        $tot5A1 = $d['contributo'];
    }
    if ($d['art_dm'] =='5A2'){
        $qnt5A2 = $d['qta'];
        $tot5A2 = $d['contributo'];
    }
    if ($d['art_dm'] =='5A3'){
        $qnt5A3= $d['qta'];
        $tot5A3  = $d['contributo'];
    }
    if ($d['art_dm'] =='5A4'){
        $qnt5A4 = $d['qta'];
        $tot5A4 = $d['contributo'];
    }

    if ($d['art_dm'] =='5B1'){
        $qnt5B1 = $d['qta'];
        $tot5B1 = $d['contributo'];
    }
    if ($d['art_dm'] =='5B2'){
        $qnt5B2 = $d['qta'];
        $tot5B2 = $d['contributo'];
    }
    if ($d['art_dm'] =='5B3'){
        $qnt5B3= $d['qta'];
        $tot5B3 = $d['contributo'];
    }
  
}
//var_dump($data); die;

$totFin = $tot5A1+$tot5A2+$tot5A3+$tot5A4+$tot5B1+$tot5B2+$tot5B3;
$tipo = $_GET['tipo'];

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 2),true);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->pdf->SetProtection(array('print','copy'));
    $html2pdf->setDefaultFont('Times', 'Serif');
    ob_start();
    include dirname(__FILE__).'/res/ammissione.php';
    
     
    
    $content = ob_get_clean();
    $path = $pathReport;
    $html2pdf->writeHTML($content);
    $filename = $rep['id']."_".$rep['id_RAM']."_".time();
    //$html2pdf->createIndex('Sommaire', 30, 12, false, true, 2, null, '10mm');
    //$html2pdf->output($path.$filename.".pdf",'FI');
    ob_end_clean();
    if($tipo =="P"){
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