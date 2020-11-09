
<?php

session_start();
require_once 'functions.php';




require_once 'view/template/top.php';

?>
<style>
    #input-file {
    display: none;
    }

</style>
  <body>
        <div class="it-header-slim-wrapper">
            <div class="container">
              <div class="row">
                  <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="d-none d-lg-block navbar-brand" href="#">Ente appartenenza/Owner</a>
                        <div class="nav-mobile">
                          <nav>
                              <a class="it-opener d-lg-none" data-toggle="collapse" href="#menu1" role="button" aria-expanded="false" aria-controls="menu1">
                                <span>Ente appartenenza/Owner</span>
                                <svg class="icon">
                                    <use xlink:href="svg/sprite.svg#it-expand"></use>
                                </svg>
                              </a>
                              <div class="link-list-wrapper collapse" id="menu1">
                                <ul class="link-list">
                                    <li><a class="list-item" href="#">Link 1</a></li>
                                    <li><a class="list-item active" href="#">Link 2 Active</a></li>
                                </ul>
                              </div>
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
        <div class="it-header-navbar-wrapper">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <!--start nav-->
                <nav class="navbar navbar-expand-lg has-megamenu">
                  <button class="custom-navbar-toggler" type="button" aria-controls="nav1" aria-expanded="false" aria-label="Toggle navigation" data-target="#nav1">
                    <svg class="icon">
                      <use xlink:href="svg/sprite.svg#it-burger"></use>
                    </svg>
                  </button>
                  <div class="navbar-collapsable" id="nav1" style="display: none;">
                    <div class="overlay" style="display: none;"></div>
                    <div class="close-div sr-only">
                      <button class="btn close-menu" type="button"><span class="it-close"></span>close</button>
                    </div>
                    <div class="menu-wrapper">
                      <ul class="navbar-nav">
                        <li class="nav-item active"><a class="nav-link active" href="#"><span>link 1 active </span><span class="sr-only">current</span></a></li>
                        <li class="nav-item"><a class="nav-link disabled" href="#"><span>link 2 </span></a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><span>link 3 </span></a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><span>link 4</span></a></li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                            <span>Dropdown item</span>
                            <svg class="icon icon-xs">
                              <use xlink:href="svg/sprite.svg#it-expand"></use>
                            </svg>
                          </a>
                          <div class="dropdown-menu">
                            <div class="link-list-wrapper">
                              <ul class="link-list">
                                <li>
                                  <h3 class="no_toc" id="heading-es-1">Heading</h3>
                                </li>
                                <li><a class="list-item" href="#"><span>Link list 1</span></a></li>
                                <li><a class="list-item" href="#"><span>Link list 2</span></a></li>
                                <li><a class="list-item" href="#"><span>Link list 3</span></a></li>
                                <li><span class="divider"></span></li>
                                <li><a class="list-item" href="#"><span>Link list 4</span></a></li>
                              </ul>
                            </div>
                          </div>
                        </li>
                        <li class="nav-item dropdown megamenu">
                          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                            <span>Megamenu Label</span>
                            <svg class="icon icon-xs">
                              <use xlink:href="svg/sprite.svg#it-expand"></use>
                            </svg>
                          </a>
                          <div class="dropdown-menu">
                            <div class="row">
                              <div class="col-12 col-lg-4">
                                <div class="link-list-wrapper">
                                  <ul class="link-list">
                                    <li>
                                      <h3 class="no_toc">Heading 1</h3>
                                    </li>
                                    <li><a class="list-item" href="#"><span>Link list 1 </span></a></li>
                                    <li><a class="list-item" href="#"><span>Link list 2 </span></a></li>
                                    <li><a class="list-item" href="#"><span>Link list 3 </span></a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-12 col-lg-4">
                                <div class="link-list-wrapper">
                                  <ul class="link-list">
                                    <li>
                                      <h3 class="no_toc">Heading 2</h3>
                                    </li>
                                    <li><a class="list-item" href="#"><span>Link list 1 </span></a></li>
                                    <li><a class="list-item" href="#"><span>Link list 2 </span></a></li>
                                    <li><a class="list-item" href="#"><span>Link list 3 </span></a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-12 col-lg-4">
                                <div class="link-list-wrapper">
                                  <ul class="link-list">
                                    <li>
                                      <h3 class="no_toc">Heading 3</h3>
                                    </li>
                                    <li><a class="list-item" href="#"><span>Link list 1 </span></a></li>
                                    <li><a class="list-item" href="#"><span>Link list 2 </span></a></li>
                                    <li><a class="list-item" href="#"><span>Link list 3</span></a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      
      <div class="container my-4">
  
      <div id="accordionDiv1" class="collapse-div collapse-background-active" role="tablist">
  <div class="collapse-header" id="headingA1">
    <button data-toggle="collapse" data-target="#accordion1" aria-expanded="false" aria-controls="accordion1">
      Accordion Group Item #1
    </button>
  </div>
  <div id="accordion1" class="collapse " role="tabpanel" aria-labelledby="headingA1" data-parent="#accordionDiv1">
    <div class="collapse-body">
      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. 
    </div>
  </div>
  <div class="collapse-header" id="headingA2">
    <button data-toggle="collapse" data-target="#accordion2" aria-expanded="false" aria-controls="accordion2">
      Accordion Group Item #2 
    </button>
    <small>test</small>
  </div>
  <div id="accordion2" class="collapse" role="tabpanel" aria-labelledby="headingA2" data-parent="#accordionDiv1">
    <div class="collapse-body">
      Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
    </div>
  </div>
  <div class="collapse-header" id="headingA3">
    <button data-toggle="collapse" data-target="#accordion3" aria-expanded="false" aria-controls="accordion3">
      Accordion Group Item #3
    </button>
  </div>
  <div id="accordion3" class="collapse" role="tabpanel" aria-labelledby="headingA3" data-parent="#accordionDiv1">
    <div class="collapse-body">
      Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
    </div>
  </div>
</div>



       
        



      </div>
      
      <?php
      require_once 'view/template/footer.php';
      ?>
   <script type="text/javascript">
  function changeText() {
    var y = document.getElementById("input-file").value;
    document.getElementById("selectedFileName").innerHTML = y;
  }
</script>
  </body>
</html>