
<?php
require_once 'functions.php';
  require_once 'model/user.php';

  $userP =getUsersP();
  //var_dump($userP);

    foreach ($userP as $p){
 
            $data['email']=$p['user'];
            $data['password']=$p['pass_cript'];
            $data['roletype']="user";
            $data['username']="";
            $data['nome']="";
            $data['cognome']=$p['ragione_sociale'];
            $data['ragione_sociale']=$p['ragione_sociale'];
            $data['piva']=$p['piva'];
            $data['note']=$p['note'];
  
 

    $res=saveUserP($data);
    if($res){
      echo"ok";
    }
 }

?>