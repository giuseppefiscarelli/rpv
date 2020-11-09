<div id="accordionDivVeicoli" class="collapse-div collapse-background-active" role="tablist">

<?php
                                              $veicolo = getRowVeicolo($tvei["tpvc_codice"],$i['id_RAM']);
                                              //var_dump($veicolo);
                                              foreach($veicolo as $rv ){
                                             ?>




                                    
                                    <div class="collapse-header" id="headingA<?=$rv['progressivo']?>">
                                        <button data-toggle="collapse" data-target="#accordion<?=$rv['progressivo']?>_<?=$rv['id']?>" aria-expanded="false" aria-controls="accordion<?=$rv['progressivo']?>_<?=$rv['id']?>">
                                        Veicolo #<?=$rv['progressivo']?>
                                        </button>
                                        <?php
                                                   if(!$rv['targa']&&!$rv['marca']&&!$rv['modello']&&!$rv['tipo_acquisizione']&&!$rv['costo']){
                                                       $color="red";
                                                       $text=" non";
                                                       $icon="ban";
                                                   }else{
                                                       $color="green";
                                                       $text="";
                                                       $icon="check";

                                                   }?>
                                                   <div class="row">
                                        <small class="form-text text-muted" style="padding-left:50px"><i class="fa fa-<?=$icon?>" style="color:<?=$color?>;"aria-hidden="true"></i> Dati Veicolo<?=$text?> presenti</small>
                                        <small class="form-text text-muted" style="padding-left:50px"><i class="fa fa-<?=$icon?>" style="color:<?=$color?>;"aria-hidden="true"></i> Documenti Veicolo<?=$text?> caricati</small>
</div>
                                                        
                                    </div>
                                    <div id="accordion<?=$rv['progressivo']?>_<?=$rv['id']?>" class="collapse " role="tabpanel" aria-labelledby="headingA<?=$rv['progressivo']?>" data-parent="#accordionDivVeicoli">
                                        <div class="collapse-body">
                                       
                                            <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <table class="table table-borderless">
                                                            <caption style="font-size: 25px;caption-side: top;padding-bottom: 0px;">Dati Veicolo</caption>
                                                            <thead>
                                                                <tr >
                                                                <th>
                                                                    <button type="button" class="btn btn-success btn-sm" onclick="infomodal(<?=$rv['id']?>);" ><i class="fa fa-info" aria-hidden="true"></i> Aggiorna dati veicolo</button>
                                                                
                                                                    </th></tr>   
                                                            </thead>
                                                            <tbody style="font-size:15px;">
                                                                <tr>
                                                                    <td>Marca</td>
                                                                    <td id="marca_<?=$rv['id']?>"><?=$rv['marca']?$rv['marca']:'Non Presente'?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Modello</td>
                                                                    <td id="modello_<?=$rv['id']?>"><?=$rv['modello']?$rv['modello']:'Non Presente'?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Targa</td>
                                                                    <td id="targa_<?=$rv['id']?>"><?=$rv['targa']?$rv['targa']:'Non Presente'?></td>
                                                               
                                                                </tr>
                                                                <tr>
                                                                    <td>Tipo Acquisizione</td>
                                                                    <td id="tipo_acquisizione_<?=$rv['id']?>"><?php if($rv['tipo_acquisizione']){
                                                                        if($rv['tipo_acquisizione']=='01'){
                                                                            echo 'Acquisto';
                                                                        }elseif($rv['tipo_acquisizione']=='02'){
                                                                            echo 'Leasing';
                                                                        }
                                                                    }else{echo 'Non Presente';}?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Costo</td>
                                                                   
                                                                    <td id="costo_<?=$rv['id']?>"><?=$rv['costo']?'€ '.number_format($rv['costo'], 2, ',', '.'):'Non Presente'?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                   </div>
                                     
                                            </div>    
                                            <div class="row">   
                                                   <div class="col-lg-12">
                                                        <table class="table table-borderless">
                                                            <caption style="font-size: 25px;caption-side: top;">Documenti Veicolo</caption>
                                                            <thead>
                                                                <tr >
                                                                <th>
                                                                    <button type="button" class="btn btn-success btn-sm"onclick="docmodal(<?=$rv['id']?>);" ><i class="fa fa-upload" aria-hidden="true"></i> Carica documento</button>
                                                                
                                                                    </th></tr>   
                                                            </thead>
                                                            <tbody>
                                                                    <?php
                                                                    $allegati=getAllegati($i['id_RAM'],$rv['id']);
                                                                    if($allegati){
                                                                        foreach ($allegati as $alle) {?>
                                                                        
                                                                        <?php
                                                                        }
                                                                    }else{?>

                                                                    <tr><td>Non ci sono Documenti Caricati</td></tr> 
                                                                    <?php
                                                                    }?>
                                                        </tbody>
                                                        </table>
                                                   </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                  

<?php
                                              }
                                              ?>
</div>
