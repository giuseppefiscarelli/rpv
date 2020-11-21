
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
                    <img src="images/logo-ram-2018.png" alt="Home" style="max-height: -webkit-fill-available;">
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
                      <a href="#">
                        <img src="images/logo.svg" alt="Home" style="max-height: -webkit-fill-available;    padding: 7px;">
                        <div class="it-brand-text">
                          <h2 class="no_toc">Ministero
                           </h2>
                          <h3 class="no_toc  d-md-block"> delle Infrastrutture e dei Trasporti</h3>
                        </div>
                      </a>
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
                    <div class="img-wrapper"><img src="https://via.placeholder.com/480x360/ebebeb/808080/?text=Immagine1" title="img title" alt="imagealt"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                      <div class="category-top">
                        <!-- category heading--><a class="category" href="#">Category</a>
                        <!-- category data--><span class="data">10/12/2018</span>
                      </div>
                      <h5 class="card-title big-heading">Lèéorem ipcing elit…</h5>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      <span class="card-signature">di Federico De Paolis</span>
                      <a class="read-more" href="#">
                        <span class="text">Leggi di più</span>
                        <svg class="icon">
                          <use xlink:href="svg/sprite.svg#it-arrow-right"></use>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="it-single-slide-wrapper">
              <a href="#">
                <div class="img-responsive-wrapper">
                  <div class="img-responsive">
                    <div class="img-wrapper"><img src="https://via.placeholder.com/480x360/ebebeb/808080/?text=Immagine2" title="img title" alt="imagealt"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                      <div class="category-top">
                        <!-- category heading--><a class="category" href="#">Category</a>
                        <!-- category data--><span class="data">10/12/2018</span>
                      </div>
                      <h5 class="card-title big-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit…</h5>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      <span class="card-signature">di Federico De Paolis</span>
                      <a class="read-more" href="#">
                        <span class="text">Leggi di più</span>
                        <svg class="icon">
                          <use xlink:href="svg/sprite.svg#it-arrow-right"></use>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="it-single-slide-wrapper">
              <a href="#">
                <div class="img-responsive-wrapper">
                  <div class="img-responsive">
                    <div class="img-wrapper"><img src="https://via.placeholder.com/480x360/ebebeb/808080/?text=Immagine3" title="img title" alt="imagealt"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                      <div class="category-top">
                        <!-- category heading--><a class="category" href="#">Category</a>
                        <!-- category data--><span class="data">10/12/2018</span>
                      </div>
                      <h5 class="card-title big-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit…</h5>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      <span class="card-signature">di Federico De Paolis</span>
                      <a class="read-more" href="#">
                        <span class="text">Leggi di più</span>
                        <svg class="icon">
                          <use xlink:href="svg/sprite.svg#it-arrow-right"></use>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="it-single-slide-wrapper">
              <a href="#">
                <div class="img-responsive-wrapper">
                  <div class="img-responsive">
                    <div class="img-wrapper"><img src="https://via.placeholder.com/480x360/ebebeb/808080/?text=Immagine4" title="img title" alt="imagealt"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                      <div class="category-top">
                        <!-- category heading--><a class="category" href="#">Category</a>
                        <!-- category data--><span class="data">10/12/2018</span>
                      </div>
                      <h5 class="card-title big-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit…</h5>
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      <span class="card-signature">di Federico De Paolis</span>
                      <a class="read-more" href="#">
                        <span class="text">Leggi di più</span>
                        <svg class="icon">
                          <use xlink:href="svg/sprite.svg#it-arrow-right"></use>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-primary play">Play</button>
        <button type="button" class="btn btn-primary stop">stop</button>

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