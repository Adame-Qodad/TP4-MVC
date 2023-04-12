<div class="container mt-5">
      <div class="row pt-4">
        <div class="col-9"><h2>Liste des Nationalités</h2></div>
        <div class="col-3"><a href="index.php?uc=nationalite&action=add" class='btn btn-success'><i class="fas fa-plus-circle"></i>Créer une Nationalité</a></div>


                
        <form action="index.php?uc=nationalite&action=list" method="post" class="border border-primary rounded p-3">

<div class="row">
  

    <div class="col">

      <input type="text" class="form-control" id="libelle" placeholder="Saisir le libellé" name="libelle"  value= "<?php $libelle; ?>">
      
    </div>

    <div class="col-5">
                      <select name="continent" class='form-control'>

                          <?php
                            echo  "<option value='Tous'>Tous les continents</option>";
                            var_dump($lesContinents);
                            foreach($lesContinents as $continent)
                            { 
                                
                                $selection=$continent->getNum() == $continentSel ? 'selected' : '';
                                echo  "<option value='".$continent->getNum()."' $selection>".$continent->getLibelle()."</option>";
                            }

                          ?>
                          </select>
                    </div>
    <div class="col">
          
      <button type="submit" class="btn btn-success btn-block">Rechercher</button>

    </div>

</div>

</form>

                  
                    
                </div>
              </form>
  
    </div>    
      <table class="table table-hover table-striped">
      <thead class="thead-dark">
          <tr class="d-flex">
          <th scope="col" class="col-md-3">Numéro</th>
          <th scope="col" class="col-md-3">Nationalité</th>
          <th scope="col" class="col-md-3">Continent</th>
          <th scope="col" class="col-md-3">Action</th>
          </tr>
      </thead>
      <tbody>
          <?php
          foreach($lesNationalites as $nationalite)
          {
              echo "<tr class='d-flex'>";
              echo "<td class='col-md-3'>$nationalite->num</td>";
              echo "<td class='col-md-3'>$nationalite->libNation</td>";
              echo "<td class='col-md-3'>$nationalite->libCont</td>";
              echo "<td class='col-md-3'><a href='index.php?uc=nationalite&action=update&num=$nationalite->num' class='btn btn-primary'><i class='fas fa-pen'></i></a>
                    <a href='#modalSuppr' data-toggle='modal' data-message='Voulez-vous supprimer cette nationalitée ?' data-suppr='index.php?uc=nationalite&action=delete&num=$nationalite->num' class='btn btn-danger'><i class='far fa-trash-alt'></i></a></td>";
              echo "</tr>";
          }
          ?>
      </table>
  </div>
</tbody>
