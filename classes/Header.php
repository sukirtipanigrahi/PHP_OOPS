<?php

class Header {

    private $db_connection = null;                     // database connection   
    private $header = null;
    public $errors = array();                  // collection of error messages
    public $messages = array();                  // collection of success / neutral messages

    public function __construct() {

        if (isset($_POST['header'])) {
            $this->updateHeader();
        }
    }

    private function updateHeader() {
        $path = "static/images/";

        $path = $path."header.png";

        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $path)) {
            $this->messages[]= "The file " . basename($_FILES['uploadedfile']['name']) .
            " has been uploaded";
            ?>
            
            <?php
        } else {
            $this->errors[]="There was an error uploading the file, please try again!";
        }
    }

}