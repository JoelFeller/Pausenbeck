<?php
require_once '../repository/WarenRepository.php';
require_once '../repository/UserRepository.php';

class WarenController
{
    public function angebot()
    {
        session_start();
        $warenRepository = new WarenRepository();
        $userRepository = new UserRepository();
        $view = new View('angebote_list');
        $view->title = 'Angebote';
        $view->heading = 'Angebote';
        $view->user = $userRepository->readById($_SESSION['id']);
        $view->angebote = $warenRepository->readAll();
        $view->display();
    }

    public function warenkorb()
    {
        $view = new View('warenkorb_index');
        $view->title = 'Warenkorb';
        $view->heading = 'Warenkorb';
        $view->display();
    }

    public function raiseStock()
    {
        $warenRepository = new WarenRepository();
        $aid = $_GET['aid'];
        $anzahl = $_GET['anz'];
        $anzahl++;
        $warenRepository->doRaise($aid, $anzahl);
        header("location: angebot");
    }

    public function dropStock()
    {
        $warenRepository = new WarenRepository();
        $aid = $_GET['aid'];
        $anzahl = $_GET['anz'];
        $anzahl--;
        $warenRepository->doDrop($aid, $anzahl);
        header("location: angebot");
    }
}