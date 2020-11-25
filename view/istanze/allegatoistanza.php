<tr>
                                                    <td id="tipo_magg_<?=$tipo?>"><?=$descrizione?></td>
                                                    <td id="data_<?=$tipo?>"><?=$alle?$data_alle:'Allegato non Caricato'?></td>
                                                    <td> <?php
                                                            if(!isUserAdmin()){?> 

                                                        <div id="upload_<?=$tipo?>"style="display:<?=$alle?'none':''?>"    >
                                                            <button type="button" onclick="docmagmodal('<?=$tipo?>',<?=$tipo_doc?>);"class="btn btn-primary btn-xs" title="Carica Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i> Carica Allegato</button>
                                                        </div>
                                                        <?php
                                                        }?>
                                                        <div id="download_<?=$tipo?>"style="display:<?=$file?'':'none'?>"  >
                                                        <!--
                                                            <button id="info_<?=$tipo?>"type="button" onclick="infoAlle(<?=$alle['id']?>);"class="btn btn-danger btn-xs" title="Visualizza Info Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
                                                            -->
                                                            <button id="open_<?=$tipo?>"type="button" onclick="window.open('allegato.php?id=<?=$alle['id']?>', '_blank')"class="btn btn-primary btn-xs" title="Visualizza Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i></button>
                                                            <a d="down_<?=$tipo?>"type="button" href="download.php?id=<?=$alle['id']?>" download class="btn btn-success btn-xs" title="Download Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <?php
                                                            if(!isUserAdmin()){?> 
                                                            <button id="del_<?=$tipo?>" type="button" onclick="delAlle(<?=$alle['id']?>,this);"class="btn btn-danger btn-xs" title="Elimina Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            <?php
                                                        }?>
                                                        </div>

                                                    </td>
                                                </tr>