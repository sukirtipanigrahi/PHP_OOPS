<!-- errors & messages --->
<?php
// show negative messages
if ($header->errors) {
    foreach ($header->errors as $error) {
        echo $error;
    }
}

// show positive messages
if ($header->messages) {
    foreach ($header->messages as $message) {
        echo $message;
    }
}
?>   

<!-- content form -->
<form action="header.php" method="post"
      enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="uploadedfile" id="uploadedfile" /> 
    <br />
    <input type="submit" name="header" value="Submit" />
</form>



<!-- backlink -->
<a href="index.php">Back to Login Page</a>

