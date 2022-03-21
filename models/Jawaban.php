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
        foreach ($this->jawaban as $ans) {
            $query = 'INSERT INTO `jawaban` (
                `id_responden`, 
                `domain_berita`, 
                `learnability`, 
                `match`, 
                `control`,
                `consistency`, 
                `error_prevention`, 
                `recognition`, 
                `flexibility`, 
                `asthetic`, 
                `recognize_errors`, 
                `help`
                ) VALUES (
                    :idResponden,
                    :domainBerita, 
                    :learnability, 
                    :match, 
                    :control, 
                    :consistency, 
                    :errorPrevention, 
                    :recognition, 
                    :flexibility, 
                    :asthetic, 
                    :recognizeErrors, 
                    :help
                    );';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':idResponden', $this->idResponden);
            $stmt->bindParam(':domainBerita', $ans->domainBerita);
            $stmt->bindParam(':learnability', $ans->learnability);
            $stmt->bindParam(':match', $ans->match);
            $stmt->bindParam(':control', $ans->control);
            $stmt->bindParam(':consistency', $ans->consistency);
            $stmt->bindParam(':errorPrevention', $ans->errorPrevention);
            $stmt->bindParam(':recognition', $ans->recognition);
            $stmt->bindParam(':flexibility', $ans->flexibility);
            $stmt->bindParam(':asthetic', $ans->asthetic);
            $stmt->bindParam(':recognizeErrors', $ans->recognizeErrors);
            $stmt->bindParam(':help', $ans->help);
            $stmt->execute();
        }
    }
}
