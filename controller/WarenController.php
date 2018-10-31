<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 17.09.2018
 * Time: 14:43
 */

class WarenController
{
    public function angebot()
    {
        $view = new View('angebote_list');
        $view->title = 'Angebote';
        $view->heading = 'Angebote';
        $view->display();
    }

    public function warenkorb()
    {
        $view = new View('warenkorb_index');
        $view->title = 'Warenkorb';
        $view->heading = 'Warenkorb';
        $view->display();
    }
}