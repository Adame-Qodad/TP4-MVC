<body>

<footer class="container">

<div id="modalSuppr" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <a href="" type="button" class="btn btn-primary" id="btnSuppr">Supprimer</a>
      </div>
    </div>
  </div>
</div>

  <p>Butsch&copy; </p>

</footer>

<script src="https://kit.fontawesome.com/22107901ed.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script type="text/javascript">

$("a[data-suppr]").click(function()
{
  var lien = $(this).attr("data-suppr");//On récupère le lien du btn poubelle
  var message = $(this).attr("data-message");//On récupère le msg à afficher
  $("#btnSuppr").attr("href",lien);//On écrit le lien sur le btn supprimer
  $(".modal-body").text(message);//On écrit le msg  


});

</script>
</body>
<?php ob_end_flush(); ?>