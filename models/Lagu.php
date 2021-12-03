<?php
class Lagu
{
    // Database
    private $conn;

    // Lagu properties
    public $dataLagu;
    public $idYoutube;
    public $artis;
    public $judul;
    public $tahun;
    public $topik;
    public $lirik;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // upload responden
    public function upload()
    {
        $query = 'INSERT INTO lagu (id_lagu, id_youtube, artis, judul, tahun, topik) 
        VALUES (:id, :youtubeId, :artis, :judul, :tahun, :topik)';

        foreach ($this->dataLagu as $l) {
            // upload query
            $query = 'INSERT INTO lagu (id_lagu,id_youtube, artis, judul, tahun, topik, lirik) 
            VALUES (:id, :youtubeId, :artis, :judul, :tahun, :topik, :lirik)';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $l->id);
            $stmt->bindParam(':youtubeId', $l->youtubeId);
            $stmt->bindParam(':artis', $l->artis);
            $stmt->bindParam(':judul', $l->judul);
            $stmt->bindParam(':tahun', $l->tahun);
            $stmt->bindParam(':topik', $l->topik);
            $stmt->bindParam(':lirik', $l->lirik);
            $stmt->execute();
        }
    }

    // read matched contact
    public function readMatchContact()
    {
        // upload query
        $queryCondition = "WHERE '' in (artis) ";
        foreach ($this->contacts as $c) {
            $queryCondition .= "or '" . $c . "' in (artis)";
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
                "idYoutube" => $contact['idYoutube'],
                "phoneNumber" => $contact['artis'],
                "profileImage" => $contact['tglLahir'],
            );
            array_push($this->filteredContacts, $arr);
        }
    }
}
