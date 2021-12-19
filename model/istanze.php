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

function getStatusIstruttoria($id_RAM){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ="SELECT id, tipo_report, data_invio FROM report WHERE id_RAM = $id_RAM and stato = 'C' and data_invio = (select max(data_invio)  FROM report WHERE id_RAM = $id_RAM and stato = 'C')" ;
      
     // echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}

function getStatusIstruttoria_test($id_RAM){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ="SELECT id, tipo_report, data_ins, data_invio FROM report WHERE id_RAM = $id_RAM and stato != 'C' and data_ins = (select max(data_ins)  FROM report WHERE id_RAM = $id_RAM and stato != 'C' and attivo = true)" ;
      
     // echo $sql;
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
    $conn->query('SET CHARACTER SET utf8');
      $result=[];
      $sql ='SELECT * FROM istanza WHERE id_RAM = '.$id;
      //echo $sql;

      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}

function getIstanzeHome( array $params = []){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

      $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_invio';
      if($orderBy){
        if($orderBy=='data_invio'){
          $orderBy='data_invio';
        }
        elseif($orderBy=='idRAM'){
          $orderBy='id_RAM';
        }
        elseif($orderBy=='ragione_sociale'){
          $orderBy='ragione_sociale';
        }
        elseif($orderBy=='pec_impr'){
          $orderBy='pec_impr';
        }
      }
      $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
     
     
      $now =date("Y-m-d H:i:s");
      
      $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
      $search1 = $conn->escape_string($search1);
      $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
      $search2 = $conn->escape_string($search2);
      $search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
      $search3 = $conn->escape_string($search3);
      $search4 = array_key_exists('search4', $params) ? $params['search4'] : '';
      $search4 = $conn->escape_string($search4);
      $search5 = array_key_exists('search5', $params) ? $params['search5'] : '';
      $search5 = $conn->escape_string($search5);
      if($orderDir !=='ASC' && $orderDir !=='DESC'){
        $orderDir = 'ASC';
      }
      $records = [];
      $data_inizio = '';
      $data_fine = '';
      $data_rend_inizio = '';
      $data_rend_fine = '';
      if ($search3){
        $tipo= getTipoIstanza($search3);
        $data_inizio = $tipo['data_invio_inizio'];
        $data_fine = $tipo['data_invio_fine'];
        $data_rend_inizio = $tipo['data_rendicontazione_inizio'];
        $data_rend_fine = $tipo['data_rendicontazione_fine'];
       
       }
      if($search4){

        if($search4=='A'&&$data_rend_fine>$now){$parA = ' id_RAM not in( SELECT id_RAM FROM `rendicontazione`)';}
        if($search4=='A'&&$data_rend_fine<$now){$parA = '  id_RAM =0';}
        if($search4=='B'){$parA = ' data_annullamento IS NOT NULL';}
        if($search4=='C'&&$data_rend_fine>$now){$parA = ' aperta=1 and data_chiusura IS NULL and data_annullamento IS NULL';}
        if($search4=='C'&&$data_rend_fine<$now){$parA = '  id_RAM =0';}
        if($search4=='D'){$parA = ' aperta=0 and data_chiusura IS NOT NULL and data_annullamento IS NULL';}
        if($search4=='E'&&$data_rend_fine>$now){$parA = '  id_RAM =0';}
        if($search4=='E'&&$data_rend_fine<$now){$parA = '  (aperta=1 or aperta is null) and data_chiusura IS NULL and data_annullamento IS NULL';}


      }

      if($search5){
        if($search5 === 'A'){ $parB = " tipo_report = 1";}
        if($search5 === 'B'){$parB = " tipo_report = 2";}
        if($search5 === 'C'){$parB = " tipo_report = 3";}
        if($search5 === 'D'){$parB = " tipo_report = 4";}
      }
      
      
        $sql = "SELECT * FROM istanze_view";
        if($search1 || $search2 || $search3 || $search4 || $search5){$sql .=" WHERE";}
        if ($search1){$sql .=" pec LIKE '%$search1%' ";
          if($search2 || $search3 || $search4 || $search5){$sql .=" AND";}
        }
        if ($search2){
            $sql .="  id_RAM = '$search2' ";
            if( $search3 || $search4 || $search5){
              $sql .=" AND";
            }

        }
        if ($search3){
          $sql .=" tipo_istanza = $search3 ";
          if( $search4 || $search5){
            $sql .=" AND";
          }
          
        }
        if($search4){
          $sql .= $parA;
          if( $search5){
            $sql .=" AND";
          }
        }
        if($search5){
          $sql .= $parB;
        }
  
   //echo $sql;

      $res = $conn->query($sql);
    
      if($res) {

        while( $row = $res->fetch_assoc()) {
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
          $orderBy='data_invio';
        }
        elseif($orderBy=='idRAM'){
          $orderBy='id_RAM';
        }
        elseif($orderBy=='ragione_sociale'){
          $orderBy='ragione_sociale';
        }
        elseif($orderBy=='pec_impr'){
          $orderBy='pec_impr';
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
      $search5 = array_key_exists('search5', $params) ? $params['search5'] : '';
      $search5 = $conn->escape_string($search5);
      if($orderDir !=='ASC' && $orderDir !=='DESC'){
        $orderDir = 'ASC';
      }
      $records = [];
      $data_inizio = '';
      $data_fine = '';
      $data_rend_inizio = '';
      $data_rend_fine = '';
      if ($search3){
        $tipo= getTipoIstanza($search3);
        $data_inizio = $tipo['data_invio_inizio'];
        $data_fine = $tipo['data_invio_fine'];
        $data_rend_inizio = $tipo['data_rendicontazione_inizio'];
        $data_rend_fine = $tipo['data_rendicontazione_fine'];
       
       }
      if($search4){

        if($search4=='A'&&$data_rend_fine>$now){
          $parA = ' id_RAM not in( SELECT id_RAM FROM `rendicontazione`)';
        }
        if($search4=='A'&&$data_rend_fine<$now){
          $parA = '  id_RAM =0';
          
       }
        if($search4=='B'){
          $parA = ' data_annullamento IS NOT NULL';
        }
        /*
        if($search4=='B'&&$data_rend_fine<$now){
          $parA = ' and istanza.id_RAM  not in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=0 and data_chiusura IS NOT NULL)';
        }*/
        
        if($search4=='C'&&$data_rend_fine>$now){
          $parA = ' aperta=1 and data_chiusura IS NULL and data_annullamento IS NULL';
        }
        if($search4=='C'&&$data_rend_fine<$now){
           $parA = '  id_RAM =0';

        }
        if($search4=='D'){
          $parA = ' aperta=0 and data_chiusura IS NOT NULL and data_annullamento IS NULL';
        }
        if($search4=='E'&&$data_rend_fine>$now){
          $parA = '  id_RAM =0';
        }
        if($search4=='E'&&$data_rend_fine<$now){
          $parA = '  (aperta=1 or aperta is null) and data_chiusura IS NULL and data_annullamento IS NULL';

        }


      }

      if($search5){
        if($search5 === 'A'){
          $parB = " tipo_report = 1";
        }
        if($search5 === 'B'){
          $parB = " tipo_report = 2";

        }
        if($search5 === 'C'){
          $parB = " tipo_report = 3";

        }
        if($search5 === 'D'){
          $parB = " tipo_report = 4";

        }
      }
      
      //$sql ="SELECT istanza.*, xml.data_invio, xml.pec FROM istanza  INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id ";
      //$sql .=" and istanza.eliminata != '1'";
        //mod view
        $sql = "SELECT * FROM istanze_view";
        if($search1 || $search2 || $search3 || $search4 || $search5){
          $sql .=" WHERE";
        }
        if ($search1){
          $sql .=" pec LIKE '%$search1%' ";
          if($search2 || $search3 || $search4 || $search5){
            $sql .=" AND";
          }

          
        }
        if ($search2){
            $sql .="  id_RAM = '$search2' ";
            if( $search3 || $search4 || $search5){
              $sql .=" AND";
            }

        }
        if ($search3){
          $sql .=" tipo_istanza = $search3 ";
          if( $search4 || $search5){
            $sql .=" AND";
          }
          
        }
        if($search4){
          $sql .= $parA;
          if( $search5){
            $sql .=" AND";
          }
        }
        if($search5){
          $sql .= $parB;
        }
  
    $sql .= " ORDER BY $orderBy  $orderDir LIMIT $start, $limit";
   //echo $sql;

      $res = $conn->query($sql);
      if($res) {
        
        while( $row = $res->fetch_assoc()) {
          $row['stato_des']='';
          if($row['data_invio_inizio']<date("Y-m-d H:i:s")){
            if($row['aperta'] != null){
                if($row['aperta']==1){
                  $row['stato'] = 'C';
                }elseif($row['aperta']==0){
                  $row['stato'] = 'D';
                  $row['stato_des'] ='<br>Rendicondazione chiusa il '.date("d/m/Y", strtotime($row['data_chiusura']));
                }
                if($row['data_annullamento']){
                  $row['stato'] = 'B';
                  $row['stato_des'] ='<br>Annullata da impresa ';
                }
                if(($row['fine_edizione']<$now&&$row['aperta']==1)){
                  $row['stato'] = 'E';
                  $row['stato_des'] ='<br>Termine per la rend. scaduti il '.date("d/m/Y",strtotime($row['fine_edizione']));
                } 
              
            }else{
              $row['stato'] = 'A';
              if($row['fine_edizione']<$now){
               
                $row['stato'] = 'E';
                $row['stato_des'] ='<br>Termine per la rend. scaduti il '.date("d/m/Y",strtotime($row['fine_edizione']));
              } 
            }
          
          }
            $records[] = $row;   
        }
      }

  return $records;

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
      $search5 = array_key_exists('search5', $params) ? $params['search5'] : '';
      $search5 = $conn->escape_string($search5);
      if($orderDir !=='ASC' && $orderDir !=='DESC'){
        $orderDir = 'ASC';
      }
      $now=date("Y-m-d H:i:s");
      $totalUser = 0;
      $data_inizio = '';
      $data_fine = '';
      $data_rend_inizio = '';
      $data_rend_fine = '';
      if ($search3){
        $tipo= getTipoIstanza($search3);
        $data_inizio = $tipo['data_invio_inizio'];
        $data_fine = $tipo['data_invio_fine'];
        $data_rend_inizio = $tipo['data_rendicontazione_inizio'];
        $data_rend_fine = $tipo['data_rendicontazione_fine'];

      
       }
       if($search4){

        if($search4=='A'&&$data_rend_fine>$now){
          $parA = ' id_RAM not in( SELECT id_RAM FROM `rendicontazione`)';
        }
        if($search4=='A'&&$data_rend_fine<$now){
          $parA = '  id_RAM =0';
          
       }
        if($search4=='B'){
          $parA = ' data_annullamento IS NOT NULL';
        }
        /*
        if($search4=='B'&&$data_rend_fine<$now){
          $parA = ' and istanza.id_RAM  not in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=0 and data_chiusura IS NOT NULL)';
        }*/
        
        if($search4=='C'&&$data_rend_fine>$now){
          $parA = ' aperta=1 and data_chiusura IS NULL and data_annullamento IS NULL';
        }
        if($search4=='C'&&$data_rend_fine<$now){
           $parA = '  id_RAM =0';

        }
        if($search4=='D'){
          $parA = ' aperta=0 and data_chiusura IS NOT NULL and data_annullamento IS NULL';
        }
        if($search4=='E'&&$data_rend_fine>$now){
          $parA = '  id_RAM =0';
        }
        if($search4=='E'&&$data_rend_fine<$now){
          $parA = '  (aperta=1 or aperta IS NULL) and data_chiusura IS NULL and data_annullamento IS NULL';
        
        }


      }
      /*
      if($search5){
        if($search5 === 'A'){
          $parB = " id_RAM = ( SELECT id_RAM FROM `report` WHERE report.id_RAM=istanze_view.id_RAM and report.tipo_report=1 and report.data_invio = (select max(report.data_invio) FROM report WHERE report.id_RAM = istanze_view.id_RAM and report.stato = 'C'))";
        }
        if($search5 === 'B'){
          $parB = " id_RAM = ( SELECT id_RAM FROM `report` WHERE report.id_RAM=istanze_view.id_RAM and report.tipo_report=2 and report.data_invio = (select max(report.data_invio) FROM report WHERE report.id_RAM = istanze_view.id_RAM and report.stato = 'C'))";

        }
        if($search5 === 'C'){
          $parB = " id_RAM = ( SELECT id_RAM FROM `report` WHERE report.id_RAM=istanze_view.id_RAM and report.tipo_report=3 and report.data_invio = (select max(report.data_invio) FROM report WHERE report.id_RAM = istanze_view.id_RAM and report.stato = 'C'))";

        }
        if($search5 === 'D'){
          $parB = " id_RAM = ( SELECT id_RAM FROM `report` WHERE report.id_RAM=istanze_view.id_RAM and report.tipo_report=4 and report.data_invio = (select max(report.data_invio) FROM report WHERE report.id_RAM = istanze_view.id_RAM and report.stato = 'C'))";

        }
      }
     */
      if($search5){
        if($search5 === 'A'){
          $parB = " tipo_report = 1";
        }
        if($search5 === 'B'){
          $parB = " tipo_report = 2";

        }
        if($search5 === 'C'){
          $parB = " tipo_report = 3";

        }
        if($search5 === 'D'){
          $parB = " tipo_report = 4";

        }
      }
     $sql = "SELECT count(*) as totalUser FROM istanze_view";
    
        if($search1 || $search2 || $search3 || $search4 || $search5){
          $sql .=" WHERE";
        }
        if ($search1){
          $sql .=" pec LIKE '%$search1%' ";
          if($search2 || $search3 || $search4 || $search5){
            $sql .=" AND";
          }

          
        }
        if ($search2){
          $sql .="  id_RAM = '$search2' ";
            if( $search3 || $search4 || $search5){
              $sql .=" AND";
            }

        }
        if ($search3){
         // $sql .=" data_invio between '$data_inizio' and '$data_fine'";
          $sql .=" tipo_istanza = $search3 ";
          if( $search4 || $search5){
            $sql .=" AND";
          }
          
        }
        if($search4){
          $sql .= $parA;
          if( $search5){
            $sql .=" AND";
          }
        }
        if($search5){
          $sql .= $parB;
        }
       // echo $sql;
      
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
  
  //$sql = 'SELECT * FROM allegato WHERE id_ram ='.$id_RAM.' and tipo_veicolo ='.$tipo_veicolo.' and progressivo='.$progressivo.' and attivo="s" ';
  $sql = 'SELECT * FROM allegato left join tipo_documento on allegato.tipo_documento = tipo_documento.tdoc_codice WHERE allegato.id_ram ='.$id_RAM.' and allegato.tipo_veicolo ='.$tipo_veicolo.' and allegato.progressivo='.$progressivo.' and allegato.attivo="s" ';

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

function distinctTipoVeicolo($id_RAM){
  /**
     * @var $conn mysqli
     */
    $conn = $GLOBALS['mysqli'];
    $sql = "SELECT distinct(tipo_veicolo) FROM veicolo where id_RAM = $id_RAM";
    $records = [];
    $res = $conn->query($sql);
    if($res) {
      while( $row = $res->fetch_assoc()) {
          $records[] = $row;   
      }
    }
   return $records;
}

function getTipiVeicolo(){
  /**
   * @var $conn mysqli
   */
  $conn = $GLOBALS['mysqli'];
  $sql = 'SELECT * FROM tipo_veicolo' ;
  $records = [];
  $res = $conn->query($sql);
  if($res) {
    while( $row = $res->fetch_assoc()) {
        $records[] = $row;  
    }
  }
 return $records;
}

function calcolaContributo($data){
  $conn = $GLOBALS['mysqli'];
 // $conn = mysqli_connect('localhost', 'root', '', 'inv2020_git');
  if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
  }
  $id_ram = $data['id_RAM'];
  $tv = array_key_exists('tipo_veicolo',$data)?$data['tipo_veicolo']:'';
  $progr = array_key_exists('progressivo',$data)?$data['progressivo']:'';
  $costo = array_key_exists('costo',$data)?$data['costo']:'';
  $result = array();
  $valori = array("1"=>4000,"2"=>8000,"3"=>12000,"4"=>20000,"5"=>2000,"6"=>5000,"7"=>8000);

  if ($tv){
    $sql = "SELECT veicolo.*, istanza_check.pmi as pmi_check, istanza_check.rete as rete_check, istanza_check.dim_impresa as impresa_check FROM veicolo INNER JOIN istanza on istanza.id_RAM = ".$id_ram." LEFT JOIN istanza_check ON veicolo.id_ram = istanza_check.id_ram WHERE veicolo.id_RAM = ".$id_ram. " AND tipo_veicolo = ".$tv." AND progressivo = ".$progr;
  } else {
    $sql = "SELECT veicolo.*, istanza_check.pmi as pmi_check, istanza_check.rete as rete_check, istanza_check.dim_impresa as impresa_check FROM veicolo INNER JOIN istanza on istanza.id_RAM = ".$id_ram." LEFT JOIN istanza_check ON veicolo.id_ram = istanza_check.id_ram WHERE veicolo.id_RAM = ".$id_ram. "  order by veicolo.id_RAM, tipo_veicolo, progressivo";
  }
  //echo $sql;die;
  $rs = mysqli_query($conn, $sql);

  if (!$rs){
    $result = array("result" => "KO");

    echo json_encode($result);
  //  die;
  }
  $i = 0;
  while ($row = mysqli_fetch_array($rs)) {
    //var_dump($row);die;
    $i ++;
    $tv = $row['tipo_veicolo'];
    $progr = $row['progressivo'];
    $costo = $row['costo'];
    $valore_contributo = 0;
    $valore_contributo = $valori[$tv];
    $ele = array(
      'id' => $row['id'],
      'tv' => $row['tipo_veicolo'],
      'progr' => $row['progressivo'],
       'contributo' => $valore_contributo
      );

    array_push($result, $ele);
  }

  if (!$i){
    $result = array("result" => "KO");
  //  echo json_encode($result);		// errore per istanza non trovata (impossibile)
 //   die;
  }
 return $result;


}

function checkIstanza($id_ram){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ='SELECT * FROM istanza_check WHERE id_ram = '.$id_ram;
  //echo $sql;
  $res = $conn->query($sql);
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
  }
  return $result;
}

function upIstruttoria($data){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $id = $conn->escape_string($data['id']);
  $stato_admin = $data['stato_admin']??'A';
  $note_admin = $data['note_admin']?addslashes($data['note_admin']):'';
  $data_admin = date("Y/m/d H:i:s");
  $user_admin = $_SESSION['userData']['email'];
  $costo_istr = $data['costo_istr']??'null';
  //var_dump(strlen($costo_istr));
  if(strlen($costo_istr)==0){
    $costo_istr= 0;
  }
  $valore_contr = $data['valore_contr']??'null';
  $note_istr = $data['note_istr']?addslashes($data['note_istr']):null;
  $result=0;
  $sql ='UPDATE veicolo SET ';
  $sql .= "stato_admin = '$stato_admin', note_admin = '$note_admin', data_admin = '$data_admin',user_admin ='$user_admin',costo_istr=$costo_istr,valore_contr=$valore_contr,note_istr='$note_istr'";
  $sql .=' WHERE id = '.$id;
  //print_r($data);
 // echo $sql;die;
  $res = $conn->query($sql);
  if($res ){
    $result =  $conn->affected_rows; 
  }else{
    $result -1;  
  }
  return $result;
}
function getRichInt(){
  /**
 * @var $conn mysqli
 */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM campi_integrazione';
  $records = [];
  $res = $conn->query($sql);
  if($res) {
    while( $row = $res->fetch_assoc()) {
        $records[] = $row; 
    }
  }
  return $records;
}
function getTipoReport(){
    /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $sql = 'SELECT * FROM tipo_report';
  $records = [];
  $res = $conn->query($sql);
  if($res) {
    while( $row = $res->fetch_assoc()) {
        $records[] = $row; 
    }
  }
  return $records;
}
function getStatiIstruttoria(){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $records=[];
  $sql ='SELECT * FROM stati_istruttoria';
  //echo $sql;
  $res = $conn->query($sql); 
  if($res) {
    while( $row = $res->fetch_assoc()) {
        $records[] = $row;   
    }
  }
  return $records;
}

function getStatusIstruttoria_full($id_RAM){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ="SELECT * FROM report WHERE id_RAM = $id_RAM  and data_ins = (select max(data_ins)  FROM report WHERE id_RAM = $id_RAM and attivo = 1)" ;
     // echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
}

function getTipoRepFull($id){
  
  /**
  * @var $conn mysqli
  */

 $conn = $GLOBALS['mysqli'];
 $sql = 'SELECT * FROM tipo_report where id='.$id;
 //echo $sql;
 $result = [];

 $res = $conn->query($sql);
 if($res && $res->num_rows){
   $result = $res->fetch_assoc();
   
 }
 return $result;
}
 function upAlleAdmin($data){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $id = $data['id'];
  $note_admin= $data['note_admin']?addslashes($data['note_admin']):'';
  $stato_admin= $data['stato_admin'];
  $data_admin= date("Y/m/d H:i:s");
  $user_admin = $_SESSION['userData']['email'];
  $result=0;
  
  $sql ='UPDATE allegato SET ';
  $sql .= "note_admin = '$note_admin'";
  $sql .= ", stato_admin = '$stato_admin'";
  $sql .= ", data_admin = '$data_admin'";
  $sql .= ", user_admin = '$user_admin'";
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
function getAllegatiIntegrazione($id_RAM,$data,$tipo_veicolo,$progressivo){
  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $sql = "SELECT count(*) as total FROM allegato WHERE id_ram =$id_RAM and attivo ='s' and data_agg > '$data' and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo";
  //echo $sql;
  $total = 0;
  $res = $conn->query($sql);
  if($res) {

  $row = $res->fetch_assoc();
  $total = $row['total'];
  }
  return $total;


}
function checkRott($id_RAM,$tv){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ='SELECT * FROM istanza WHERE id_RAM = '.$id_RAM.' and rott'.$tv.'="Yes"' ;
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}

function countDocVeicoloRottInfo($id_RAM,$tipo_veicolo,$progressivo){

   
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];        
  $total = 0;
      $sql = 'SELECT count(DISTINCT tipo_documento) as total FROM allegato';
      $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo and attivo='s' and (tipo_documento = 11 or tipo_documento = 14) ";
      //  echo $sql;
      $res = $conn->query($sql);
      if($res) {
      $row = $res->fetch_assoc();
      $total = $row['total'];
      return $total;
    }
          
}

function countVeiIstanza($id_RAM){

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
function countDocIst($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];
      $total = 0;
      $sql = 'SELECT count(*) as total FROM allegato ';

          $sql .=" WHERE id_ram = $id_RAM  and attivo='s' and tipo_documento<90";
      $res = $conn->query($sql);
      if($res) {
       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}

function checkMaggRottamazione($id_RAM){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $rott=0;
  $sql ="SELECT COUNT(*) as rottamazione FROM veicolo  JOIN allegato ON  veicolo.id_RAM = allegato.id_ram AND veicolo.tipo_veicolo = allegato.tipo_veicolo AND veicolo.progressivo = allegato.progressivo WHERE allegato.tipo_documento = 14 AND allegato.stato_admin = 'B' AND allegato.id_RAM = $id_RAM AND allegato.stato_admin ='B' AND allegato.tipo_veicolo < 12" ;
  //echo $sql;
  $res = $conn->query($sql); 
  $res = $conn->query($sql);
  if($res) {
   $row = $res->fetch_assoc();
   $rott = $row['rottamazione'];
  }

  return $rott;
}

function getReportIdRam($id_RAM){
  /**
    * @var $conn mysqli
    */
   $conn = $GLOBALS['mysqli'];
   $sql = "SELECT * FROM report where id_RAM =$id_RAM and attivo = 1 ORDER BY data_ins DESC";
   $records = [];
   $res = $conn->query($sql);
   if($res) {
     while( $row = $res->fetch_assoc()) {
         $records[] = $row;   
     }
   }
  return $records;
 }

 function delReport($id){
  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  $sql ='UPDATE report SET ';
  $sql .= "attivo = 0 ";
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

function getReportId($id){
  /**
   * @var $conn mysqli
   */
  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ='SELECT * FROM report WHERE id = '.$id;
  //echo $sql;
  $res = $conn->query($sql);
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
return $result;
}

function saveReport($data){
  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  $id=$data['id'];
  $prot_RAM=$data['prot_RAM']?$data['prot_RAM']:'';
  if($data['data_prot']){
    $date_prot = $data['data_prot'];
    $date = str_replace('/', '-', $date_prot);
    $data_prot=date("Y-m-d", strtotime( $date));
  }
  $sql ='UPDATE report SET ';
  $sql .= "attivo = 1, prot_RAM='$prot_RAM'";
  if($data['data_prot']){
    $sql .=", data_prot='$data_prot'";
  }
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

function getTipoRep($id){
  
  /**
  * @var $conn mysqli
  */
 $conn = $GLOBALS['mysqli'];
 $sql = 'SELECT descrizione FROM tipo_report where id='.$id;
 //echo $sql;
 $des = 0;
 $res = $conn->query($sql);
     if($res) {
      $row = $res->fetch_assoc();
      $des = $row['descrizione'];
     }
     return $des;
}

function newIntDett($data){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $id_report = $conn->escape_string($data['id_report']);
  $tipo = $conn->escape_string($data['tipo']);
  $descrizione = $conn->escape_string($data['descrizione']);
  $prog= $conn->escape_string($data['prog']);
  $result=0;
  $sql ='INSERT INTO dettaglio_report (id,id_report,tipo,descrizione,prog) ';
  $sql .= "VALUES (NULL,$id_report,'$tipo','$descrizione','$prog')  ";
  //echo $sql;die;
  $res = $conn->query($sql);
  if($res ){
    $result =  $conn->affected_rows;
    $last_id= mysqli_insert_id($conn);  
  }else{
    $last_id=0;  
  }
  return $last_id;

}

function getAllegatiR($id_RAM,$tipo_veicolo,$progressivo){
  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $sql = 'SELECT * FROM allegato left join tipo_documento on allegato.tipo_documento = tipo_documento.tdoc_codice WHERE allegato.id_ram ='.$id_RAM.' and allegato.tipo_veicolo ='.$tipo_veicolo.' and allegato.progressivo='.$progressivo.' and allegato.attivo="s" and allegato.stato_admin="C" ';
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

function getTipoInt($id){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $sql = "SELECT * FROM campi_integrazione where id = $id";
  $result = [];
  $res = $conn->query($sql);
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
  }
  return $result;
}

function newInt($data){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $id_RAM = $conn->escape_string($data['id_RAM']);
  $tipo_report = $conn->escape_string($data['tipo']);
  $user_ins = $_SESSION['userData']['email'];
  $data_ins = date("Y-m-d H:i:s");
  $stato = "B";

  $result=0;
  $sql ='INSERT INTO report (id,id_RAM,tipo_report,user_ins,data_ins,stato) ';
  $sql .= "VALUES (NULL,$id_RAM,$tipo_report,'$user_ins','$data_ins','$stato')  ";
  
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