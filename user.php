<?php

require_once 'login.php';

class User
{
    public $username;
    //public $roles = array();
	/*
    function __construct($username)
    {
        global $conn;

        $this->username = $username;

        // Check if $username is not empty before querying the database
        if (!empty($username)) {
            // Use prepared statement to prevent SQL injection
            $query = "SELECT r.Role 
          FROM roles r 
          LEFT JOIN employee e ON CAST(r.Role_ID AS CHAR) = CAST(e.Role_ID AS CHAR)
          LEFT JOIN customer c ON CAST(r.Role_ID AS CHAR) = CAST(c.Role_ID AS CHAR)
          WHERE e.Username = ? OR c.Username = ?";

            $stmt = $conn->prepare($query);
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("s", $username);
            if (!$stmt->execute()) {
                die("Error executing statement: " . $stmt->error);
            }
            $result = $stmt->get_result();

            if (!$result) {
                die("Error fetching roles: " . $conn->error);
            }

            // Fetch roles and store them in the class property
            $roles = array();
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row['Role'];
            }

            $this->roles = $roles;
        } else {
            // If $username is empty, set the default role
            $this->roles = $roles;
        }
    }*/
	
	function __construct($username)
    {
        global $conn;

        $this->username = $username;
		
		
		
	}

    
}

?>
