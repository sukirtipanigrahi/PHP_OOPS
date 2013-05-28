<?php
require_once("db/db.php");
require_once("classes/Registration.php");
require_once ("classes/CurrentText.php");
$registration = new Registration();
$currentText = new CurrentText();
include("views/common/header.php");
?>
<div class="container">
    <?php
    
    include("views/register.php");
      ?>
</div>
<?php
include("views/common/footer.php");
?>

