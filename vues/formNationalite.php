<div class="container mt-5">
        <h2 class="pt-4 text-center"><?php echo $mode ?> une Nationalitée</h2>
        <form action="valideFormNatio.php?action=<?php echo $mode ?>" method="post" class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for='libelle' > Nationalité </label>
                <input type="text" class='form-control' id='libelle' placehoder='Saisir la nationalité' name='libelle' value="<?php     if ($mode == "Modifier") { echo $laNationalite->libelle; } ?>">
            </div>
            <div class="form-group">
                <label for='continent' > Continent </label>
                <select name="continent" class='form-control'>

                    <?php

                    foreach($lesContinents as $continent)
                    
                    {
                        $selection=$continent->getNum() == $laNationalite->numContinent ? 'selected' : '';
                        echo  "<option value='".$continent->getNum()."' $selection>".$continent->getLibelle()."</option>";
                    }

                    ?>
                </select>

                   
            </div>
            <input type="hidden" id="num" name="num" value="<?php     if ($mode == "Modifier"){ echo $laNationalite->getNum(); } ?>">
            <div class="row">
                <div class="col"><a href="index.php?uc=nationalite&action=list" class='btn btn-danger btn-block'>Revenir à la liste</a></div>
                <div class="col"><button type='submit' class='btn btn-success btn-block'> <?php echo $mode ?> </button></div>
            </div>
        </form>
    </div>
