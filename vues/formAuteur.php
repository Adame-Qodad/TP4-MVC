<div class="container mt-5">
        <h2 class="pt-4 text-center"><?php echo $mode ?> un Auteur</h2>
        <form action="index.php?uc=auteur&action=valide" method="post" class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for='libelle' > Nom </label>
                <input type="text" class='form-control' id='libelle' placehoder='Saisir le nom' name='nom' value="<?php     if ($mode == "Modifier") { echo $leAuteur->getNom(); } ?>">
            </div>
            <div class="form-group">
                <label for='libelle' > Prénom </label>
                <input type="text" class='form-control' id='libelle' placehoder='Saisir le prénom' name='prenom' value="<?php     if ($mode == "Modifier") { echo $leAuteur->getPrenom(); } ?>">
            </div>
            <div class="form-group">
                <label for='nationalite' > Nationalitée </label>
                <select name="nationalite" class='form-control'>

                    <?php
                    if ($mode == "Ajouter")
                    {
                        foreach($lesNationalites as $nationalite)
                        
                        {
                            
                            echo  "<option value='".$nationalite->num."'>".$nationalite->libNation."</option>";
                        }
                    }

                    else
                    {
                        foreach($lesNationalites as $nationalite)
                        {
                            $selection=$nationalite->num == $leAuteur->getNumNationalite() ? 'selected' : '';
                            echo  "<option value='".$nationalite->num."' $selection>".$nationalite->libNation."</option>";
                        }
                    }

                    ?>
                </select>

                   
            </div>
            <input type="hidden" id="num" name="num" value="<?php     if ($mode == "Modifier"){ echo $leAuteur->getNum(); } ?>">
            <div class="row">
                <div class="col"><a href="index.php?uc=auteur&action=list" class='btn btn-danger btn-block'>Revenir à la liste</a></div>
                <div class="col"><button type='submit' class='btn btn-success btn-block'> <?php echo $mode ?> </button></div>
            </div>
        </form>
    </div>
