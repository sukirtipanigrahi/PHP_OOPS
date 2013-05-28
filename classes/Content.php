<?php

class Content {

    private $db_connection = null;                     // database connection   
    private $content_text = "";
    public $content_update_successful = false;
    public $errors = array();                  // collection of error messages
    public $messages = array();                  // collection of success / neutral messages

    public function __construct() {

        if (isset($_POST['content'])) {
            $this->updateContent();
        }
    }

    private function updateContent() {
            
       
        if (!empty($_POST['content_textBox'])) {


            // creating a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {


                $this->content_text = $this->db_connection->real_escape_string($_POST['content_textBox']);

                // check if user already exists
                $query_check_content = $this->db_connection->query("SELECT * FROM content;");

                if ($query_check_content->num_rows != 1) {

                    $query_content_insert = $this->db_connection->query("INSERT INTO content (content) VALUES('" . $this->content_text . "';");
                } else {
                    
                    $query_content_update = $this->db_connection->query("Update  content set content ='" . $this->content_text . "';");
                }
                if ($query_new_user_insert || $query_content_update) {

                    $this->messages[] = "Your account has been created/updated successfully. You can now log in.";
                    
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