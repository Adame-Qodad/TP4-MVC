<?php 
    $action=$_GET['action'];
    switch($action)
    {
        case 'list' :
            $lesGenres = Genre::findAll();
            include ('vues/listeGenre.php');
            break; 
        case 'add' :
            $mode="Ajouter";
            include ('vues/formGenre.php');
            break;
        case 'update' :
            $mode="Modifier";
            $genre = Genre::findById($_GET['num']);
            include ('vues/formGenre.php');
            break;
        case 'valide' :
            $genre= new Genre;
            if(empty($_POST['num']))//cas d'un ajout
            {
                $genre->setLibelle($_POST['libelle']);
                $nb=Genre::add($genre);
                $message = "créer";
            }

            else //cas d'une modification
            {
                $genre->setLibelle($_POST['libelle']);
                $genre->setNum($_POST['num']);
                $nb=Genre::update($genre);
                $message = "modifier";
            }

            if($nb==1)
            {
              $_SESSION['message']=["success"=>"Le genre a bien été $message"];
            }

            else
            {
                $_SESSION['message']=["danger"=>"Le genre n'a pas été $message"]; 
            }
            header('location: index.php?uc=genre&action=list');
            break;

        case 'delete' :
            $genre = Genre::findById($_GET['num']);
            $nb=Genre::delete($genre);

            if($nb==1)
            {
              $_SESSION['message']=["success"=>"Le genre a bien été supprimer"];
            }

            else
            {
                $_SESSION['message']=["danger"=>"Le genre n'a pas été supprimer"]; 
            }
            header('location: index.php?uc=genre&action=list');
            exit();
            break;
    }