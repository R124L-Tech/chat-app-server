<?php
class Lagu
{
    // Database
    private $conn;

    // Lagu properties
    public $judul;
    public $Lagu = [];

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

    // get All songs
    public function getJudulLagu()
    {
        // create query
        $query = "SELECT judul, topik, id_lagu FROM lagu
        ORDER BY case when topik = :topik1 then 1
                      when topik = :topik2 then 2
                      when topik = :topik3 then 3
                      else 4
                 end asc";

        // prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':topik1', $this->topik1);
        $stmt->bindParam(':topik2', $this->topik2);
        $stmt->bindParam(':topik3', $this->topik3);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetchAll();

        // set properties
        foreach ($row as $ans) {
            array_push($this->Lagu, $ans['judul']);
        }
        return $this->Lagu;
    }

    // get matched song
    public function getMatchSongs()
    {
        // upload query
        $query = "SELECT * FROM lagu WHERE lagu.judul LIKE :judul";

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':judul', $this->judul);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetchAll();

        // set properties
        foreach ($row as $ans) {
            $arr = array(
                "id" => $ans['id_lagu'],
                "youtubeId" => $ans['id_youtube'],
                "artis" => $ans['artis'],
                "topik" => $ans['topik'],
                "judul" => $ans['judul'],
                "tahun" => $ans['tahun'],
                "lirik" => $ans['lirik'],
            );
            return $arr;
        }
    }

    // get matched song
    public function getLagu()
    {
        // upload query
        $query = "SELECT id_lagu, judul, topik, lirik FROM lagu";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetchAll();

        // set properties
        foreach ($row as $ans) {
            $sum = 0;
            $length = 0;

            // upload query
            $query2 = "SELECT sentimen FROM jawaban WHERE id_lagu=:idLagu";

            // Prepare statement
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bindParam(':idLagu', $ans['id_lagu']);

            // Execute query
            $stmt2->execute();
            $ans2 = $stmt2->fetchAll();

            foreach ($ans2 as $sen) {
                $sum += (int)$sen['sentimen'];
                $length++;
            }

            $sentimen = $sum / $length;

            $arr = array(
                "sentimen" => $sentimen,
                "id_lagu" => $ans['id_lagu'],
                "judul" => $ans['judul'],
                "topik" => $ans['topik'],
                "lirik" => $ans['lirik'],
            );
            array_push($this->Lagu, $arr);
        }
        return $this->Lagu;
    }
}
