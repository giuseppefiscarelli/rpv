<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.html');
  exit;
}
require_once 'headerInclude.php';
?>
<div class="clearfix"></div>
 <!--Start Dashboard Content-->	
  <div class="content-wrapper">
    <div class="container-fluid">

<?php
	  //require_once 'model/homeSetec.php';
      $authPage = $_SESSION['userData']['ambiente'];
	  $authThisPage =basename($_SERVER['PHP_SELF']);
	//  if(!isUserSuadmin()){
	//	if(!checkAuthPage($authPage,$authThisPage)){
		
	//		require_once 'view/403.php' ;
	
	//	  }

	//  }
	//  else{	  
	  
		require_once 'controller/displayHome.php' ;
			  
	 // }	

	?>
     
<!--End Dashboard Content-->

