
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
      <form method="post" action="" enctype="multipart/form-data">
  <input type="file" name="upload1" id="upload1" class="upload" multiple="multiple" />
  <label for="upload1">
    <svg class="icon icon-sm" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-upload"></use></svg>
    <span>Upload</span>
  </label>
  <ul class="upload-file-list">
    <li class="upload-file success">
      <svg class="icon icon-sm" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-file"></use></svg>
      <p>
        <span class="sr-only">File caricato:</span>
        nome-file-01.pdf <span class="upload-file-weight">68 MB</span>
      </p>
      <button disabled>
        <span class="sr-only">Caricamento ultimato</span>
        <svg class="icon" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-check"></use></svg>
      </button>
    </li>
    <li class="upload-file success">
      <svg class="icon icon-sm" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-file"></use></svg>
      <p>
        <span class="sr-only">File caricato:</span>
        nome-file-02-nome-file-lungo-per-ellissi.doc <span class="upload-file-weight">68 MB</span>
      </p>
      <button disabled>
        <span class="sr-only">Caricamento ultimato</span>
        <svg class="icon" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-check"></use></svg>
      </button>
    </li>
    <li class="upload-file uploading">
      <svg class="icon icon-sm" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-file"></use></svg>
      <p>
        <span class="sr-only">Caricamento file:</span>
        nome-file-03.png <span class="upload-file-weight"></span>
      </p>
      <button>
        <span class="sr-only">Annulla caricamento file nome-file-03.png</span>
        <svg class="icon" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-close"></use></svg>
      </button>
      <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </li>
    <li class="upload-file error">
      <svg class="icon icon-sm" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-file"></use></svg>
      <p>
        <span class="sr-only">Errore caricamento file:</span>
        nome-file-04.jpg <span class="upload-file-weight"></span>
      </p>
      <button>
        <span class="sr-only">Elimina file caricato nome-file-04.jpg</span>
        <svg class="icon" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-close"></use></svg>
      </button>
    </li>
  </ul>
</form>

<button type="button" class="btn btn-primary" onclick="prova()"> alert</button>
<form method="post" id="form_allegato" enctype="multipart/form-data">
                                                   
                                                        <div class="bootstrap-select-wrapper">
                                                            <label>Tipo Documento</label>
                                                           <select >
  <option data-content="test tipo documento  <span class='badge badge-success'> <i class='fa fa-check-circle' aria-hidden='true'></i></span>"></option>
</select>

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
  
      $('#form_allegato').submit(function(event){
            $('#docModal').modal('toggle');
            var htmltext='<div class="progress"><div class="progress-bar" role="progressbar" id="progress-bar"style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div></div>'
      
        swal({ 
                html:true,
                title: "Upload in Corso",
                text:htmltext,
                type: "info",
                showLoaderOnConfirm: true,
                showCancelButton: false,
                showConfirmButton: false
        });
           
            event.preventDefault();
            tipo=$('#tipo_documento option:selected').text()
            console.log(tipo)
            formData = new FormData(this);
            
                  $.ajax({
                              xhr: function() {
                              var xhr = new window.XMLHttpRequest();
                              xhr.upload.addEventListener("progress", function(evt) {
                                  if (evt.lengthComputable) {
                                      var percentComplete = ((evt.loaded / evt.total) * 100);
                                      $("#progress-bar").width(percentComplete + '%');
                                     
                                      //$(".progress-bar").html(percentComplete+'%');
                                  }
                              }, false);
                              return xhr;
                          },
                        url: "controller/updateIstanze.php?action=newAllegato",
                        type:"POST",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){
                                $("#progress-bar").width('0%');
                                $('#uploadStatus').html('<img src="images/loading.gif"/>');
                            },
                            error:function(){
                              
                                swal("Operazione Non Completata!", "Allegato non caricato correttamente.", "warning");
                             
                            },
                        success: function(data){
                              
                              
                                swal("Operazione Completata!", "Allegato caricato correttamente.", "success");
                              
                             
                              data_ins=convData(data.data_agg)
                              id_table= formData.get('doc_idvei')
                            
                              button='<a type="button" href="download.php?id='+data.id+'" download title="Scarica Documento"class="btn btn-primary "><i class="fa fa-download" aria-hidden="true"></i></a>'
                              buttonb='<button type="button" onclick="window.open(\'allegato.php?id='+data.id+'\', \'_blank\')"title="Vedi Documento"class="btn btn-danger "><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                              row='<tr><td>'+tipo+'</td><td>'+data_ins+'</td><td>'+data.note+'</td><td>'+button+''+buttonb+'</td></tr>'
                              $('#tab_doc_'+id_table+' > tbody:last-child').append(row);
                             
                        }
                  })

      })
</script>
  </body>
</html>