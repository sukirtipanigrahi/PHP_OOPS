<?php
session_start();
if (empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] != 1)) {
    header('Location: index.php');
}
?>
<?php
require_once("db/db.php");
require_once("classes/Content.php");
require_once ("classes/CurrentText.php");
$content = new Content();
$currentText = new CurrentText();
include("views/common/header.php");

?>
<div class="container">
    <?php
    include 'views/common/navigation.php';  
    include("views/content.php");
      ?>
</div>
<?php
include("views/common/footer.php");
?>