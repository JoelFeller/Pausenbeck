<?php
require_once '../lib/Repository.php';

class WarenRepository extends Repository
{
    protected $tableName = 'angebot';

    public function doRaise($aid, $anzahl)
    {
        $query = "UPDATE angebot SET anzahl=? WHERE aid=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $anzahl, $aid);
        $statement->execute();
    }
    public function doDrop($aid, $anzahl)
    {
        $query = "UPDATE angebot SET anzahl=? WHERE aid=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $anzahl, $aid);
        $statement->execute();
    }
    public function doOrder($user){
        session_start();
        $counter = 0;
        foreach($_SESSION['bestellteWare'] as $ware){
            $query="UPDATE angebot SET anzahl=anzahl-? WHERE name=?";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('is', $_SESSION['bestellteAnzahl'][$counter], $ware);
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
            $query="INSERT INTO bestellungen(uid, aid, anzahl) VALUES (?,?,?)";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('iii',$user->uid, $aid, $_SESSION['bestellteAnzahl'][$counter]);
            $statement->execute();
            $counter++;
        }
    }
}