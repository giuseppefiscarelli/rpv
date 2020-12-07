
<?php

//$alleMag = getAllegati($i['id_RAM'],0,0);
$pmi=90;
$rete=91;
$ampl=92;
$pmidoc =getTipDoc($pmi);
$retedoc =getTipDoc($rete);
$ampldoc =getTipDoc($ampl);
$allepmi = getAllegato($pmi,$i['id_RAM'],0);
$allerete = getAllegato($rete,$i['id_RAM'],0);
$alleampl = getAllegato($ampl,$i['id_RAM'],0);

//var_dump($pmidoc);
//var_dump($retedoc);
///var_dump($ampldoc);
//var_dump($allepmi);
//var_dump($allerete);
//var_dump($alleampl);


?>
        <div class="row"  style="margin-bottom:10px;">
            <div class="col-12">
               


                    <div id="accordionalle" class="collapse-div collapse-background-active" role="tablist">
                        <div class="collapse-header" id="headingAlle">
                            <button data-toggle="collapse" data-target="#accordionAllegati" aria-expanded="false" aria-controls="accordionAllegati">
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Allegati Dichiarazioni
                            </button>
                        </div>
                        <div id="accordionAllegati" class="collapse " role="tabpanel" aria-labelledby="headingAlle" data-parent="#accordionalle">
                            <div class="collapse-body">
                                <div class="row">
                                    <div class=" col-12">
                                        <table class="table table-borderless table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width:75%">Tipo</th>
                                                    <th style="width:11%">Data Caricamento</th>
                                                    <th style="width:14%"></th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size:15px;">
                                            <?php
                                            /*
                                            $data_ampl = false;
                                            $file_ampl =  false;
                                            $data_rete = false;
                                            $file_rete =  false;
                                            $data_pmi=false;
                                            $file_pmi=false;
                                            if($alleMag){
                                                foreach($alleMag as$aM){
                                                    $tipo=$aM['docu_id_file_archivio'];
                                                    $tipo = explode("_",$tipo);
                                                    $tipo = $tipo[1];
                                                    //var_dump($tipo);
                                                    if($tipo == "pmi"){

                                                        $data_pmi = date("d/m/Y",strtotime($aM['data_agg']));
                                                        $file_pmi = file_exists($pathAlle.$aM['docu_id_file_archivio']);
                                                        $id_alle_pmi=$aM['id'];
                                                       
                                                       
                                                    }elseif($tipo == "rete"){

                                                        $data_rete = date("d/m/Y",strtotime($aM['data_agg']));
                                                        $file_rete =  file_exists($pathAlle.$aM['docu_id_file_archivio']);
                                                        $id_alle_rete =$aM['id'];
                                                    }elseif($tipo == "ampl"){

                                                        $data_ampl = date("d/m/Y",strtotime($aM['data_agg']));
                                                        $file_ampl =  file_exists($pathAlle.$aM['docu_id_file_archivio']);
                                                        $id_alle_ampl =$aM['id'];
                                                    }

                                                     
                                                }


                                            }*/

                                                
                                                    if($i['pmi']=="Yes"){
                                                        $descrizione=$pmidoc;
                                                        $alle=0;
                                                        $file=0;
                                                        $tipo="pmi";
                                                        $tipo_doc= $pmi;
                                                        if($allepmi){
                                                            $alle=$allepmi;
                                                            $data_alle = date("d/m/Y",strtotime($alle['data_agg']));
                                                            $file = file_exists($pathAlle.$alle['docu_id_file_archivio']);
                                                            //var_dump($file);
                                                        }
                                                        
                                                        
                                                        
                                                        require "allegatoistanza.php";

                                                   
                                                    }
                                                    if($i['rete']=="Yes"){
                                                        $descrizione=$retedoc;
                                                        $alle=0;
                                                        $file=0;
                                                        $tipo="rete";
                                                        $tipo_doc= $rete;
                                                        if($allerete){
                                                      
                                                            $alle=$allerete;
                                                            $data_alle = date("d/m/Y",strtotime($alle['data_agg']));
                                                            $file = file_exists($pathAlle.$alle['docu_id_file_archivio']);
                                                        }
                                                        require "allegatoistanza.php";
                                                   
                                                    }
                                                    if($i['nr_1']>0||$i['nr_2']>0){
                                                        $descrizione=$ampldoc;
                                                        $alle=0;
                                                        $file=0;
                                                        $tipo="ampl";
                                                        $tipo_doc= $ampl;
                                                        if($alleampl){
                                                          
                                                            $alle=$alleampl;
                                                            $data_alle = date("d/m/Y",strtotime($alle['data_agg']));
                                                            $file = file_exists($pathAlle.$alle['docu_id_file_archivio']);
                                                        }
                                                        require "allegatoistanza.php";
                                                                                                      
                                                    }
                                                

                                                    ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>            
                        
                        </div>
                    </div>

                
            </div>
        </div>
 