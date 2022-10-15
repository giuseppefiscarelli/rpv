<?php


  if(!empty($_SESSION['message'])){
    $message = $_SESSION['message'];
    $alertType = $_SESSION['success'] ? 'success':'danger';
    $iconType = $_SESSION['success'] ? 'check':'exclamation-triangle';
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  }
  $id = getParam('id',0);
  if(!isUserUser()){
 
    if($id){
        $i = getIstanza($id);
    }
  }else{
    $utente= $_SESSION['userData']['email'];
    $i = getIstanzaUser($utente,$id);
  }
  //var_dump($i);die;
  $tipo_istanza = getTipoIstanza($i['tipo_istanza']);
  //$tipiCom= getTipiComunicazione();
  $rend = checkRend($i['id_RAM']);
  //var_dump($rend);die;
  if(!$rend){
    createSrtructure($i);
    $rend = checkRend($i['id_RAM']);
  } 
 
  //var_dump($i['eliminata']);
  if(isUserAdmin()){
    
    require_once 'view/istanze/istanzaAdmin.php';
    //require_once 'view/istanze/istanza_page.php';
  }else{

 // var_dump(count($notifiche));
 $_SESSION['userData']['check_ram'] = $i['id_RAM'];
  require_once 'view/istanze/istanza_page.php';
 }
 
?>