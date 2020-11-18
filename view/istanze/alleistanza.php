
<?php

$alleMag = getAllegati($i['id_RAM'],0);
//$alleMag = getAllegato(99,$i['id_RAM'],0)
//var_dump($alleMag);
/*
foreach ($alleMag as $aM){
$test=$aM['docu_id_file_archivio'];
$test = explode("_",$test);
$test = $test[1];
var_dump($test);

}*/
//$test=$alleMag['docu_id_file_archivio'];
//$test = explode("_",$test);
//$test = $test[1];
//var_dump($test);
?>
        <div class="row"  style="margin-bottom:10px;">
            <div class="col-12">
               


                    <div id="accordionalle" class="collapse-div collapse-background-active" role="tablist">
                        <div class="collapse-header" id="headingAlle">
                            <button data-toggle="collapse" data-target="#accordionAllegati" aria-expanded="false" aria-controls="accordionAllegati">
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Allegati Per Maggiorazione
                            </button>
                        </div>
                        <div id="accordionAllegati" class="collapse " role="tabpanel" aria-labelledby="headingAlle" data-parent="#accordionalle">
                            <div class="collapse-body">
                                <div class="row">
                                    <div class=" col-12">
                                        <table class="table table-borderless table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th style="width:25%">Data Upload</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
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


                                            }

                                                
                                                    if($i['pmi']=="Yes"){
                                                        

                                                        ?>
                                                <tr>
                                                    <td id="tipo_magg_pmi">Dichiarazione sostitutiva dell’atto di notorietà attestante il numero delle unità lavorative (ULA) ed il volume del fatturato conseguito nell’ultimo esercizio fiscale.</td>
                                                    <td id="data_pmi"><?=$data_pmi?$data_pmi:'Allegato non Caricato'?></td>
                                                    <td>

                                                        <div id="upload_pmi"style="display:<?=$data_pmi?'none':''?>" class="btn-group btn-group-sm" role="group">
                                                            <button type="button" onclick="docmagmodal('pmi');"class="btn btn-primary btn-xs" title="Carica Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i> Carica Allegato</button>
                                                        </div>

                                                        <div id="download_pmi"style="display:<?=$file_pmi?'':'none'?>"class="btn-group btn-group-sm" role="group">
                                                            <button id="open_pmi"type="button" onclick="window.open('allegato.php?id=<?=$id_alle_pmi?>', '_blank')"class="btn btn-primary btn-xs" title="Visualizza Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i></button>
                                                            <a d="down_pmi"type="button" href="download.php?id=<?=$id_alle_pmi?>" download class="btn btn-success btn-xs" title="Download Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <button id="del_pmi" type="button" onclick="delAlle(<?=$id_alle_pmi?>,this);"class="btn btn-danger btn-xs" title="Elimina Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                    if($i['rete']=="Yes"){?>
                                                <tr>
                                                <td id="tipo_magg_rete">Copia del contratto di rete redatto nelle forme di cui all’art. 3, comma 4 ter del decreto legge 10 febbraio 2009, n. 5, convertito con legge 9 aprile 2009, n. 33</td>
                                                    <td id="data_rete"><?=$data_rete?$data_rete:'Allegato non Caricato'?></td>
                                                    <td >
                                                        <div id="upload_rete"style="display:<?=$file_rete?'none':''?>"class="btn-group btn-group-sm" role="group">
                                                        <button type="button" onclick="docmagmodal('rete');" class="btn btn-primary btn-xs" title="Carica Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i> Carica Allegato</button>

                                                        </div>

                                                        <div id="download_rete"style="display:<?=$file_rete?'':'none'?>"class="btn-group btn-group-sm" role="group">
                                                            <button id="open_rete" type="button" onclick="window.open('allegato.php?id=<?=$id_alle_rete?>', '_blank')"class="btn btn-primary btn-xs" title="Visualizza Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i></button>
                                                            <a id="down_rete"type="button" href="download.php?id=<?=$id_alle_rete?>" download class="btn btn-success btn-xs" title="Download Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <button id="del_rete"type="button" onclick="delAlle(<?=$id_alle_rete?>,this);"class="btn btn-danger btn-xs" title="Elimina Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                    if($i['nr_1']>0||$i['nr_2']>0){?>

                                                <tr>
                                                    <td id="tipo_magg_ampl">Dichiarazione di ampliamento dello stabilimento</td>
                                                    <td id="data_ampl"><?=$data_ampl?$data_ampl:'Allegato non Caricato'?></td>
                                                    <td>

                                                        <div id="upload_ampl"style="display:<?=$file_ampl?'none':''?>"class="btn-group btn-group-sm" role="group">
                                                            <button type="button" onclick="docmagmodal('ampl');" class="btn btn-primary btn-xs" title="Carica Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i> Carica Allegato</button>

                                                        </div>

                                                        <div id="download_ampl" style="display:<?=$file_ampl?'':'none'?>"class="btn-group btn-group-sm" role="group">
                                                            <button id="open_ampl"type="button" onclick="window.open('allegato.php?id=<?=$id_alle_ampl?>', '_blank')"class="btn btn-primary btn-xs" title="Visualizza Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i></button>
                                                            <a id="down_ampl"type="button" href="download.php?id=<?=$id_alle_ampl?>" download class="btn btn-success btn-xs" title="Download Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <button id="del_ampl"type="button" onclick="delAlle(<?=$id_alle_ampl?>,this);"class="btn btn-danger btn-xs" title="Elimina Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </div>

                                                    </td>
                                                    </tr>

                                                    <?php
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
 