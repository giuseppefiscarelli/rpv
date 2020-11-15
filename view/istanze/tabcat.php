<div class="collapse-header " id="heading1-sc<?=$ca['ctgi_codice']?>">
                    <button data-toggle="collapse" data-target="#collapse1-sc<?=$ca['ctgi_codice']?>" aria-expanded="<?=$ca['ctgi_codice']==1?'true':'false'?>" aria-controls="collapse1-sc<?=$ca['ctgi_codice']?>">
                       Categoria <?=$ca['ctgi_categoria']?><br> <small><?=$ca['ctgi_descrizione']?></small>
                    </button>
                  </div>
                  <div id="collapse1-sc<?=$ca['ctgi_codice']?>" class="collapse" role="tabpanel" aria-labelledby="heading1-sc<?=$ca['ctgi_codice']?>" data-parent="#collapseDiv1-sc1">
                    <div class="collapse-body">

                        <div class="bd-example-tabs">
                          <div class="row">
                            <?php
                              $tipVei =getTipoVei($ca['ctgi_codice']);
                              //var_dump($tipVei);    
                              $countTip =1;
                              $countTip2 =1;

                              ?>
                            <div class="col-4 col-md-3">
                              <div class="nav nav-tabs nav-tabs-vertical nav-tabs-vertical-background" id="nav-vertical-tab-bg" role="tablist" aria-orientation="vertical">
                                <?php
                                  foreach($tipVei as $tve){
                                    $countCatVei=countCatVei($tve['tpvc_codice'],$i['id_RAM']);
                                    if($countCatVei==!0){
                                  
                                ?>
                                <a class="nav-link <?=$countTip ==1?'active':''?>" id="nav-vertical-tab-bg<?=$tve['codice_categoria_incentivo'].'-'.$countTip?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$tve['codice_categoria_incentivo'].'-'.$countTip?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$tve['codice_categoria_incentivo'].'-'.$countTip?>" aria-selected="true">
                                    <table style="width: -webkit-fill-available;">
                                        <tr>
                                            <td><?=$tve['tpvc_descrizione']?></td>
                                            <td style="width: 30%;text-align: right"><span><?=$countCatVei?> <?=$countCatVei>1?'veicoli':'veicolo'?></span></td>
                                        </tr>
                                    </table>
                                </a>

                                <?php
                                ++$countTip;
                                  }
                                }?>
                               

                              </div>
                            </div>

                            <div class="col-8 col-md-9">
                              <div class="tab-content" id="nav-vertical-tab-bgContent">
                                <?php
                                  foreach($tipVei as $tvei){
                                    $countCatVei2=countCatVei($tvei['tpvc_codice'],$i['id_RAM']);
                                    if($countCatVei2==!0){
                                ?>

                                <div class="tab-pane p-3 fade <?=$countTip2 ==1?'show active':''?>" id="nav-vertical-tab-bg<?=$tvei['codice_categoria_incentivo'].'-'.$countTip2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$tvei['codice_categoria_incentivo'].'-'.$countTip2?>-tab">

                                      <?php
                                      require 'tabveicolo2.php';
                                      ?>        
                                           
                                            
                                           

                                </div>
                                <?php
                                ++$countTip2;
                                            }
                                }?>
                               
                                                         


                                
                              </div>
                            </div>

                          </div>
                        </div>

                                              
                    </div>
                  </div>