<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}
/*
require_once 'model/user.php';
$updateUrl = 'userUpdate.php';
$deleteUrl = 'controller/updateUser.php';
*/
require_once 'headerInclude.php';

?>
 <div class="container my-4">
 <?php
    require_once 'controller/displayHome.php';
?>   
        
</div>
     
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>
<script type="text/javascript">
  
</script>
</body>
</html>    