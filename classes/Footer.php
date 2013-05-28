<?php

class Footer {

    private $db_connection = null;                     // database connection   
    private $footer1 = "";
    private $footer2 = "";
    private $footer3 = "";
    public $footer_update_successful = false;
    public $errors = array();                  // collection of error messages
    public $messages = array();                  // collection of success / neutral messages

    public function __construct() {

        if (isset($_POST['footer'])) {
            $this->updateFooter();
        }
    }

    private function updateFooter() {
            
       
        if (!empty($_POST['footer1']) && !empty($_POST['footer2']) && !empty($_POST['footer2']) ) {


            // creating a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {


                $this->footer1 = $this->db_connection->real_escape_string($_POST['footer1']);
                $this->footer2 = $this->db_connection->real_escape_string($_POST['footer2']);
                $this->footer3 = $this->db_connection->real_escape_string($_POST['footer3']);

                // check if user already exists
                $query_check_footer = $this->db_connection->query("SELECT * FROM footer;");
                
                if ($query_check_footer->num_rows != 1) {

                    $query_footer_insert = $this->db_connection->query("INSERT INTO footer (content) VALUES('" . $this->content_text . "';");
                } else {
                   
                    $query_footer_update = $this->db_connection->query("Update footer set footer1 ='" . $this->footer1 . "',footer2 ='" . $this->footer2 . "',footer3 ='" . $this->footer3 . "';");
                }
                if ($query_footer_insert || $query_footer_update) {

                    $this->messages[] = "Your footer has been created/updated successfully. You can now log in.";
                    
                } else {

                    $this->errors[] = "Sorry, your updation failed. Please go back and try again.";
                }
            } else {

                $this->errors[] = "Sorry, no database connection.";
            }
        } else {

            $this->errors[] = "An unknown error occured.";
        }
    }

}