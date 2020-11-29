
<?php

session_start();
require_once 'functions.php';

if(isUserLoggedin()){
    
         header('Location: home.php'); 
     
    exit;
}


$bytes= random_bytes(32);
$token = bin2hex($bytes);
$_SESSION['csrf']= $token;



require_once 'view/template/top.php';

?>

  <body>
        <div class="it-header-slim-wrapper">
            <div class="container">
              <div class="row">
                  <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                   
                        <a class="d-none d-lg-block navbar-brand" href="#"></a>
                        <div class="nav-mobile">
                          <nav>
                              <a class="it-opener d-lg-none" data-toggle="collapse" href="#menu1" role="button" aria-expanded="false" aria-controls="menu1">
                                <span>Ente appartenenza/Owner</span>
                                <svg class="icon">
                                    <use xlink:href="svg/sprite.svg#it-expand"></use>
                                </svg>
                              </a>
                              
                          </nav>
                        </div>
                        <div class="it-header-slim-right-zone">
                          <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                            <span>Ita</span>
                            <svg class="icon d-none d-lg-block">
                                <use xlink:href="svg/sprite.svg#it-expand"></use>
                            </svg>
                            </a>
                            <div class="dropdown-menu">
                              <div class="row">
                                  <div class="col-12">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list">
                                        <li><a class="list-item" href="#"><span>ITA</span></a></li>
                                        <li><a class="list-item" href="#"><span>ENG</span></a></li>
                                        </ul>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="it-access-top-wrapper">
                              <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalLong">Accedi</a>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
           
  
                  <!-- Modal -->
 
                  <div class="modal fade" tabindex="-1" role="dialog" id="exampleModalLong">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Accedi ad area riservata</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <svg class="icon">
                                <use xlink:href="svg/sprite.svg#it-close"></use>
                            </svg>
                          </button>
                        </div>
                        <form style="margin-top:40px" action="verify-login.php" method="post">
                        <div class="modal-body">
                       
                              <input type="hidden" name="_csrf" value="<?=$token?>">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email" class="form-control" id="email" name="email"aria-describedby="emailHelp" placeholder="Inserisci email">
                                  <small id="emailHelp" class="form-text text-muted">PEC utilizzata per la richiesta.</small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                              
                                
                          
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
                          <button class="btn btn-primary btn-sm" type="submit">Accedi</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
        </div>
        <div class="it-header-center-wrapper ">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="it-header-center-content-wrapper" >
                    <div class="it-brand-wrapper" style="min-width: -webkit-fill-available;">
                      <div class="row">
                        <a href="#">
                          <img src="images/logo.svg" alt="Home" style="max-height: -webkit-fill-available;    padding: 7px;">
                          <div class="it-brand-text">
                            <h2 class="no_toc">Ministero
                            </h2>
                            <h3 class="no_toc  d-md-block"> delle Infrastrutture e dei Trasporti</h3>
                          </div>
                          <div style="padding: 20px;">
                           <img src="images/logo-ram-2018.png" alt="Home" style="max-height: -webkit-fill-available;">
                          </div>
                        </a>
                      
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
        </div>
        <?php

//var_dump($_SESSION);
if(!empty($_SESSION['message'])){
    
    $message = $_SESSION['message'];
    $alertType ='danger';
    
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  } 
      ?>
      <div class="container my-4">
        <div class="it-carousel-wrapper it-carousel-landscape-abstract">
          <div class="it-carousel-all owl-carousel" >
            <div class="it-single-slide-wrapper" >
              <a href="#">
                <div class="img-responsive-wrapper">
                  <div class="img-responsive">
                    <div class="img-wrapper"><img src="images/img1.jpg" title="img title" alt="imagealt"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                      <div class="category-top" style="display:none;">
                        <!-- category heading--><a class="category" href="#">Category</a>
                        <!-- category data--><span class="data">10/12/2018</span>
                      </div>
                      <h5 class="card-title big-heading">Mit. Pubblicato il decreto sui costi indicativi di riferimento per l’attività di Autotrasporto</h5>
                      <p class="card-text"><em>27 novembre 2020</em> - E’ stato pubblicato oggi sul sito del Ministero delle Infrastrutture e dei Trasporti l’atteso decreto sui costi indicativi di riferimento dell’attività di autotrasporto merci.&nbsp;</p>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="it-single-slide-wrapper">
              <a href="#">
                <div class="img-responsive-wrapper">
                  <div class="img-responsive">
                    <div class="img-wrapper"><img src="https://www.mit.gov.it/sites/default/files/media/notizia/2020-11/foto%20mit_0.jpg" title="img title" alt="imagealt"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                     
                      <h5 class="card-title big-heading">Mit: De Micheli ad Anas e Rfi, applicare Art. 2 Semplificazioni</h5>
                      <p class="card-text"><em>25 novembre 2020</em> - Un invito ad adottare tutti gli atti necessari ad esercitare, fin da subito, i poteri derogatori previsti dall'articolo 2 del decreto Semplificazioni (DL 76/2020). Questo il contenuto della lettera inviata oggi dalla ministra delle Infrastrutture e dei Trasporti Paola de Micheli alle due principali stazioni appaltanti del Gruppo FS, Anas e Rete Ferroviaria Italiana.</p>
                    
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="it-single-slide-wrapper">
              <a href="#">
                <div class="img-responsive-wrapper">
                  <div class="img-responsive">
                    <div class="img-wrapper"><img src="https://www.mit.gov.it/sites/default/files/media/notizia/2020-11/17860a58-c0dd-4d2c-b492-2b5d1f518427.jpg" title="img title" alt="imagealt"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                      
                      <h5 class="card-title big-heading">Mit, pubblicato il nuovo contatore: nei primi 14 mesi cantieri per oltre di 17 miliardi e investimenti per più di 11 miliardi</h5>
                      <p class="card-text"><em>23 novembre 2020 </em>- Ammontano a più di 17 miliardi le opere infrastrutturali - tra cantieri conclusi, appaltati e avviati - messe a terra dal Ministero delle Infrastrutture e dei Trasporti da settembre 2019 ad oggi.</p>
                     
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="it-single-slide-wrapper">
              <a href="#">
                <div class="img-responsive-wrapper">
                  <div class="img-responsive">
                    <div class="img-wrapper"><img src="https://www.mit.gov.it/sites/default/files/media/notizia/2020-11/cortina%202021.jpg" title="img title" alt="imagealt"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                      
                      <h5 class="card-title big-heading">Cortina: avanzano i lavori Anas del piano di potenziamento della viabilità per i Mondiali di sci 2021</h5>
                      <p class="card-text"><em>20 novembre 2020 </em>- Proseguono senza sosta le attività di Anas (Gruppo FS Italiane) previste nell’ambito del Piano straordinario di potenziamento della viabilità per i Mondiali di Sci di Cortina 2021</p>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        

      </div>
      
     
   <!-- JS -->
<script src="assets/js/bootstrap-italia.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.js"></script>

<script type="text/javascript">
        $( document ).ready(function() {
            $('#message').delay(3000).fadeOut();
        });
       
</script> 
  </body>
  <script>
  
  
$(document).ready(function() {

  $(".owl-carousel").owlCarousel();
  var owl = $('.owl-carousel');

owl.trigger('play.owl.autoplay',[5000])


});
  </script>
</html>