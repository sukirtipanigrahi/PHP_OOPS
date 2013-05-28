<?php

class Preference {

    private $db_connection = null;                     // database connection   
    private $preference = true;
    public $errors = array();                  // collection of error messages
    public $messages = array();                  // collection of success / neutral messages

    public function __construct() {

        if (isset($_POST['preference'])) {
            $this->updatePreference();
        }
    }

    private function updatePreference() {

        if (isset($_POST['preference_check'])) {
            $this->preference = "1";
        } else {
            $this->preference = "0";
        }
        // creating a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

                        // check if user already exists
            $query_check_content = $this->db_connection->query("SELECT * FROM preference;");

            if ($query_check_content->num_rows != 1) {

                $query_content_insert = $this->db_connection->query("INSERT INTO preference (preference) VALUES('" . $this->preference . "';");
            } else {

                $query_content_update = $this->db_connection->query("Update  preference  set preference ='" . $this->preference . "';");
            }
            if ($query_new_user_insert || $query_content_update) {

                $this->messages[] = "Your preference has been created/updated successfully. You can now log in.";
            } else {

                $this->errors[] = "Sorry, your updation failed. Please go back and try again.";
            }
        } else {

            $this->errors[] = "Sorry, no database connection.";
        }
    }

}