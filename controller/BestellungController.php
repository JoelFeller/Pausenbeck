<?php
require_once '../repository/BestellungRepository.php';
require_once '../repository/WarenRepository.php';
require_once '../repository/UserRepository.php';

class BestellungController
{
    public function uebersicht() {
        session_start();
        $bestellungRepository = new BestellungRepository();
        $warenRepository = new WarenRepository();
        $userRepository = new UserRepository();
        $view = new View('bestellung_index');
        $view->bestellungen = $bestellungRepository->readAll();
        $view->waren = $warenRepository->readAll();
        $view->user = $userRepository->readById($_SESSION['id']);
        $view->title = 'Bestellung';
        $view->heading = 'Bestellung';
        $view->display();
    }

    public function deleteBestellung() {
        $bestellungRepository = new BestellungRepository();
        $code = $_GET['code'];
        $bestellungRepository->doDelete($code);
        header("location: uebersicht");
    }
}