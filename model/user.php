<?php
function delete(int $id){

    /**
     * @var $conn mysqli
     */

      $conn = $GLOBALS['mysqli'];

        $sql ='DELETE FROM users WHERE id = '.$id;

        $res = $conn->query($sql);
        
        return $res && $conn->affected_rows;
    
    
}
function getUser(int $id){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ='SELECT * FROM users WHERE id = '.$id;
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}

function getUserByemail(string $email){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      if(!$email){
        $result;
      }
      $email = mysqli_escape_string($conn,$email);

      $sql ="SELECT * FROM users WHERE email = '$email'";
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}

function storeUser(array $data, int $id){ 

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $username = $conn->escape_string($data['username']);
      $cognome = $conn->escape_string($data['cognome']);
      $nome = $conn->escape_string($data['nome']);
      $email = $conn->escape_string($data['email']);
      $ambiente = $conn->escape_string($data['ambiente']);
      $azienda = $conn->escape_string($data['azienda']);
      $filiale = $conn->escape_string($data['filiale']);
      $logoazienda = $conn->escape_string($data['logoazienda']);
      


      $roletype = in_array($data['roletype'], getConfig('roletype',[]))? $data['roletype']:'user';
      $result=0;
      $sql ='UPDATE users SET ';
      $sql .= "username = '$username', cognome = '$cognome', nome = '$nome', email = '$email', azienda = '$azienda', filiale = '$filiale', logoazienda = '$logoazienda', ambiente ='$ambiente'";
      if($data['password']){
        $data['password']=$data['password']?? 'password';
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql.= ", password = '$password'";
      } 
      if ($data['roletype']){
        $roletype = in_array($data['roletype'], getConfig('roletype',[]))? $data['roletype']:'user';
        $sql .=", roletype = '$roletype'";
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

function saveUser(array $data){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $username = $conn->escape_string($data['username']);
      $cognome = $conn->escape_string($data['cognome']);
      $nome = $conn->escape_string($data['nome']);
      $email = $conn->escape_string($data['email']);
      $ambiente = $conn->escape_string($data['ambiente']);
      $azienda = $conn->escape_string($data['azienda']);
      $filiale = $conn->escape_string($data['filiale']);
      $ambiente = 1;
      $azienda = 1;
      $filiale = 1;
      $logoazienda = $conn->escape_string($data['logoazienda']);
      $roletype = in_array($data['roletype'], getConfig('roletype',[]))? $data['roletype']:'user';
      $data['password']= $data['password']?$data['password']:'testuser';
      $password = password_hash($data['password'], PASSWORD_DEFAULT);
      $result=0;
      $sql ='INSERT INTO users (id, password, username, cognome, nome, email, ambiente, azienda, filiale, roletype, logoazienda) ';
      $sql .= "VALUES (NULL, '$password', '$username', '$cognome', '$nome', '$email', '$ambiente', '$azienda', '$filiale','$roletype','$logoazienda') ";
      
      //echo $sql;die;
      $res = $conn->query($sql);
      
      if($res ){
        $result =  $conn->affected_rows;
        
      }else{
        $result -1;  
      }
    return $result;
  
  
}

function abGuida(array $data){ 

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $id = $data['id'];
      $ab = $data['ab_guida'];
      $sql ='UPDATE users SET ';
      $sql .= "ab_guida = '$ab'";
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

    