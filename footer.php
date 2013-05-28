<?php
session_start();
if (empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] != 1)) {
    header('Location: index.php');
}
?>

<?php
require_once("db/db.php");
require_once("classes/Footer.php");
require_once ("classes/CurrentText.php");
$footer = new Footer();
$currentText = new CurrentText();
include("views/common/header.php");
?>
<div class="container">
    <?php
    include 'views/common/navigation.php';  
    include("views/footer.php");
      ?>
</div>
<?php
include("views/common/footer.php");
?>

