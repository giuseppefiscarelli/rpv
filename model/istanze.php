<?php
function delete(int $id){

    /**
     * @var $conn mysqli
     */

      $conn = $GLOBALS['mysqli'];

        $sql ='DELETE FROM istanza WHERE id = '.$id;

        $res = $conn->query($sql);
        
        return $res && $conn->affected_rows;
    
    
}
function getStatoIstanza($stato){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ="SELECT * FROM stati_istanza WHERE cod = '$stato'";
  //echo $sql;
  $res = $conn->query($sql);
  
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;
}
function getStatiIstanza(){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $records=[];
  $sql ='SELECT * FROM stati_istanza ';
  //echo $sql;
  $res = $conn->query($sql);
        
       
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;
}
function getTipoIstanza($tipo_istanza){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ='SELECT * FROM tipo_istanza WHERE id = '.$tipo_istanza;
  //echo $sql;
  $res = $conn->query($sql);
  
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;
}
function getTipiIstanza(){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $records=[];
  $sql ='SELECT * FROM tipo_istanza ';
  //echo $sql;
  $res = $conn->query($sql);
        
       
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;
}
function getIstanza(int $id){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ='SELECT * FROM istanza WHERE id_RAM = '.$id;
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}
function getIstanzaUser($email,$id){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
    $result = [];
      $sql ="SELECT * FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and '$email' = xml.pec and istanza.eliminata !=1 and istanza.id =$id";
     // echo $sql;
      $res = $conn->query($sql);
      
     
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}
function getIstanzeUser(array $params = []){

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
      $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
        $search1 = $conn->escape_string($search1);
        $search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
        $search3 = $conn->escape_string($search3);
      $records = [];
      
      $now=date("Y-m-d H:i:s");
        $tipo= getTipoIstanza($search3);
        $data_inizio = $tipo['data_invio_inizio'];
        $data_fine = $tipo['data_invio_fine'];
        $data_rend_inizio = $tipo['data_rendicontazione_inizio'];
        $data_rend_fine = $tipo['data_rendicontazione_fine'];

       // $sql ="SELECT * FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and '$email' = xml.pec and (istanza.eliminata is null or trim(eliminata) = '') and xml.data_invio between '2020-11-11 10:00:00' and '2020-11-30 08:00:00'";
       $sql ="SELECT istanza.id as idIst, istanza.*, xml.id as xmlid , xml.* FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and '$search1' = xml.pec and istanza.eliminata !=1 and xml.data_invio between '$data_inizio' and '$data_fine'";

        //echo $sql;
        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {

            $row['id'] = $row['idIst'];
            $stato=checkRend($row['id_RAM']);
            $tipo_ist = getTipoIstanza($row['tipo_istanza']);
           // var_dump($tipo_ist);
            $row['stato_des']='';
            if($tipo_ist['data_invio_inizio']<date("Y-m-d H:i:s")){
              if($stato){
                  if($stato['aperta']==1){
                    $row['stato'] = 'C';
                  }elseif($stato['aperta']==0){
                    $row['stato'] = 'D';
                    $row['stato_des'] ='<br>Rendicondazione chiusa il '.date("d/m/Y", strtotime($stato['data_chiusura']));
                  }
                  if($stato['data_annullamento']){
                    $row['stato'] = 'B';
                    $row['stato_des'] ='<br>Annullata da impresa ';
                  }
                  if(($tipo_ist['data_rendicontazione_fine']<$now&&$stato['aperta']==1)){
                    $row['stato'] = 'E';
                    $row['stato_des'] ='<br>Tempi di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_ist['data_rendicontazione_fine']));
                  } 
                
              }else{
                $row['stato'] = 'A';
                if($tipo_ist['data_rendicontazione_fine']<$now){
                  $row['stato'] = 'E';
                  $row['stato_des'] ='<br>Tempi di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_ist['data_rendicontazione_fine']));
                } 
              }
            
            }
           
           
              $records[] = $row;
           
              
              
          }

        }

    return $records;
    
    
}
function getIstanze( array $params = []){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

      $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_invio';
      if($orderBy){
        if($orderBy=='data_invio'){
          $orderBy='xml.data_invio';
        }
        elseif($orderBy=='idRAM'){
          $orderBy='istanza.id_RAM';
        }
        elseif($orderBy=='ragione_sociale'){
          $orderBy='istanza.ragione_sociale';
        }
        elseif($orderBy=='pec_impr'){
          $orderBy='istanza.pec_impr';
        }
      }
      $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
      $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
      $page = (int)array_key_exists('page', $params) ? $params['page'] : 0;
      $start =$limit * ($page -1);
     
      $now =date("Y-m-d H:i:s");
      if($start<0){
        $start = 0;
      }
      $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
      $search1 = $conn->escape_string($search1);
      $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
      $search2 = $conn->escape_string($search2);
      $search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
      $search3 = $conn->escape_string($search3);
      $search4 = array_key_exists('search4', $params) ? $params['search4'] : '';
      $search4 = $conn->escape_string($search4);
      if($orderDir !=='ASC' && $orderDir !=='DESC'){
        $orderDir = 'ASC';
      }
      $records = [];

      if ($search3){
        $tipo= getTipoIstanza($search3);
        $data_inizio = $tipo['data_invio_inizio'];
        $data_fine = $tipo['data_invio_fine'];
        $data_rend_inizio = $tipo['data_rendicontazione_inizio'];
        $data_rend_fine = $tipo['data_rendicontazione_fine'];
       
       }
       //var_dump($tipo);
      if($search4){

        if($search4=='A'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM not in( SELECT id_RAM FROM `rendicontazione`)';
        }
        if($search4=='A'&&$data_rend_fine<$now){
          $parA = ' and istanza.id_RAM =0';
          
       }
        if($search4=='B'){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE data_annullamento IS NOT NULL)';
        }
        /*
        if($search4=='B'&&$data_rend_fine<$now){
          $parA = ' and istanza.id_RAM  not in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=0 and data_chiusura IS NOT NULL)';
        }*/
        if($search4=='C'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=1 and data_chiusura IS NULL)';
        }
        if($search4=='C'&&$data_rend_fine<$now){
           $parA = ' and istanza.id_RAM =0';

        }
        if($search4=='D'){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=0 and data_chiusura IS NOT NULL)';
        }
        if($search4=='E'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM =0';
        }
        if($search4=='E'&&$data_rend_fine<$now){
          $parA = ' and (istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=1 and data_chiusura IS NULL) OR istanza.id_RAM not in( SELECT id_RAM FROM `rendicontazione`))';

        }


      }
      
      $sql ="SELECT istanza.*, xml.data_invio, xml.pec FROM istanza  INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id ";
      $sql .=" and istanza.eliminata != '1'";


     // $sql ="SELECT istanza.*, xml.data_invio, xml.pec FROM istanza  INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and (istanza.eliminata is null or trim(eliminata) = '' or istanza.eliminata = '2')";
    
      if ($search1){
        $sql .=" AND xml.pec LIKE '%$search1%' ";
        
      }
      if ($search2){
          $sql .=" AND istanza.id_RAM LIKE '%$search2%' ";
          
        }
        if ($search3){
          $sql .=" and xml.data_invio between '$data_inizio' and '$data_fine'";
          $sql .=" AND istanza.tipo_istanza = $search3 ";
          
        }
        if($search4){
          $sql .= $parA;
        }
      $sql .= " ORDER BY $orderBy  $orderDir LIMIT $start, $limit";
     //echo $sql;

      $res = $conn->query($sql);
      if($res) {

        while( $row = $res->fetch_assoc()) {


          $stato=checkRend($row['id_RAM']);
         
          $tipo_ist = getTipoIstanza($row['tipo_istanza']);
          //var_dump($tipo_ist);
          $row['stato_des']='';
          if($tipo_ist['data_invio_inizio']<date("Y-m-d H:i:s")){
            if($stato){
                if($stato['aperta']==1){
                  $row['stato'] = 'C';
                }elseif($stato['aperta']==0){
                  $row['stato'] = 'D';
                  $row['stato_des'] ='<br>Rendicondazione chiusa il '.date("d/m/Y", strtotime($stato['data_chiusura']));
                }
                if($stato['data_annullamento']){
                  $row['stato'] = 'B';
                  $row['stato_des'] ='<br>Annullata da impresa ';
                }
                if(($tipo_ist['data_rendicontazione_fine']<$now&&$stato['aperta']==1)){
                  $row['stato'] = 'E';
                  $row['stato_des'] ='<br>Termine per la rend. scaduti il '.date("d/m/Y",strtotime($tipo_ist['data_rendicontazione_fine']));
                } 
              
            }else{
              $row['stato'] = 'A';
              if($tipo_ist['data_rendicontazione_fine']<$now){
               
                $row['stato'] = 'E';
                $row['stato_des'] ='<br>Termine per la rend. scaduti il '.date("d/m/Y",strtotime($tipo_ist['data_rendicontazione_fine']));
              } 
            }
          
          }
         
         
            $records[] = $row;
         
            
            
        }

      }

  return $records;

}
function countIstanze( array $params = []){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

      $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'id';
      $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
      $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
      $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
      $search1 = $conn->escape_string($search1);
      $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
      $search2 = $conn->escape_string($search2);
      $search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
      $search3 = $conn->escape_string($search3);
      $search4 = array_key_exists('search4', $params) ? $params['search4'] : '';
      $search4 = $conn->escape_string($search4);
      if($orderDir !=='ASC' && $orderDir !=='DESC'){
        $orderDir = 'ASC';
      }
      $now=date("Y-m-d H:i:s");
      $totalUser = 0;
      if ($search3){
        $tipo= getTipoIstanza($search3);
        $data_inizio = $tipo['data_invio_inizio'];
        $data_fine = $tipo['data_invio_fine'];
        $data_rend_inizio = $tipo['data_rendicontazione_inizio'];
        $data_rend_fine = $tipo['data_rendicontazione_fine'];

      
       }
      if($search4){

        if($search4=='A'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM not in( SELECT id_RAM FROM `rendicontazione`)';
        }
        if($search4=='B'){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE data_annullamento IS NOT NULL)';
        }
        /*
        if($search4=='B'&&$data_rend_fine<$now){
          $parA = ' and istanza.id_RAM  not in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=0 and data_chiusura IS NOT NULL)';
        }
        */
        if($search4=='C'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=1 and data_chiusura IS NULL)';
        }
        if(($search4=='A'||$search4=='C')&&$data_rend_fine<$now){
           $parA = ' and istanza.id_RAM =0';

        }
        if($search4=='D'){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=0 and data_chiusura IS NOT NULL)';
        }
        if($search4=='E'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM =0';
        }
        if($search4=='E'&&$data_rend_fine<$now){
          $parA = ' and (istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=1 and data_chiusura IS NULL) OR istanza.id_RAM not in( SELECT id_RAM FROM `rendicontazione`))';

        }

      }
      
      
      
      $sql ="SELECT count(*) as totalUser FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and  istanza.eliminata !='1' ";
   

     //$sql ="SELECT count(*) as totalUser FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and (istanza.eliminata is null or trim(eliminata) = '' or istanza.eliminata='2') ";
      if ($search1){
        $sql .=" AND xml.pec LIKE '%$search1%' ";
        
      }
      if ($search2){
          $sql .=" AND istanza.id_RAM LIKE '%$search2%' ";
          
        }
        if ($search3){
          $sql .=" and xml.data_invio between '$data_inizio' and '$data_fine'";
          $sql .=" AND istanza.tipo_istanza = $search3 ";
          
        }
        if($search4){
          $sql .= $parA;
        }
      //  echo $sql;
      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $totalUser = $row['totalUser'];
      }

  return $totalUser;

}
function countTotIstanze( array $params = []){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

      $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'id';
      $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
      $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
      $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
      $search1 = $conn->escape_string($search1);
      $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
      $search2 = $conn->escape_string($search2);
      if($orderDir !=='ASC' && $orderDir !=='DESC'){
        $orderDir = 'ASC';
      }
      $totalUser = 0;

      

      $sql ="SELECT count(*) as totalUser FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id ";
      if ($search1){
        $sql .=" AND xml.pec LIKE '%$search1%' ";
        
      }
      if ($search2){
          $sql .=" AND istanza.id_RAM LIKE '%$search2%' ";
          
        }
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $totalUser = $row['totalUser'];
      }

  return $totalUser;

}
function getCatInc(){
  
    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $sql = 'SELECT * FROM categoria_incentivo';
    
    
    $records = [];

    $res = $conn->query($sql);
    if($res) {

      while( $row = $res->fetch_assoc()) {
          $records[] = $row;
          
      }

    }

   return $records;



}
function getCategoria($cod){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = "SELECT * FROM categoria_incentivo where ctgi_codice = '$cod'";
  
  
  $result = [];

  $res = $conn->query($sql);
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;



}
function getTipoVei($cat){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_veicolo where codice_categoria_incentivo='.$cat.' order BY tpvc_codice ASC';
  
  
  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

 return $records;



}
function checkRend($idRam){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ='SELECT * FROM rendicontazione WHERE id_RAM = '.$idRam;
  //echo $sql;
  $res = $conn->query($sql);
  
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;

}
function createSrtructure($data){
  /**
   * @var $conn mysqli
   */
    //var_dump($data);
  $conn = $GLOBALS['mysqli'];

  $tip_vei_1=$data['nv1'];
  $tip_vei_2=$data['nv2'];
  $tip_vei_3=$data['nv3'];
  $tip_vei_4=$data['nv4'];
  $tip_vei_5=$data['nv5'];
  $tip_vei_6=$data['nv6'];
  $tip_vei_7=$data['nv7'];
 

 for ($i = 1; $i<=7;++$i){
      $tipo = "tip_vei_$i";
      //$tipo = intval($tipo);
      //var_dump($$tipo);
       //echo $$tipo;
       
       //echo "cat ".$i."<br>";
       $vei = intval($$tipo);
       if($vei>0){
            for($v=1;$v<=$vei;++$v){
              $tpvc= getTipoVeicolo($i);
              //var_dump($tpvc['tpvc_codice']);
              $tpvc_codice=$tpvc['tpvc_codice'];
              //echo 'progressivo #'.$v. "tipo ".$tpvc_codice."id_ram ".$data['id_RAM']."<br>";
              insertStrAlle($v,$tpvc_codice,$data['id_RAM']);
            }

       }
      
 }

      $result=0;
      $id_RAM=$data['id_RAM'];
      $user=getUserLoggedEmail();
      $sql ='INSERT INTO rendicontazione (id, id_RAM, aperta,user) ';
      $sql .= "VALUES (NULL, $id_RAM, 1,'$user') ";
      
     // echo $sql;
      $res = $conn->query($sql);
      
      if($res ){
        $result =  $conn->affected_rows;
        $log=[];
        $log['user']['email']=$_SESSION['userData']['email'];
        $log['log_funzione']="Apertura Rendicontazione";
        $log['message']="Primo Accesso";
        $log['success']=true;
        writelog($log);

        
      }else{
        $result -1;  
      }
    return $result;
    //echo($result);die;

 

  

}
function getTipoVeicolo($tipo){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_veicolo WHERE tpvc_codice='.$tipo ;
  
  
  $result = [];

  $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;




}
function insertStrAlle($prog,$tipo,$idram){
    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $result=0;
    $sql ='INSERT INTO veicolo (id, id_RAM, tipo_veicolo, progressivo) ';
    $sql .= "VALUES (NULL, $idram, '$tipo', $prog) ";
    
    //echo $sql;die;
    $res = $conn->query($sql);
    
    if($res ){
      $result =  $conn->affected_rows;
      
    }else{
      $result -1;  
    }
  return $result;


}
function countCatVei( $cat,$id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM veicolo';

          $sql .=" WHERE tipo_veicolo = $cat and id_RAM = $id_RAM";
       
     
        //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function countCatVeiTipoac( $cat,$id_RAM,$progressivo){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $result = [];

      

      $sql = 'SELECT *  FROM veicolo';

          $sql .=" WHERE tipo_veicolo = $cat and id_RAM = $id_RAM and tipo_acquisizione='01' and progressivo = $progressivo";
       
    
        //  echo $sql;
      
        $res = $conn->query($sql);
      
        if($res && $res->num_rows){
          $result = $res->fetch_assoc();
          
        }
      return $result;

}
function checkTipVei($codice){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

    
  $total = 0;
  
  $sql = 'SELECT tpvc_codice as totalUser FROM tipo_veicolo';

  $sql .=" WHERE codice_categoria_incentivo = $cat ";


 // echo $sql;


  $res = $conn->query($sql);
  if($res) {

  $row = $res->fetch_assoc();
  $totalUser = $row['totalUser'];
  }

}
function getRowVeicolo($tipo,$id_RAM){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM veicolo WHERE tipo_veicolo='.$tipo.' and id_RAM = '.$id_RAM.' Order BY progressivo ASC' ;
  $records = [];
  //echo $sql;
  
  $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;



}
function getTipoDocumento($cod){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tv_td where codice_tipo_veicolo='.$cod;
  //echo $sql;
  $records = [];
 
  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
       
       
             
    }

  }
    
  

 return $records;


}
function getTipDocumento($tipo_documento){ 
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_documento where tdoc_codice='.$tipo_documento;
  //echo $sql;
  $records = [];

  $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;


}
function getTipDoc($tipo_documento){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT tdoc_descrizione as descrizione FROM tipo_documento where tdoc_codice='.$tipo_documento;
  //echo $sql;
  $des = 0;

  $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $des = $row['descrizione'];
      }
      return $des;


}
function getCampoDoc($tipo_documento){
   /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  
  $sql = 'SELECT * FROM td_campi WHERE cod_documento ='.$tipo_documento;
  //echo $sql;
  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

 return $records;



}
function getAllegato($tipo_documento,$id_RAM,$id_veicolo){
    /**
    * @var $conn mysqli
    */

  $conn = $GLOBALS['mysqli'];
  
  $sql = 'SELECT * FROM allegato WHERE tipo_documento ='.$tipo_documento.' and id_ram ='.$id_RAM.' and attivo ="s"';
  //echo $sql;
  $result = [];

  $res = $conn->query($sql);
      
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;



}
function getAllegatoID($id){
  /**
  * @var $conn mysqli
  */

    $conn = $GLOBALS['mysqli'];

    $sql = 'SELECT * FROM allegato WHERE id ='.$id;
    //echo $sql;
    $result = [];

    $res = $conn->query($sql);
          
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;



}
function delAllegatoID($id){
  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  
  $sql ='UPDATE allegato SET ';
  $sql .= "attivo = 'c'";
  $sql .=' WHERE id = '.$id;
  //print_r($data);
  //echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    
  }else{
    $result -1;  
  }
  return $result;



}
function getAllegati($id_RAM,$tipo_veicolo,$progressivo){
  /**
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];
  
  $sql = 'SELECT * FROM allegato WHERE id_ram ='.$id_RAM.' and tipo_veicolo ='.$tipo_veicolo.' and progressivo='.$progressivo.' and attivo="s" ';
  //echo $sql;
  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;



}
function upVeicolo($data){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $id = $conn->escape_string($data['id']);
 
  $targa = $conn->escape_string($data['targa']);
  $marca = $conn->escape_string($data['marca']);
  $modello = $conn->escape_string($data['modello']);
  $tipo_acquisizione = $conn->escape_string($data['tipo']);
  $costo = $conn->escape_string($data['costo']);
  $user = $_SESSION['userData']['email'];
 


  $result=0;
  $sql ='UPDATE veicolo SET ';
  $sql .= "targa = '$targa', marca = '$marca', modello = '$modello', tipo_acquisizione = '$tipo_acquisizione', costo = $costo, user = '$user'";
  $sql .=' WHERE id = '.$id;
  //print_r($data);
  //echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    
  }else{
    $result -1;  
  }
  return $result;




}
function newAllegato($data){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $id_ram = $conn->escape_string($data['id_RAM']);
  $tipo_veicolo = $conn->escape_string($data['tipo_veicolo']);
  if(!$tipo_veicolo){
    $tipo_veicolo = 0;
  }
  $progressivo = $conn->escape_string($data['progressivo']);
  if(!$progressivo){
    $progressivo = 0;
  }
  $tipo_documento = $conn->escape_string($data['tipo_documento']);
  $docu_nome_file_origine =  $conn->escape_string($data['docu_nome_file_origine']);
  $path_parts = pathinfo($docu_nome_file_origine);
  $docu_id_file_archivio = $conn->escape_string($data['docu_id_file_archivio']);
  $json_data = array_key_exists('json_data', $data)? $data['json_data']:'';
  
  $note = array_key_exists('note_allegato', $data)? addslashes($data['note_allegato']):' ';
  $attivo ="s";
  $user = $_SESSION['userData']['email'];

  $result=0;
  $sql ='INSERT INTO allegato (id,id_ram,tipo_veicolo,progressivo,tipo_documento,docu_nome_file_origine,docu_id_file_archivio,note,attivo,user,json_data) ';
  $sql .= "VALUES (NULL,$id_ram,$tipo_veicolo,$progressivo,$tipo_documento,'$docu_nome_file_origine','$docu_id_file_archivio','$note','$attivo','$user','$json_data')  ";
  
  //echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
   // move_uploaded_file($file['tmp_name'],$pathAlle.$docu_id_file_archivio);

    $last_id= mysqli_insert_id($conn);
    
  }else{
    $last_id=0;  
  }
  return $last_id;




}
function getInfoVei($id){
  /**
  * @var $conn mysqli
  */

    $conn = $GLOBALS['mysqli'];

    $sql = 'SELECT * FROM veicolo WHERE id ='.$id;
    //echo $sql;
    $result = [];

    $res = $conn->query($sql);
          
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;



}
function getInfoVeiData($data){
  /**
  * @var $conn mysqli
  */

    $conn = $GLOBALS['mysqli'];
    $id_RAM= $data['id_RAM'];
    $tipo_veicolo= $data['tipo_veicolo'];
    $progressivo= $data['progressivo'];

    $sql = "SELECT * FROM veicolo WHERE id_RAM =$id_RAM AND tipo_veicolo=$tipo_veicolo and progressivo=$progressivo";
    //echo $sql;
    $result = [];

    $res = $conn->query($sql);
          
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;



}
function countIstanzaVei($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM";
       
    
        //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function countIstanzaVeiInfo($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM AND targa IS NOT NULL";
       
    
        //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function countDocIstanza($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $records = [];

      

      $sql = 'SELECT * FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM";
       
    
        //  echo $sql;
      
        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }
        $total = 0;
   if($records){
   
     foreach($records as $r){
     

      $codice_tipo_veicolo = $r['tipo_veicolo'];

      $sql = 'SELECT count(*) as total FROM tv_td';

          $sql .=" WHERE codice_tipo_veicolo =".$codice_tipo_veicolo;
       
    
         // echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $totalb = $row['total'];
      }
       $total += $totalb;
     



     }
   }
   return $total;

}
function countDocIstanzaInfo($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $records = [];

      

      $sql = 'SELECT * FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM";
       
    
        //  echo $sql;
      
        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }
        $total = 0;
   if($records){
  
     foreach($records as $r){
     

      $tipo_veicolo = $r['tipo_veicolo'];
      $progressivo = $r['progressivo'];

     
  $sql = 'SELECT count(DISTINCT tipo_documento) as total FROM allegato';

  $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo";
    
         // echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $totalb = $row['total'];
      }
       $total += $totalb;
     



     }
   }
   return $total;

}
function countDocVeicolo($id){

   /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  

    
  $total = 0;

  

  $sql = 'SELECT count(*) as total FROM tv_td';

      $sql .=" WHERE codice_tipo_veicolo = $id";
   

   //  echo $sql;
  

  $res = $conn->query($sql);
  if($res) {

   $row = $res->fetch_assoc();
   $total = $row['total'];
  }
  return $total;

}
function countDocVeicoloInfo($id_RAM,$tipo_veicolo,$progressivo){

   
  /**
   * @var $conn mysqli
   */

            $conn = $GLOBALS['mysqli'];

              
           
              
            $total = 0;

  
      


     
                $sql = 'SELECT count(DISTINCT tipo_documento) as total FROM allegato';

                $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo and attivo = 's'";
                //  echo $sql;
                

                $res = $conn->query($sql);
                if($res) {

                $row = $res->fetch_assoc();
                $total = $row['total'];
                
                return $total;

              }
          
}
function getTipoDich($cod){
   /**
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_dichiarante WHERE cod_tipo ='.$cod;
  //echo $sql;
  $result = [];

  $res = $conn->query($sql);
        
    if($res && $res->num_rows){
      $result = $res->fetch_assoc();
      
    }
  return $result;




}
function getTipoImpresa($cod){
  /**
 * @var $conn mysqli
 */

 $conn = $GLOBALS['mysqli'];

 $sql = 'SELECT * FROM tipo_impresa WHERE cod_tipo ='.$cod;
 //echo $sql;
 $result = [];

 $res = $conn->query($sql);
       
   if($res && $res->num_rows){
     $result = $res->fetch_assoc();
     
   }
 return $result;




}
function getInfoCampo($cod){
  
    /**
     * @var $conn mysqli
     */
  
    $conn = $GLOBALS['mysqli'];
  
    $sql = 'SELECT * FROM campi_documento WHERE cod_campo='.$cod ;
    
    $result = [];

  $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;

  
  
  
  
  
}
function checkDocTipoVeicolo($tipo,$idRam){
   
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

              
           
              
  $total = 0;






      $sql = 'SELECT count(DISTINCT tipo_documento) as total FROM allegato';

      $sql .=" WHERE id_ram = $idRam and tipo_veicolo = $tipo  and attivo='s'";
      //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

      $row = $res->fetch_assoc();
      $total = $row['total'];
      
      return $total;

    }




}
function checkSelectTipoDoc($data){
   /**
  * @var $conn mysqli
  */
 $id_ram=$data['id_ram'];
 
 $tipo_veicolo=$data['tipo_veicolo'];
 $progressivo=$data['progressivo'];
 $tipo_documento=$data['tipo_documento'];

  $conn = $GLOBALS['mysqli'];

  $sql = "SELECT distinct tipo_documento FROM allegato WHERE id_ram =$id_ram and tipo_veicolo=$tipo_veicolo and progressivo=$progressivo and tipo_documento=$tipo_documento and attivo='s'";
  //echo $sql;
  $result = [];

  $res = $conn->query($sql);
        
    if($res && $res->num_rows){
      $result = $res->fetch_assoc();
      
    }
  return $result;




}
function getXml($pec_msg_identificativo,$pec_msg_id){
  /**
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];

  $sql = "SELECT * FROM xml WHERE msg_id='$pec_msg_identificativo' and identificativo='$pec_msg_id'";
  //echo $sql;
  $result = [];

  $res = $conn->query($sql);
        
    if($res && $res->num_rows){
      $result = $res->fetch_assoc();
      
    }
  return $result;



}
function closeRend($id_ram){

  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  $aperta = 0;
  $data_chiusura = date("Y-m-d H:i:s");
  $sql ='UPDATE rendicontazione SET ';
  $sql .= "aperta = '$aperta'";
  $sql .= ", data_chiusura = '$data_chiusura'";
  $sql .=' WHERE id_RAM = '.$id_ram;
  //print_r($data);
 // echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    $log=[];
        $log['user']['email']=$_SESSION['userData']['email'];
        $log['log_funzione']="Chiusura Rendicontazione";
        $log['message']="Chiusura";
        $log['success']=true;
        writelog($log);
    
  }else{
    $result -1;  
  }
  return $result;



}
function countRendicontazione($stato){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM rendicontazione';

          $sql .=" WHERE aperta = $stato ";
       
    
         // echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function getVeicoli($id_RAM){
  
  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM veicolo WHERE id_RAM ='.$id_RAM;
 // echo $sql;
  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;

}
function getVeicolo($id_RAM,$tipo_veicolo,$progressivo){
  
  $conn = $GLOBALS['mysqli'];

  $sql = "SELECT * FROM veicolo  WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo";
 // echo $sql;
 $result = [];

 $res = $conn->query($sql);
 if($res && $res->num_rows){
   $result = $res->fetch_assoc();
   
 }
 return $result;

}
function getAlleOk($id_RAM,$tipo_veicolo,$progressivo){
  /**
   * @var $conn mysqli
   */
  $conn = $GLOBALS['mysqli'];      
  $total = 0;
  $sql = 'SELECT count(*) as total FROM allegato';
  $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo and attivo = 's' and stato_admin = 'B'";
      // $sql .=" where stato_admin = 'B'";
        //echo $sql;
  $res = $conn->query($sql);
      if($res) {
        $row = $res->fetch_assoc();
        $total = $row['total'];
        return $total;
      }
  return $total;
          
}
function getAlleNo($id_RAM,$tipo_veicolo,$progressivo){ 
  /**
   * @var $conn mysqli
   */
  $conn = $GLOBALS['mysqli'];  
  $total = 0;
  $sql = 'SELECT count(*) as total FROM allegato';
  $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo and attivo='s' and stato_admin='C'";
  //  echo $sql;
  $res = $conn->query($sql);
  if($res) {
    $row = $res->fetch_assoc();
    $total = $row['total'];
    return $total;
  }
          
}
function getAlleValid($id_RAM,$tipo_veicolo,$progressivo){
  /**
   * @var $conn mysqli
   */
  $conn = $GLOBALS['mysqli']; 
  $total = 0;
  $sql = 'SELECT count(*) as total FROM allegato';
  $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo and attivo='s' and stato_admin='C'";
      //  echo $sql;
  $res = $conn->query($sql);
    if($res) {
      $row = $res->fetch_assoc();
      $total = $row['total'];
      return $total;
    }
          
}
function countAlle($id_RAM,$tipo_veicolo,$progressivo){ 
  /**
   * @var $conn mysqli
   */
            $conn = $GLOBALS['mysqli'];
            $total = 0;
            $sql = 'SELECT count(*) as total FROM allegato';
            $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo and attivo='s'";
                //  echo $sql;
            $res = $conn->query($sql);
            if($res) {
                $row = $res->fetch_assoc();
                $total = $row['total'];
                return $total;
            }
          
}