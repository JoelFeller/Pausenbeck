<?php
require_once '../lib/Repository.php';

class BestellungRepository extends Repository
{
    protected $tableName = 'bestellungen';

    public function insertAngebotName($bestellungen){
        foreach($bestellungen as $bestellung) {
            $query="SELECT name FROM angebot WHERE aid=?";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('i', $bestellung->aid);
            $statement->execute();
            $result = $statement->get_result();
            while($res = $result->fetch_array(MYSQLI_NUM)){
                foreach($res as $r){
                    $bestellung->aid = $r;
                }
            }
        }
    }

    public function doDelete($code){
        $query="DELETE FROM bestellungen WHERE code=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $code);
        $statement->execute();
    }
}