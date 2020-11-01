<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:login.php');
  exit;
}

require_once 'model/user.php';
$updateUrl = 'userUpdate.php';
$deleteUrl = 'controller/updateUser.php';
require_once 'headerInclude.php';
?>

<div class="container my-4">
 

    
      <?php
     
       require_once 'controller/displayUser.php' ;
          

      ?>
      
</div>    
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>
<script type="text/javascript">
  $( document ).ready(function() {
    $('#message').delay(3000).fadeOut();
});
</script>
</body>
</html>    