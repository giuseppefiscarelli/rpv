<table class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th scope="col">#</th>
                                                 
                                                  <th scope="col">Targa</th>
                                                  <th scope="col">Marca</th>
                                                  <th scope="col">Modello</th>
                                                  <th scope="col">Tipo Acquisizione</th>
                                                  <th scope="col">Importo</th>

                                                  <th scope="col"></th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                             <?php
                                              $veicolo = getRowVeicolo($tvei["tpvc_codice"],$i['id_RAM']);
                                              //var_dump($veicolo);
                                              foreach($veicolo as $rv ){
                                             ?>
                                                <tr id="vei_row_<?=$rv['id']?>">
                                                  <th scope="row"><?=$rv['progressivo']?></th>
                                                  <?php
                                                   if(!$rv['targa']&&!$rv['marca']&&!$rv['modello']&&!$rv['tipo_acquisizione']&&!$rv['costo']){?>
                                                  <td colspan="5">Dati veicolo #<?=$rv['progressivo']?> non presenti</td>    
                                                   <?php
                                                  }else{?>
                                                  <td><?=$rv['targa']?></td>
                                                  <td><?=$rv['marca']?></td>
                                                  <td><?=$rv['modello']?></td>
                                                  <td><?=$rv['tipo_acquisizione']?></td>
                                                  <td><?=$rv['costo']?></td>
                                                  <?php
                                                  }?>    
                                                  <td><button type="button" class="btn btn-primary btn-sm" style="width:-webkit-fill-available;"onclick="docmodal(<?=$rv['id']?>);" ><i class="fa fa-upload" aria-hidden="true"></i> Carica documenti</button>
                                                      <button type="button" class="btn btn-success btn-sm" style="width:-webkit-fill-available;margin-top: 10px;"onclick="infomodal(<?=$rv['id']?>);" ><i class="fa fa-info" aria-hidden="true"></i> Info veicolo</button>

                                                  </td>
                                                  
                                                </tr>
                                              <?php
                                              }
                                              ?>
                                              </tbody>
                                            </table>