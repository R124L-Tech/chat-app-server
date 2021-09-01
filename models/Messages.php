<?php
class Message
{
    // database
    private $conn;
    private $table = 'message';

    // Message properties
    public $messages = [];
    public $sender;
    public $receiver;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read conversation
    public function readConversation()
    {
        // create query
        $query = "SELECT * FROM " . $this->table . " 
                WHERE :sender in (sender) and :receiver in (receiver) 
                OR :receiver in (sender) and :sender in (receiver)
                ORDER BY send_time";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // bind params
        $stmt->bindParam(':sender', $this->sender);
        $stmt->bindParam(':receiver', $this->receiver);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetchAll();

        // set properties
        foreach ($row as $msg) {
            $arr = array(
                "sendTime" => $msg['send_time'],
                "type" => $msg['sender'] == $this->sender ? "send" : "receive",
                "message" => $msg['message'],
            );
            array_push($this->messages, $arr);
        }
        return $this->messages;
    }
}
