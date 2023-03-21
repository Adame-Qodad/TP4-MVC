<?php 
    $action=$_GET['action'];
    switch($action)
    {
        case 'list' :
            $lesContinents=Continent::findAll();
            include ('vues/listeContinent.php');
            break; 
        case 'add' :
            $mode="Ajouter";
            include ('vues/formContinent.php');
            break;
        case 'update' :
            $mode="Modifier";
            $continent = Continent::findById($_GET['num']);
            include ('vues/formContinent.php');
            break;
        case 'valide' :
            $continent= new Continent;
            if(empty($_POST['num']))//cas d'un ajout
            {
                $continent->setLibelle($_POST['libelle']);
                $nb=Continent::add($continent);
                $message = "créer";
            }

            else //cas d'une modification
            {
                $continent->setLibelle($_POST['libelle']);
                $continent->setNum($_POST['num']);
                $nb=Continent::update($continent);
                $message = "modifier";
            }

            if($nb==1)
            {
              $_SESSION['message']=["success"=>"Le continent a bien été $message"];
            }

            else
            {
                $_SESSION['message']=["danger"=>"Le continent n'a pas été $message"]; 
            }
            header('location: index.php?uc=continents&action=list');
            break;

        case 'delete' :
            $continent = Continent::findById($_GET['num']);
            $nb=Continent::delete($continent);

            if($nb==1)
            {
              $_SESSION['message']=["success"=>"Le continent a bien été supprimer"];
            }

            else
            {
                $_SESSION['message']=["danger"=>"Le continent n'a pas été supprimer"]; 
            }
            header('location: index.php?uc=continents&action=list');
            exit();
            break;
    }