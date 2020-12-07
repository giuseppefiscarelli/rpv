<?php

session_start();
require_once 'functions.php';
$id = getParam('id','');
require 'model/istanze.php';

$res =getAllegatoID($id);

       
      $file = $pathAlle.$res['docu_id_file_archivio']; 
      $filename = $res['docu_nome_file_origine']; 
  
      header("Content-type: application/pdf");
           
            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');
      @readfile($file);