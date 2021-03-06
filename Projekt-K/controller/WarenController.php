
<?php

require_once 'model/WarenModel.php';
require_once 'model/FilialenModel.php';
/**
 * Siehe Dokumentation im DefaultController.
 */
class WarenController
{
    public function index()
    {
        $login = false;
        $warenModel = new WarenModel();

        $view = new View('waren_index');
        $view->title = 'Waren';
        $view->heading = 'Waren';
        $view->waren = $warenModel->readAll();
        $view->display($login);

          
    }
    public function search()
    {
        $login = false;
        $view = new View('waren_index');
        $view->title = 'Waren';
        $view->heading = 'Waren';
                    $ware = $_POST['suchen'];
        $ware = "%$ware%";
            $warenModel = new WarenModel();
            $view->waren = $warenModel->search($ware);

        $view->display($login);

    }
    public function create()
    {
        $login = false;
        $view = new View('waren_create');
        $view->title = 'Waren erstellen';
        $view->heading = 'Waren erstellen';
        $view->display($login);
    }
    public function doCreate()
    {
        if ($_POST['warencreate']) {
            $name = $_POST['ware'];
            $preis = $_POST['preis'];
            $filialenname = $_POST['filiale'];
            $menge = $_POST['menge'];

            $warenModel = new WarenModel();
            // FilialenID auslesen
            $filialenModel = new FilialenModel();
        $filialen = $filialenModel->readAll();
            $create = true;
          foreach ($filialen as $filiale){
             if($filiale->name == $filialenname){$create = false;
            $filialenid = $filiale->id;}
          }  
            if($create){
            $filialenModel->create($filialenname, $create);
            $filialenid = $filialenModel->readIdByName($filialenname);
            echo($filialenid);}
            $warenModel->create($name, $preis, $filialenid, $menge);
        }

        // Anfrage an die URI /waren weiterleiten (HTTP 302)
        header('Location: /Projekt-K/waren/index');
    }
    public function edit()
    {
        $login = false;
        $view = new View('waren_edit');
        $view->title = 'Waren bearbeiten';
        $view->heading = 'Waren bearbeiten';
        $warenModel = new WarenModel();
        $view->waren = $warenModel->readById($_GET['id']);
        $view->display($login);
    }
 public function doEdit()
    {
        if ($_POST['warenedit']) {
            $name = $_POST['ware'];
            $preis = $_POST['preis'];
            $filialenname = $_POST['filiale'];
            $menge = $_POST['menge'];
            
            $warenModel = new WarenModel();
            $id = $_GET['id'];
            // FilialenID auslesen
            $filialenModel = new FilialenModel();
                 $filialen = $filialenModel->readAll();
            $create = true;
          foreach ($filialen as $filiale){
             if($filiale->name == $filialenname){$create = false;
            $filialenid = $filiale->id;}
          }  
            if($create){
            $filialenModel->create($filialenname, $create);
            $filialenid = $filialenModel->readIdByName($filialenname);
            echo($filialenid);}
            $warenModel->edit($name, $preis, $filialenid, $menge, $id);
        }

        // Anfrage an die URI /waren weiterleiten (HTTP 302)
        header('Location: /Projekt-K/waren/index');
    }
    public function delete()
    {
        $warenModel = new warenModel();
        $warenModel->deleteById($_GET['id']);

        // Anfrage an die URI /waren weiterleiten (HTTP 302)
        header('Location: /Projekt-K/waren/index');
    }
}

