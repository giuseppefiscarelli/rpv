
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
       $json = $data;
      
       array_splice($json,0,3);

       $data['json_data'] = json_encode($json);
      /* var_dump($data['json_data']);
       
       die;
     */
      // $data['json_data'] = $json;
      
       //upload file

      $data['docu_nome_file_origine']=$file['name'];
      $id_ram = $data['id_RAM'];
      $id_veicolo = $data['doc_idvei'];
      $infovei =  getInfoVei($id_veicolo);
      $tipo_veicolo= $infovei['tipo_veicolo'];
      $progressivo = $infovei['progressivo'];

      $tipo_documento = $data['tipo_documento'];
      $docu_nome_file_origine =  $file['name'];
      $path_parts = pathinfo($docu_nome_file_origine);

      $docu_id_file_archivio = $id_ram."_".$tipo_veicolo."_".$progressivo."_".strtotime("now").".".$path_parts['extension'];
      $data['docu_id_file_archivio']=$docu_id_file_archivio;
      $data['docu_nome_file_origine']=$docu_nome_file_origine;
       move_uploaded_file($file['tmp_name'],$pathAlle.$docu_id_file_archivio);
       if(file_exists($pathAlle.$docu_id_file_archivio)){
        $data['tipo_veicolo'] = $tipo_veicolo;
        $data['progressivo'] = $progressivo;
        $res= newAllegato($data);

       }
       if($res){
        $res2=getAllegatoID($res);
       }
       
       echo json_encode($res2);
        

    break; 
    
    case 'newAllegatoMag':
      $file=$_FILES['file_allegato'];
      $data=$_POST;
      //var_dump($file);var_dump($data);die;
      //upload file
     $data['docu_nome_file_origine']=$file['name'];
     $id_ram = $data['id_RAM'];
     
     $data['doc_idvei']= 0;
     $id_veicolo = $data['tipo_doc_mag'];
     $data['tipo_documento'] = 99;
     $docu_nome_file_origine =  $file['name'];
     $path_parts = pathinfo($docu_nome_file_origine);
     $docu_id_file_archivio = $id_ram."_".$id_veicolo."_".strtotime("now").".".$path_parts['extension'];
     $data['docu_id_file_archivio']=$docu_id_file_archivio;
     $data['docu_nome_file_origine']=$docu_nome_file_origine;
      move_uploaded_file($file['tmp_name'],$pathAlle.$docu_id_file_archivio);
      if(file_exists($pathAlle.$docu_id_file_archivio)){
        $data['tipo_veicolo']=0;
        $data['progressivo']=0;
       $res= newAllegato($data);

      }
      if($res){
       $res2=getAllegatoID($res);
      }
      
      echo json_encode($res2);
       

    break; 

    case 'delAllegato':
      $id=$_REQUEST['id'];
      //var_dump($id);
      $res=delAllegatoID($id);
      echo json_encode($res);


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

    case 'getInfoVei':
      $id=$_REQUEST['id'];
      $res =getInfoVei($id);
      echo json_encode($res);


    break;  

    case 'getAllegato':
      $id=$_REQUEST['id'];
      $res =getAllegatoID($id);

      $test = array(
        $res,
        $res
        
      );
      echo json_encode($test);
      //echo json_encode($res);
    break;  
      
 
   }