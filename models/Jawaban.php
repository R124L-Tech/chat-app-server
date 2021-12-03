<?php
class Jawaban
{
    // database
    private $conn;

    // Jawaban properties
    public $idResponden;
    public $jawaban;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // upload responden
    public function uploadJawaban()
    {
        $query = 'INSERT INTO jawaban (id_responden, id_lagu, pernah_dengar, sumber, popularitas, sentimen) 
        VALUES (:idResponden, :idLagu,  :pernahDengar, :sumber, :popularitas, :sentimen)';

        foreach ($this->jawaban as $ans) {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':idResponden', $this->idResponden);
            $stmt->bindParam(':idLagu', $ans->idLagu);
            $stmt->bindParam(':pernahDengar', $ans->pernahDengar - 1);
            $stmt->bindParam(':sumber', $ans->sumber);
            $stmt->bindParam(':popularitas', $ans->popularitas);
            $stmt->bindParam(':sentimen', $ans->sentimen);
            $stmt->execute();
        }
    }


    // read conversation
    public function getJawaban()
    {
        // create query
        $getJawabanQuery = "SELECT responden.nama, responden.jenis_kelamin, responden.tanggal_lahir, jawaban.pernah_dengar, jawaban.dengar_dimana, jawaban.popularitas, jawaban.sentimen 
        FROM responden INNER JOIN jawaban ON jawaban.id_responden = responden.id_responden";

        // prepare statement
        $stmt = $this->conn->prepare($getJawabanQuery);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetchAll();

        // set properties
        foreach ($row as $ans) {
            $arr = array(
                "id" => $ans['nama'],
                "sendTime" => $ans['jenis_kelamin'],
                "Jawaban" => $ans['tanggal_lahir'],
                "sender" => $ans['pernah_dengar'],
                "receiver" => $ans['dengar_dimana'],
                "receiver" => $ans['popularitas']
            );
            array_push($this->Jawabans, $arr);
        }
        // update unread to false
        // $this->updateUnread();
        return $this->Jawabans;
    }
}
