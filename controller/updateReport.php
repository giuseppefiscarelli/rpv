
<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/pec.php';
$params = $_GET;
if(!isUserLoggedin()){
    exit;
   }
switch ($action){

    case 'getReportId':
        $id = $_REQUEST['id'];
        //var_dump($id);
        $res=getReportId($id);
        $istanza = getInfoPecIstanza($res['id_RAM']);
        $tipo_istanza = getTipoIstanza($istanza['tipo_istanza']);
        if ($res){
            $tipo = getInfoReport($res['tipo_report']);
            $istanza = getIstanza($res['id_RAM']);
            $attr = getDettagliReport($id);
            $json = [
                'data' => $res,
                'type' => $tipo,
                'istanza' => $istanza,
                'attr'=> $attr,
                'info' => 'Rpv '.$res['id_RAM'].'/'.$tipo_istanza['anno']
            ];
            
            echo json_encode($json);
        }
       

    break;
    case 'upDettaglioReport':
        $data = $_REQUEST;
        //var_dump($data);die;
        if($data['data_verbale_id']){
            $data['id'] = $data['data_verbale_id'];
            $data['des'] =  $data['data_verbale_des'];
            $res = upDettaglioReport($data);
        }
        if($data['data_prot_id']){
            $data['id'] = $data['data_prot_id'];
            $data['des'] =  $data['data_prot_des'];
            $res = upDettaglioReport($data);
        }

       
        echo json_encode($res);
    break;
}