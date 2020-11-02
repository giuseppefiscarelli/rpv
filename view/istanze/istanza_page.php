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
                        <?php
                    /*

                        $categorie=getCatInc();
                        
                        foreach($categorie as $cat){
                          echo $cat["ctgi_descrizione"];
                        }     
                        for ($nv=1;$nv <=11;++$nv){

                          for ($tipo =1;$tipo<= $i['nv'.$nv]; ++$tipo){

                                    echo "test ".$tipo."<br>";

                          }
                        }*/
                    ?>

      <div class="bd-example-tabs">
        <div class="row">
          <div class="col-4 col-md-3">
            <div class="nav nav-tabs nav-tabs-vertical nav-tabs-vertical-background" id="nav-vertical-tab-bg" role="tablist" aria-orientation="vertical">
                  <?php
                      $tipoVei= getTipoVei();
                      $prog=1;
                      $prog2=1;
                      $prog3=1;
                      $prog4=1;
                      $active=true;
                      foreach($tipoVei as $tv){
                       if($prog<=11&&$i['nv'.$prog]>0){?>
                        <a class="nav-link <?=$active?'active':''?>" id="nav-vertical-tab-bg<?=$prog?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$prog?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$prog?>" aria-selected="true"><?=$tv['tpvc_descrizione']?></a>
                      <?php
                        $active=false;
                       }elseif($prog==12&&$i['r_nv_1']>0){?>
                        <a class="nav-link <?=$active?'active':''?>" id="nav-vertical-tab-bg<?=$prog?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$prog?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$prog?>" aria-selected="true"><?=$tv['tpvc_descrizione']?></a>
                    <?php
                     $active=false;
                       }elseif($prog==13&&$i['r_nv_2']>0){?>
                        <a class="nav-link <?=$active?'active':''?>" id="nav-vertical-tab-bg<?=$prog?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$prog?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$prog?>" aria-selected="true"><?=$tv['tpvc_descrizione']?></a>
                       <?php
                        $active=false;
                       }elseif($prog==14&&$i['r_nv_3']>0){?>
                        <a class="nav-link <?=$active?'active':''?>" id="nav-vertical-tab-bg<?=$prog?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$prog?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$prog?>" aria-selected="true"><?=$tv['tpvc_descrizione']?></a>
                       <?php
                        $active=false;
                       }elseif($prog==15&&$i['nr_1']>0){?>
                        <a class="nav-link <?=$active?'active':''?>" id="nav-vertical-tab-bg<?=$prog?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$prog?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$prog?>" aria-selected="true"><?=$tv['tpvc_descrizione']?></a>
                       <?php
                        $active=false;
                       }elseif($prog==16&&$i['nr_2']>0){?>
                        <a class="nav-link <?=$active?'active':''?>" id="nav-vertical-tab-bg<?=$prog?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$prog?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$prog?>" aria-selected="true"><?=$tv['tpvc_descrizione']?></a>
                       <?php
                        $active=false;
                       }elseif($prog==17&&$i['ng_1']>0){?>
                        <a class="nav-link <?=$active?'active':''?>" id="nav-vertical-tab-bg<?=$prog?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$prog?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$prog?>" aria-selected="true"><?=$tv['tpvc_descrizione']?></a>
                       <?php
                       };
                       ++$prog;
                    }?>
              
            </div>
          </div>
          <div class="col-8 col-md-9">
            <div class="tab-content" id="nav-vertical-tab-bgContent">

                        <?php
                          $active=true;
                          foreach($tipoVei as $tv2){
                            if($prog2<=11&&$i['nv'.$prog2]>0){?>
                               <div class="tab-pane p-3 fade <?=$active?'show active':''?>"   id="nav-vertical-tab-bg<?=$prog2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$prog2?>-tab">
                            <?php
                              $active=false;
                              for ($nv=1;$nv <=$i['nv'.$prog2];++$nv){?>
                                    Veicolo# <?=$nv?> <br>
                              <?php
                              }?></div>
                              <?php
                            }elseif($prog2==12&&$i['r_nv_1']>0){?>
                               <div class="tab-pane p-3 fade <?=$active?'show active':''?>"   id="nav-vertical-tab-bg<?=$prog2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$prog2?>-tab">
                            <?php
                              $active=false;
                              for ($nr=1;$nr <=$i['r_nv_1'];++$nr){?>
                                  Veicolo# <?=$nr?> <br>
                              <?php
                              }?></div>
                              <?php
                            }elseif($prog2==13&&$i['r_nv_2']>0){?>
                               <div class="tab-pane p-3 fade <?=$active?'show active':''?>"   id="nav-vertical-tab-bg<?=$prog2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$prog2?>-tab">
                            <?php
                              $active=false;
                              for ($nr=1;$nr <=$i['r_nv_2'];++$nr){?>
                                Veicolo# <?=$nr?> <br>
                              <?php
                             }?></div>
                             <?php
                            }elseif($prog2==14&&$i['r_nv_3']>0){?>
                               <div class="tab-pane p-3 fade <?=$active?'show active':''?>"   id="nav-vertical-tab-bg<?=$prog2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$prog2?>-tab">
                            <?php
                              $active=false;
                              for ($nr=1;$nr <=$i['r_nv_3'];++$nr){?>
                                Veicolo# <?=$nr?> <br>
                              <?php
                              }?></div>
                              <?php
                            }elseif($prog2==15&&$i['nr_1']>0){?>
                               <div class="tab-pane p-3 fade <?=$active?'show active':''?>"   id="nav-vertical-tab-bg<?=$prog2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$prog2?>-tab">
                            <?php
                              $active=false;
                              for ($nrr=1;$nrr <=$i['nr_1'];++$nrr){?>
                                Veicolo# <?=$nrr?> <br>
                              <?php
                             }?></div>
                             <?php
                            }elseif($prog2==16&&$i['nr_2']>0){?>
                               <div class="tab-pane p-3 fade <?=$active?'show active':''?>"   id="nav-vertical-tab-bg<?=$prog2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$prog2?>-tab">
                            <?php
                              $active=false;
                              for ($nrr=1;$nrr <=$i['nr_2'];++$nrr){?>
                                Veicolo# <?=$nrr?> <br>
                              <?php
                              }?></div>
                              <?php
                            }elseif($prog2==17&&$i['ng_1']>0){?>
                               <div class="tab-pane p-3 fade <?=$active?'show active':''?>"   id="nav-vertical-tab-bg<?=$prog2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$prog2?>-tab">
                            <?php
                              for ($ng=1;$ng <=$i['ng_1'];++$ng){?>
                                Veicolo# <?=$ng?> <br>
                              <?php
                              }?></div>
                              <?php
                            }
                            ++$prog2;
                            ?>
                            
                          <?php
                          }
                            ?>
                             
                            
              
            </div>
          </div>
        </div>
      </div>  
    </div>
    
  </div>
