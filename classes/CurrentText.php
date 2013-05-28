<?php

class CurrentText {

    private $db_connection = null;                     // database connection   
    public $content_text = "";
    public $footer1 = "";
    public $footer2 = "";
    public $footer3 = "";
    public $preference = "";
    public $errors = array();                  // collection of error messages
    public $messages = array();                  // collection of success / neutral messages

    public function __construct() {
        $this->getDetails();
    }

    private function getDetails() {

        // creating a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

            // check if user already exists
            $get_content = $this->db_connection->query("SELECT * FROM content;");

            if ($get_content->num_rows == 1) {
                $result_row = $get_content->fetch_object();
                $this->content_text = $result_row->content;
            }

            // check if user already exists
            $get_footer = $this->db_connection->query("SELECT * FROM footer;");

            if ($get_footer->num_rows == 1) {
                $result_row = $get_footer->fetch_object();
                $this->footer1 = $result_row->footer1;
                $this->footer2 = $result_row->footer2;
                $this->footer3 = $result_row->footer3;
            }

            // check if user already exists
            $get_preference = $this->db_connection->query("SELECT * FROM preference;");

            if ($get_preference->num_rows == 1) {
                $result_row = $get_preference->fetch_object();
                $this->preference = $result_row->preference;
            }
        }
    }

}