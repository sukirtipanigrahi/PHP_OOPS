<?php


class Registration {

    private     $db_connection              = null;                     // database connection   
    
    private     $user_name                  = "";                       // user's name
    private     $user_email                 = "";                       // user's email
    private     $user_password              = "";                       // user's password (what comes from POST)
    private     $user_password_hash         = "";                       // user's hashed and salted password
    
    public      $registration_successful    = false;

    public      $errors                     = array();                  // collection of error messages
    public      $messages                   = array();                  // collection of success / neutral messages
    
    
      
    public function __construct() {
        
            if (isset($_POST["register"])) {
                
                $this->registerNewUser();
                
            }        
    }

    /**
     * registerNewUser
     * 
     * handles the entire registration process. checks all error possibilities, and creates a new user in the database if
     * everything is fine
     */
    private function registerNewUser() {
        
        if (empty($_POST['user_name'])) {
          
            $this->errors[] = "Empty Username";

        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
          
            $this->errors[] = "Empty Password";            
            
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
          
            $this->errors[] = "Password and password repeat are not the same";   
            
        } elseif (strlen($_POST['user_name']) > 64) {
            
            $this->errors[] = "Username cannot be longer than 64 characters";
                        
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            
            $this->errors[] = "Username does not fit the name sheme: only a-Z and numbers are allowed, 2 to 64 characters";
            
        } elseif (empty($_POST['user_email'])) {
            
            $this->errors[] = "Email cannot be empty";
            
        } elseif (strlen($_POST['user_email']) > 64) {
            
            $this->errors[] = "Email cannot be longer than 64 characters";
            
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) { //\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b
            
            $this->errors[] = "Your email adress is not in a valid email format";
        
        } elseif (!empty($_POST['user_name'])
                  && strlen($_POST['user_name']) <= 64
                  && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
                  && !empty($_POST['user_email'])
                  && strlen($_POST['user_email']) <= 64
                  && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
                  && !empty($_POST['user_password_new']) 
                  && !empty($_POST['user_password_repeat']) 
                  && ($_POST['user_password_new'] === $_POST['user_password_repeat'])) {
            
            

            // creating a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                
                $this->user_name            = $this->db_connection->real_escape_string($_POST['user_name']);
                $this->user_password        = $this->db_connection->real_escape_string($_POST['user_password_new']);
                $this->user_email           = $this->db_connection->real_escape_string($_POST['user_email']);

                // cut password to 1024 chars to prevent too much calculation
                $this->user_password        = substr($this->user_password, 0, 1024);

               
                $this->user_password_hash = md5($this->user_password);

                // check if user already exists
                $query_check_user_name = $this->db_connection->query("SELECT * FROM users WHERE user_name = '".$this->user_name."';");

                if ($query_check_user_name->num_rows == 1) {

                    $this->errors[] = "Sorry, that user name is already taken.<br/>Please choose another one.";

                } else {

                    // write new users data into database
                    $query_new_user_insert = $this->db_connection->query("INSERT INTO users (user_name, user_password_hash, user_email) VALUES('".$this->user_name."', '".$this->user_password_hash."', '".$this->user_email."');");

                    if ($query_new_user_insert) {

                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                        $this->registration_successful = true;

                    } else {

                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";

                    }
                }

            } else {

                $this->errors[] = "Sorry, no database connection.";

            }
            
        } else {
            
            $this->errors[] = "An unknown error occured.";
            
        }
        
    }

}