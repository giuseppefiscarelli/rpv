
<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/istanze.php';
$params = $_GET;
switch ($action){
   
    case 'store':
      
    break; 
    case 'getTipDoc':

    $tipo_documento=$_REQUEST['tipo'];
    $res = getCampoDoc($tipo_documento);
    echo json_encode($res);
    break;
    case 'upVeicolo':
    $data=$_REQUEST;

    $res = upVeicolo($data);

    echo json_encode($res);

    break;

    case 'newAllegato':
       $file=$_FILES['file_allegato'];
       $data=$_POST;
      var_dump($_SERVER['DOCUMENT_ROOT']);
      var_dump($_SERVER);
       //$res= newAllegato($data,$file)
    
        

    break;    
      
   }