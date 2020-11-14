
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
    
       $res= newAllegato($data,$file,$pathAlle);
       $res2=getAllegatoID($res);
       echo json_encode($res2);
        

    break; 
    
    case 'getDocVei':
      $data=$_REQUEST['tipdoc'];
      $res = getTipoDocumento($data);
      echo json_encode($res);

    break  ;

    case 'getTipoDoc':
      $data=$_REQUEST['tipo'];
      $res =getTipDocumento($data);
      echo json_encode($res);
    break;  
      
 
   }