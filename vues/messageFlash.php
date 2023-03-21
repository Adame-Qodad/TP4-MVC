<?php 
      if(!empty($_SESSION['message']))

      {
        $mesMessages=$_SESSION['message'];

        foreach($mesMessages as $key=>$mesMessages)
        {
          echo '
                    
            <div class="container pt-5">
                  <div class="alert alert-'.$key.' alert-dismissible fade show" role="alert">'. $mesMessages .'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button> 
                  </div>
          </div>
                ';
        }

        $_SESSION['message']=[];
      }

    ?>