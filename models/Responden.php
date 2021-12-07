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
        $query = 'INSERT INTO responden (nama, jenis_kelamin, tanggal_lahir, sering_dengar, ikut_perkembangan, lelah_before, mengantuk_before) 
            VALUES (:nama, :jkel, :tglLahir, :seringDengar, :ikutPerkembangan,:lelah, :mengantuk)';

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
        $stmt->bindParam(':lelah', $this->lelah);
        $stmt->bindParam(':mengantuk', $this->mengantuk);

        // Execute query
        if ($this->nama != '') {
            $stmt->execute();
            return $this->conn->lastInsertId();
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
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
