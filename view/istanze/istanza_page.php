<h3 class="card-title">Istanza n° <?=$i['id']?></h3>



  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-tab1-tab" data-toggle="tab" href="#nav-tab1" role="tab" aria-controls="nav-tab1" aria-selected="true">Dati Richiedente / Dati Impresa</a>
      <a class="nav-item nav-link" id="nav-tab2-tab" data-toggle="tab" href="#nav-tab2" role="tab" aria-controls="nav-tab2" aria-selected="false">Tab 2</a>
      <a class="nav-item nav-link" id="nav-tab3-tab" data-toggle="tab" href="#nav-tab3" role="tab" aria-controls="nav-tab3" aria-selected="false">Tab 3</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane p-4 fade show active" id="nav-tab1" role="tabpanel" aria-labelledby="nav-tab1-tab">
      <div class="row">
        <div class="col-12 col-lg-4">
          <!--start card-->
          <div class="card-wrapper">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Dati richiedente</h5>
                <table class="table table-sm">
        
                  <tbody>
                      <tr>
                      <th scope="row">Cognome</th>
                      <td><?=$i['cognome']?></td>
                      
                      </tr>
                      <tr>
                      <th scope="row">Nome</th>
                      <td><?=$i['nome']?></td>
                      
                      </tr>
                      <tr>
                      <th scope="row">Data di Nascita</th>
                      <td><?=date("d/m/Y",strtotime($i['data_nascita']))?></td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Luogo di Nascita</th>
                      <td><?=$i['luogo_nascita']?> (<?=$i['prov_nascita']?>)</td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Indirizzo Residenza</th>
                      <td><?=$i['indirizzo_residenza']?>, <?=$i['civico_residenza']?></td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Luogo Residenza</th>
                      <td><?=$i['cap_residenza']?> - <?=$i['comune_residenza']?> (<?=$i['prov_residenza']?>)</td>
                  
                      </tr>
                      <tr>
                      <th scope="row">email</th>
                      <td><?=$i['email_richiedente']?></td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Tipo</th>
                      <td><?=$i['tipo_dichiarante']?></td>
                  
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--end card-->
        </div>
        <div class="col-12 col-lg-8">
          <!--start card-->
          <div class="card-wrapper">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Dati Impresa</h5>
                <div class="row">
                  <div class="col-lg-6 col-12">
                      <table class="table table-sm">
              
                          <tbody>
                              <tr>
                              <th scope="row">Ragione Sociale</th>
                              <td><?=$i['cognome']?></td>
                              
                              </tr>
                              <tr>
                              <th scope="row">Partita IVA</th>
                              <td><?=$i['piva']?></td>
                          
                              </tr>
                              <tr>
                              <th scope="row">Codice Fiscale</th>
                              <td><?=$i['cf']?></td>
                          
                              </tr>
                              
                              
                              
                              <tr>
                              <th scope="row">Indirizzo Impresa</th>
                              <td><?=$i['indirizzo_impr']?>, <?=$i['civico_impr']?></td>
                          
                              </tr>
                              <tr>
                              <th scope="row">Comune Impresa</th>
                              <td><?=$i['cap_impr']?> - <?=$i['comune_impr']?> (<?=$i['prov_impr']?>)</td>
                          
                              </tr>
                              
                              <tr>
                              <th scope="row">Email Impresa</th>
                              <td><?=$i['email_impr']?></td>
                          
                              </tr>
                              <tr>
                              <th scope="row">Pec Impresa</th>
                              <td><?=$i['pec_impr']?></td>
                          
                              </tr>
                              <tr>
                              <th scope="row">Telefono Impresa</th>
                              <td><?=$i['pref_tel_impr']?> / <?=$i['num_tel_impr']?></td>
                          
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="col-lg-6 col-12"> 
                      <table class="table table-sm">
                          <tbody>
                              <tr>
                              <th scope="row">Tipo Impresa</th>
                              <td><?=$i['tipo_impresa']?></td>
                              </tr>
                              <tr>
                              <th scope="row">Codice Albo</th>
                              <td><?=$i['codice_albo']?></td>
                              </tr>
                              <tr>
                              <th scope="row">Codice Ren</th>
                              <td><?=$i['codice_ren']?></td>
                              </tr>
                              <tr>
                              <th scope="row">CCIAA</th>
                              <td>Provincia <?=$i['cciaa_prov']?><br>Codice <?=$i['cciaa_codice']?><br>Data <?=date("d/m/Y",strtotime($i['cciaa_data']))?></td>
                              </tr>
                              <tr>
                              <th scope="row">Codice Ateca</th>
                              <td><?=$i['codice_ateco']?></td>
                              </tr>
                              <tr>
                              <th scope="row">Banca</th>
                              <td>Istituto <?=$i['banca_istituto']?><br>
                                  Agenzia <?=$i['banca_agenzia']?><br>
                                  IBAN <?=$i['iban_it']?> <?=$i['iban_num_chk']?> <?=$i['iban_cin']?> <?=$i['iban_abi']?> <?=$i['iban_cab']?> <?=$i['iban_cc']?></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end card-->
        </div>
      </div>
    
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab2" role="tabpanel" aria-labelledby="nav-tab2-tab">
                    

        
        <div class="row">
          <div class="col-12">
            <div id="collapseDiv1-sc1" class="collapse-div collapse-background-active " role="tablist">
              <?php
              $cat=getCatInc();
              $accord=1; 
              $catA=$i['nv1']||$i['nv2']||$i['nv3']||$i['nv4']||$i['nv5']||$i['nv6']||$i['nv7']||$i['nv8']||$i['nv9']||$i['nv10']||$i['nv11'];
              $catB=$i['r_nv_1']||$i['r_nv_2']||$i['r_nv_3'];
              $catC=$i['nr_1']||$i['nr_2'];
              $catD=$i['ng_1'];
              foreach($cat as $ca){
                  if($ca['ctgi_categoria']=='A'&&$catA){
                      require "tabcat.php";
                  }elseif($ca['ctgi_categoria']=='B'&&$catB){
                    require "tabcat.php";  
                  }elseif($ca['ctgi_categoria']=='C'&&$catC){
                    require "tabcat.php";    
                  }elseif($ca['ctgi_categoria']=='D'&&$catD){
                      require "tabcat.php";   
                  }
                }?>  

            </div>
          </div>
        </div>
                                              
    </div>
    
  </div>
  <!-- Modal -->
                                              <div class="modal fade" tabindex="-1" role="dialog" id="docModal">
                                                <div class="modal-dialog modal-lg" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title">Inserimento Documenti Veicolo
                                                      </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                     <form method="post" id="form_allegato" enctype="multipart/form-data">
                                                     <input type="hidden" name="id_RAM" value="<?=$i['id_RAM']?>">
                                                      <input type="hidden" name="doc_idvei" id="doc_idvei" value="">
                                                        <div class="bootstrap-select-wrapper">
                                                          <label>Tipo Documento</label>
                                                          <select id="tipo_documento" name="tipo_documento"title="Scegli un tipo di documento">
                                                           <?php
                                                                  $tipDoc = getTipoDocumento();
                                                                  foreach($tipDoc as $td){
                                                                   // $campo=getCampoDoc($td['tdoc_codice']);?>
                                                                      <option value="<?=$td['tdoc_codice']?>"><?=$td['tdoc_descrizione']?></option>
                                                                    <br>
                                                                <?php
                                                                }?>
                                                       </select>
                                                        </div>
                                                        <div id="campi_allegati" style="margin-top:50px;">
                                                        </div>
                                                      </form> 

                                                    </div>
                                                    <div class="modal-footer">
                                                      <button class="btn btn-primary btn-sm" data-dismiss="modal" type="button">Close</button>
                                                      <button class="btn btn-primary btn-sm" form="form_allegato"type="submit">Salva Allegato Veicolo</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div> 


                                              <div class="modal fade" tabindex="-1" role="dialog" id="infoModal">
                                                <div class="modal-dialog modal-lg" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title">Info dati Veicolo
                                                      </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div>
                                                    <div class="container">
                                                      <form method="post" id="form_infovei">
                                                      <input type="hidden" id="info_idvei" value="" >
                                                        <div class="form-group">
                                                            <input type="text" required placeholder="Inserire targa" oninput="this.value = this.value.toUpperCase();"value="" class="form-control" id="targa" name="targa" required>
                                                        
                                                          <label for="username" >Targa</label>
                                                          <div class="invalid-feedback">Per favore scegli un username.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" required placeholder="Inserire marca" value="" oninput="this.value = this.value.toUpperCase();"class="form-control" id="marca" name="marca" required>
                                                        
                                                          <label for="username" >Marca</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" required placeholder="Inserire modello" oninput="this.value = this.value.toUpperCase();"value="" class="form-control" id="modello" name="modello" required>
                                                        
                                                          <label for="username" >Modello</label>
                                                        </div>
                                                        <label for="costo" class="input-number-label" style="margin-top: -25px;">Costo</label>
                                                        <span class="input-number input-number-currency">
                                                          <input type="number" id="costo" name="costo" value="0.00" min="1.00" required>
                                                          
                                                        </span>
                                                      
                                                        <div class="bootstrap-select-wrapper" style="margin-top:50px;">
                                                            <label for="roletype" >Tipo Acquisizione</label>
                                                            <select class="form-control" id="tipo_acquisizione" name="tipo_acquisizione" required >
                                                                <option >Scegli una opzione</option>
                                                                <option value="01">Acquisto</option>
                                                                <option value="02">Leasing</option>
                                                                
                                                            </select>
                                                          
                                                        </div>
                                                      </form>
                                                    </div>
                                                      
                                                    
                                                     
  
                                                       
                                                        
                                                      
                                            
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
                                                      <button class="btn btn-primary btn-sm" form="form_infovei"type="submit">Salva Dati Veicolo</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div> 
