<?php
require_once '../lib/Repository.php';

class WarenRepository extends Repository
{
    protected $tableName = 'angebot';
    protected $bestellungCounter;

    public function doRaise($aid, $anzahl)
    {
        $query = "UPDATE $this->tableName SET anzahl=? WHERE aid=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $anzahl, $aid);
        $statement->execute();
    }
    public function doDrop($aid, $anzahl)
    {
        $query = "UPDATE $this->tableName SET anzahl=? WHERE aid=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $anzahl, $aid);
        $statement->execute();
    }
    public function doOrder($user){
        session_start();
        $counter = 0;
        $code = $this->generateRandomString();
        $anzahl = array();
        foreach($_SESSION['bestellteAnzahl'] as $anz) {
            array_push($anzahl, $anz);
        }
        foreach($_SESSION['bestellteWare'] as $ware){
            $query="UPDATE $this->tableName SET anzahl=anzahl-? WHERE name=?";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('is', $anzahl[$counter], $ware);
            $statement->execute();
            $query = "SELECT aid FROM angebot WHERE name=?";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('s', $ware);
            $statement->execute();
            $result = $statement->get_result();
            while($res = $result->fetch_array(MYSQLI_NUM)){
                foreach($res as $r){
                    $aid = $r;
                }
            }
            $query="INSERT INTO bestellungen(uid, aid, anzahl, code) VALUES (?,?,?,?)";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('iiis', $user->uid, $aid, $anzahl[$counter], $code);
            $statement->execute();
            $counter++;
        }
    }

    function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}