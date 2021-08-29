<?php
class User
{
    // Database
    private $conn;
    private $table = 'users';

    // User properties
    public $uid;
    public $username;
    public $phone_number;
    public $profile_image;

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
}
