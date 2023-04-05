<?php 
    $action=$_GET['action'];
    switch($action)
    {
        case 'list' :
            $lesAuteurs=Auteur::findAll();
            include ('vues/listeAuteur.php');
            break; 
        case 'add' :
            $lesNationalites=Nationalite::findAll();
            $mode="Ajouter";
            include ('vues/formAuteur.php');
            break;
        case 'update' :
            $lesNationalites=Nationalite::findAll();
            $mode="Modifier";
            $leAuteur = Auteur::findById($_GET['num']);
            include ('vues/formAuteur.php');
            break;
        case 'valide' :
            $auteur= new Auteur;
            if(empty($_POST['num']))//cas d'un ajout
            {
                $auteur->setNom($_POST['nom']);
                $auteur->setPrenom($_POST['prenom']);
                $auteur->setNumNationalite(Nationalite::findById($_POST['nationalite']));
                $nb=Auteur::add($auteur);
                $message = "créer";
            }

            else //cas d'une modification
            {
                $auteur->setNom($_POST['nom']);
                $auteur->setPrenom($_POST['prenom']);
                $auteur->setNum($_POST['num']);
                $auteur->setNumNationalite(Nationalite::findById($_POST['nationalite']));
                $nb=Auteur::update($auteur);
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
            header('location: index.php?uc=auteur&action=list');
            break;

        case 'delete' :
            $auteur = Auteur::findById($_GET['num']);
            $nb=Auteur::delete($auteur);

            if($nb==1)
            {
              $_SESSION['message']=["success"=>"La nationalitée a bien été supprimer"];
            }

            else
            {
                $_SESSION['message']=["danger"=>"La nationalitée n'a pas été supprimer"]; 
            }
            header('location: index.php?uc=auteur&action=list');
            exit();
            break;
    }