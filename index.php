<?php 

require_once ("db/db.php");
require_once ("classes/Login.php");
require_once ("classes/CurrentText.php");
$login = new Login();
$currentText = new CurrentText();
include_once ("views/common/header.php");
?>

<div class="container">
    <?php
      
     
    if ($login->isUserLoggedIn() == true) { 
        include_once 'views/common/navigation.php';
	include_once("views/logged_in.php");
    } else {
	include_once("views/not_logged_in.php");
    }
?>
</div>
<?php
include_once("views/common/footer.php");
?>



