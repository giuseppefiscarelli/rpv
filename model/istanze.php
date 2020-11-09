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
function getIstanza(int $id){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ='SELECT * FROM istanza WHERE id = '.$id;
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}
function getIstanzaUser($email){

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
        $result=[];
        $sql ="SELECT * FROM istanza WHERE pec_impr = '$email'";
        //echo $sql;
        $res = $conn->query($sql);
        
        if($res && $res->num_rows){
          $result = $res->fetch_assoc();
          
        }
      return $result;
    
    
}
function getIstanze( array $params = []){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

        $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'id';
        $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
        $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
        $page = (int)array_key_exists('page', $params) ? $params['page'] : 0;
        $start =$limit * ($page -1);
        if($start<0){
          $start = 0;
        }
        $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
        $search1 = $conn->escape_string($search1);
        $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
        $search2 = $conn->escape_string($search2);
        if($orderDir !=='ASC' && $orderDir !=='DESC'){
          $orderDir = 'ASC';
        }
        $records = [];

        

        $sql = 'SELECT * FROM istanza';
        if ($search1){
          $sql .=" WHERE email_richiedente LIKE '%$search1%' ";
          
        }
        if ($search2){
            $sql .=" WHERE email_impr LIKE '%$search2%' ";
            
          }
        $sql .= " ORDER BY $orderBy $orderDir LIMIT $start, $limit";
        

        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
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
        if($orderDir !=='ASC' && $orderDir !=='DESC'){
          $orderDir = 'ASC';
        }
        $totalUser = 0;

        

        $sql = 'SELECT COUNT(*) as totalUser FROM istanza';
        if ($search1){
            $sql .=" WHERE email_richiedente LIKE '%$search1%' ";
            
          }
          if ($search2){
              $sql .=" WHERE email_impr LIKE '%$search2%' ";
              
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
  $tip_vei_8=$data['nv8'];
  $tip_vei_9=$data['nv9'];
  $tip_vei_10=$data['nv10'];
  $tip_vei_11=$data['nv11'];
  $tip_vei_12=$data['r_nv_1'];
  $tip_vei_13=$data['r_nv_2'];
  $tip_vei_14=$data['r_nv_3'];
  $tip_vei_15=$data['nr_1'];
  $tip_vei_16=$data['nr_2'];
  $tip_vei_17=$data['ng_1'];

 for ($i = 1; $i<=17;++$i){
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
      $sql ='INSERT INTO rendicontazione (id, id_RAM, aperta) ';
      $sql .= "VALUES (NULL, $id_RAM, 1) ";
      
     // echo $sql;
      $res = $conn->query($sql);
      
      if($res ){
        $result =  $conn->affected_rows;
        
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
function getTipoDocumento(){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_documento';
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
function getCampoDoc($tipo_documento){
   /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  
  $sql = 'SELECT * FROM td_campo WHERE tipo_documento ='.$tipo_documento;
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
  
  $sql = 'SELECT * FROM allegato WHERE tipo_documento ='.$tipo_documento.' and id_ram ='.$id_RAM.' and id_veicolo ='.$id_veicolo;
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
function getAllegati($id_RAM,$id_veicolo){
  /**
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];
  
  $sql = 'SELECT * FROM allegato WHERE id_ram ='.$id_RAM.' and id_veicolo ='.$id_veicolo;
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
  $user = $_SESSION['userData']['username'];
 


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
function newAllegato($data,$file){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $id_ram = $conn->escape_string($data['id_RAM']);
  $id_veicolo = $conn->escape_string($data['doc_idvei']);
  $tipo_documento = $conn->escape_string($data['tipo_documento']);
  $docu_nome_file_origine =  $conn->escape_string($file['name']);
  $docu_id_file_archivio = $conn->escape_string($file['name']);
  $data_allegato = array_key_exists('data_allegato', $data)? $data['data_allegato']:'';
  $importo_allegato = array_key_exists('importo_allegato', $data)? $data['importo_allegato']:null;
  $testo_allegato = array_key_exists('testo_allegato', $data)? $data['testo_allegato']:'';
  $numero_allegato = array_key_exists('numero_allegato', $data)? $data['numero_allegato']:'';
  $note = array_key_exists('note_allegato', $data)? $data['note_allegato']:'';
  $attivo ="s";
  $user = $_SESSION['userData']['username'];

  $result=0;
  $sql ='INSERT INTO allegato (id,id_ram,id_veicolo,tipo_documento,docu_nome_file_origine,docu_id_file_archivio,data_allegato,importo_allegato,testo_allegato,numero_allegato,note,attivo,user) ';
  $sql .= "VALUES (NULL,$id_ram,$id_veicolo,$tipo_documento,'$docu_nome_file_origine','$docu_id_file_archivio','$data_allegato',$importo_allegato,'$testo_allegato','$numero_allegato','$note','$attivo','$user')  ";
  
  //echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    
  }else{
    $result -1;  
  }
return $result;




}