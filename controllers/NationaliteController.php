<?php 
    $action=$_GET['action'];
    switch($action)
    {
        case 'list' :
            $lesNationalites=Nationalite::findAll();
            include ('vues/listeNationalite.php');
            break; 
        case 'add' :
            $lesContinents=Continent::findAll();
            $mode="Ajouter";
            include ('vues/formNationalite.php');
            break;
        case 'update' :
            $lesContinents=Continent::findAll();
            $mode="Modifier";
            $nationalite = Nationalite::findById($_GET['num']);
            include ('vues/formNationalite.php');
            break;
        case 'valide' :
            $nationalite= new Nationalite;
            if(empty($_POST['num']))//cas d'un ajout
            {
                $natinalite->setLibelle($_POST['libelle']);
                $nb=Nationalite::add($nationalite);
                $message = "créer";
            }

            else //cas d'une modification
            {
                $nationalite->setLibelle($_POST['libelle']);
                $nationalite->setNum($_POST['num']);
                $nb=Nationalite::update($nationalite);
                $message = "modifier";
            }

            if($nb==1)
            {
              $_SESSION['message']=["success"=>"La nationalitée a bien été $message"];
            }

            else
            {
                $_SESSION['message']=["danger"=>"La nationalitée n'a pas été $message"]; 
            }
            header('location: index.php?uc=nationalite&action=list');
            break;

        case 'delete' :
            $continent = Continent::findById($_GET['num']);
            $nb=Continent::delete($continent);

            if($nb==1)
            {
              $_SESSION['message']=["success"=>"La nationalitée a bien été supprimer"];
            }

            else
            {
                $_SESSION['message']=["danger"=>"La nationalitée n'a pas été supprimer"]; 
            }
            header('location: index.php?uc=nationalite&action=list');
            exit();
            break;
    }