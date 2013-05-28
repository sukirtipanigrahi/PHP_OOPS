<!-- errors & messages --->
<?php

// show negative messages
if ($footer->errors) {
    foreach ($footer->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($footer->messages) {
    foreach ($footer->messages as $message) {
        echo $message;
    }
}

?>   

<!-- content form -->
<form method="post" action="footer.php" name="footerform">   
       
    <label for="content">Footer1 </label>
    <input id="content" class="content_text" type="text"  name="footer1" value="<?php echo $currentText->footer1; ?>"  required /><br>
    
    <label for="content">Footer2 </label>
    <input id="content" class="content_text" type="text"  name="footer2"  value="<?php echo $currentText->footer2; ?>" required /><br>
    
    <label for="content">Footer3 </label>
    <input id="content" class="content_text" type="text"  name="footer3"  value="<?php echo $currentText->footer3; ?>" required /><br>
    
    <input type="submit"  name="footer" value="Update Footer" />
    
</form>

<!-- backlink -->
<a href="index.php">Back to Login Page</a>

