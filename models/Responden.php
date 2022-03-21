<?php
class Responden
{
    // Database
    private $conn;

    // Responden properties

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create responden
    public function create()
    {
        // Create query
        $query = 'INSERT INTO responden (nama, jenis_kelamin, tanggal_lahir, sering_browsing) 
            VALUES (:nama, :jkel, :tglLahir, :seringBrowsing)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->jkel = htmlspecialchars(strip_tags($this->jkel));
        $this->tglLahir = htmlspecialchars(strip_tags($this->tglLahir));

        // Bind data
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':jkel', $this->jkel);
        $stmt->bindParam(':tglLahir', $this->tglLahir);
        $stmt->bindParam(':seringBrowsing', $this->seringBrowsing);

        // Execute query
        if ($this->nama != '') {
            $stmt->execute();
            return $this->conn->lastInsertId();
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // get matched song
    public function getRespLength()
    {
        // upload query
        $query = "SELECT * FROM responden";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        $arr = array('countResp' => $stmt->rowCount(),);
        return $arr;
    }

    // update kondisi
    public function updateKondisi()
    {
        // create query
        $query = "UPDATE `responden` SET `lelah_after` = :lelah, `mengantuk_after` = :mengantuk WHERE `responden`.`id_responden` = :idResponden";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':idResponden', $this->idResponden);
        $stmt->bindParam(':lelah', $this->lelah);
        $stmt->bindParam(':mengantuk', $this->mengantuk);

        $stmt->execute();
    }
}
