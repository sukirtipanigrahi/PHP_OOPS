<!-- errors & messages --->
<?php

// show negative messages
if ($preference->errors) {
    foreach ($preference->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($preference->messages) {
    foreach ($preference->messages as $message) {
        echo $message;
    }
}

?>   

<!-- content form -->
<form method="post" action="preference.php" name="preferenceform">   
       
    <label for="content">Preference </label>
    <input id="content" class="content_text" type="checkbox"  name="preference_check"  value="1" <?php if($currentText->preference == 1){ ?> checked <?php } ?> />
       
    <input type="submit"  name="preference" value="Update Preference" />
    
</form>

<!-- backlink -->
<a href="index.php">Back to Login Page</a>

