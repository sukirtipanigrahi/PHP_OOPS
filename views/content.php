<!-- errors & messages --->
<?php

// show negative messages
if ($content->errors) {
    foreach ($content->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($content->messages) {
    foreach ($content->messages as $message) {
        echo $message;
    }
}

?>   

<!-- content form -->
<form method="post" action="content.php" name="contentform">   
       
    <label for="content">Content </label>
    <input id="content" class="content_text" type="text"  name="content_textBox" value="<?php echo $currentText->content_text?>"  required />
       
    <input type="submit"  name="content" value="Update Content" />
    
</form>

<!-- backlink -->
<a href="index.php">Back to Login Page</a>

