<?php
class User
{
    // Database
    private $conn;
    private $table = 'user';

    // User properties
    public $uid;
    public $username;
    public $phone_number;
    public $profile_image;
    public $contacts;
    public $filteredContacts = [];

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create post
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table .
            ' (uid, username, phone_number, profile_image) 
            VALUES (:uid, :username, :phone_number, :profile_image) 
            ON DUPLICATE KEY UPDATE 
            username = :username, 
            profile_image = :profile_image';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->uid = htmlspecialchars(strip_tags($this->uid));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->profile_image = htmlspecialchars(strip_tags($this->profile_image));

        // Bind data
        $stmt->bindParam(':uid', $this->uid);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':profile_image', $this->profile_image);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // read matched contact
    public function readMatchContact()
    {
        // Create query
        $queryCondition = "WHERE '' in (phone_number) ";
        foreach ($this->contacts as $c) {
            $queryCondition .= "or '" . $c . "' in (phone_number)";
        }
        $query = "SELECT * FROM " . $this->table . " " . $queryCondition;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetchAll();

        // set properties
        foreach ($row as $contact) {
            $arr = array(
                "id" => $contact['uid'],
                "username" => $contact['username'],
                "phoneNumber" => $contact['phone_number'],
                "profileImage" => $contact['profile_image'],
            );
            array_push($this->filteredContacts, $arr);
        }
    }
}
