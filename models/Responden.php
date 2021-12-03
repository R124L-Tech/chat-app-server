<?php
class Responden
{
    // Database
    private $conn;
    private $table = 'responden';

    // Responden properties
    public $nama;
    public $jkel;
    public $tglLahir;
    public $seringDengar;
    public $ikutPerkembangan;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create responden
    public function create()
    {
        // Create query
        $query = 'INSERT INTO responden (nama, jenis_kelamin, tanggal_lahir, sering_dengar, ikut_perkembangan) 
            VALUES (:nama, :jkel, :tglLahir, :seringDengar, :ikutPerkembangan)';

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
        $stmt->bindParam(':seringDengar', $this->seringDengar);
        $stmt->bindParam(':ikutPerkembangan', $this->ikutPerkembangan);

        // Execute query
        if ($this->nama != '') {
            $stmt->execute();
            return $this->conn->lastInsertId();
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // read matched contact
    public function readMatchContact()
    {
        // Create query
        $queryCondition = "WHERE '' in (jkel) ";
        foreach ($this->contacts as $c) {
            $queryCondition .= "or '" . $c . "' in (jkel)";
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
                "nama" => $contact['nama'],
                "phoneNumber" => $contact['jkel'],
                "profileImage" => $contact['tglLahir'],
            );
            array_push($this->filteredContacts, $arr);
        }
    }
}
