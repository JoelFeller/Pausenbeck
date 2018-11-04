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
}