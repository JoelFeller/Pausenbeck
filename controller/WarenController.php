<?php
require_once '../repository/WarenRepository.php';
require_once '../repository/UserRepository.php';

class WarenController
{
    public function angebote()
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
        session_start();
        $warenRepository = new WarenRepository();
        $userRepository = new UserRepository();
        $view = new View('warenkorb_index');
        $view->title = 'Warenkorb';
        $view->heading = 'Warenkorb';
        $view->user = $userRepository->readById($_SESSION['id']);
        $view->angebote = $warenRepository->readAll();
        $view->display();
    }

    public function raiseStock()
    {
        $warenRepository = new WarenRepository();
        $aid = $_GET['aid'];
        $anzahl = $_GET['anz'];
        $anzahl++;
        $warenRepository->doRaise($aid, $anzahl);
        header("location: angebote");
    }

    public function dropStock()
    {
        $warenRepository = new WarenRepository();
        $aid = $_GET['aid'];
        $anzahl = $_GET['anz'];
        $anzahl--;
        $warenRepository->doDrop($aid, $anzahl);
        header("location: angebote");
    }
    public function raiseBestellt(){
        session_start();
        $position = $_GET['pos'];
        $_SESSION['bestellteAnzahl'][$position] = $_SESSION['bestellteAnzahl'][$position]+1;
        header("location: angebote");
    }

    public function dropBestellt() {
        session_start();
        $position = $_GET['pos'];
        $_SESSION['bestellteAnzahl'][$position] = $_SESSION['bestellteAnzahl'][$position]-1;
        header("location: angebote");
    }

    public function order() {
        session_start();
        $warenRepository = new WarenRepository();
        $userRepository = new UserRepository();
        $user = $userRepository->readById($_SESSION['id']);
        $counter = 0;
        foreach($_SESSION['bestellteAnzahl'] as $anz){
            if($anz == 0){
                unset($_SESSION['bestellteAnzahl'][$counter]);
                unset($_SESSION['bestellteWare'][$counter]);
            }
            $counter++;
        }
        $warenRepository->doOrder($user);
        unset($_SESSION['init']);
        header("location: angebote");
    }
}