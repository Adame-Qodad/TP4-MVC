<?php 
    $action=$_GET['action'];
    switch($action)
    {
        case 'list' :
            $libelle="";
        $continentSel="Tous";
        if(!empty($_POST['libelle'])  ||  !empty($_POST['continent'])){
                $libelle= $_POST['libelle'];
                $continentSel= $_POST['continent'];
        }
        $lesContinents=Continent::findAll();
        $lesNationalites=Nationalite::findAll($libelle, $continentSel);
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
            $laNationalite = Nationalite::findById($_GET['num']);
            include ('vues/formNationalite.php');
            break;
        case 'valide' :
            $nationalite= new Nationalite;
            if(empty($_POST['num']))//cas d'un ajout
            {
                $nationalite->setLibelle($_POST['libelle']);
                $nationalite->setNumContinent(Continent::findById($_POST['continent']));
                $nb=Nationalite::add($nationalite);
                $message = "créer";
            }

            else //cas d'une modification
            {
                $nationalite->setLibelle($_POST['libelle']);
                $nationalite->setNum($_POST['num']);
                $nationalite->setNumContinent(Continent::findById($_POST['continent']));
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
            $nationalite = Nationalite::findById($_GET['num']);
            $nb=Nationalite::delete($nationalite);

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