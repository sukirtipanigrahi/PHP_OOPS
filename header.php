<?php
session_start();
if (empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] != 1)) {
    header('Location: index.php');
}
?>
<?php
require_once("db/db.php");
require_once("classes/Header.php");
require_once ("classes/CurrentText.php");
$header = new Header();
$currentText = new CurrentText();
include("views/common/header.php");

?>
<div class="container">
    <?php
    include 'views/common/navigation.php';  
    include("views/header.php");
      ?>
</div>
<?php
include("views/common/footer.php");
?>