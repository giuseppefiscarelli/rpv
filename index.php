
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
        <h1>Lorem Ipsum</h1>
        <p>Ab illo tempore, ab est sed immemorabili.<br/>
          Ullamco laboris nisi ut aliquid ex ea commodi consequat.<br/>
          Quis aute iure reprehenderit in voluptate velit esse.<br/>
          Petierunt uti sibi concilium totius Galliae in diem certam indicere.</p>
        <p>Pellentesque habitant morbi tristique senectus et netus.</p>
  
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-tab1-tab" data-toggle="tab" href="#nav-tab1" role="tab" aria-controls="nav-tab1" aria-selected="true">Tab 1</a>
          <a class="nav-item nav-link" id="nav-tab2-tab" data-toggle="tab" href="#nav-tab2" role="tab" aria-controls="nav-tab2" aria-selected="false">Tab 2</a>
          <a class="nav-item nav-link" id="nav-tab3-tab" data-toggle="tab" href="#nav-tab3" role="tab" aria-controls="nav-tab3" aria-selected="false">Tab 3</a>
        </div>
      
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane p-4 fade show active" id="nav-tab1" role="tabpanel" aria-labelledby="nav-tab1-tab">Contenuto 1</div>
        <div class="tab-pane p-4 fade" id="nav-tab2" role="tabpanel" aria-labelledby="nav-tab2-tab">Contenuto 2</div>
        <div class="tab-pane p-4 fade" id="nav-tab3" role="tabpanel" aria-labelledby="nav-tab3-tab">Contenuto 3</div>
      </div>
      
        <div class="row">
          <div class="col-12 col-lg-4">
            <!--start card-->
            <div class="card-wrapper">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor…</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
        </div>
      
       
        


        <div class="bd-example-tabs">
          <div class="row">
            <div class="col-4 col-md-3">
              <div class="nav nav-tabs nav-tabs-vertical nav-tabs-vertical-background" id="nav-vertical-tab-bg" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="nav-vertical-tab-bg1-tab" data-toggle="tab" href="#nav-vertical-tab-bg1" role="tab" aria-controls="nav-vertical-tab-bg1" aria-selected="true">Tab 1</a>
                <a class="nav-link" id="nav-vertical-tab-bg2-tab" data-toggle="tab" href="#nav-vertical-tab-bg2" role="tab" aria-controls="nav-vertical-tab-bg2" aria-selected="false">Tab 2</a>
                <a class="nav-link" id="nav-vertical-tab-bg3-tab" data-toggle="tab" href="#nav-vertical-tab-bg3" role="tab" aria-controls="nav-vertical-tab-bg3" aria-selected="false">Tab 3</a>
                <a class="nav-link">...</a>
              </div>
            </div>
            <div class="col-8 col-md-9">
              <div class="tab-content" id="nav-vertical-tab-bgContent">
                <div class="tab-pane p-3 fade show active" id="nav-vertical-tab-bg1" role="tabpanel" aria-labelledby="nav-vertical-tab-bg1-tab">Contenuto 1</div>
                <div class="tab-pane p-3 fade" id="nav-vertical-tab-bg2" role="tabpanel" aria-labelledby="nav-vertical-tab-bg2-tab">Contenuto 2</div>
                <div class="tab-pane p-3 fade" id="nav-vertical-tab-bg3" role="tabpanel" aria-labelledby="nav-vertical-tab-bg3-tab">Contenuto 3</div>
              </div>
            </div>
          </div>
        </div>

      </div>
      
      <?php
      require_once 'view/template/footer.php';
      ?>
   
  </body>
</html>