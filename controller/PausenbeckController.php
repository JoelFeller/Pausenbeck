<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 29.08.2018
 * Time: 15:40
 */

class PausenbeckController
{
    public function Pausenbeck()
    {
        // In diesem Fall möchten wir dem Benutzer die View mit dem Namen
        //   "default_index" rendern. Wie das genau funktioniert, ist in der
        //   View Klasse beschrieben.
        $view = new View('default_index');
        $view->title = 'Pausenbeck';
        $view->heading = 'Startseite';
        $view->display();
    }
}