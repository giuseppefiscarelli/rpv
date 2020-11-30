<?php
$orderDirClass = $orderDir;
$orderDir = $orderDir === 'ASC' ? 'DESC' : 'ASC';

?>


<div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <form id="searchForm" method="get" action="<?=$pageUrl?>">
              <input type="hidden" name="page" id="page" value="<?=$page?>" >
                <h4 class="form-header text-uppercase"  style="font-size: 12px;margin-bottom: 10px;">
                  <i class="fa fa-search"></i>
                   Ricerca
                </h4>
                <div class="form-group row">
                  
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="search1" name="search1" value="<?=$search1?>" placeholder="Inserisci Pec Richiedente">
                  </div>
                </div> 
                <div class="form-group row">
                 
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="search2" name="search2" value="<?=$search2?>" placeholder="Inserisci Id Protocollo RAM ">
                  </div>
                </div>    


                <div class="form-group row bootstrap-select-wrapper">
                  <label for="recordsPerPage" class="col-sm-8 col-form-label">Record per Pagina</label>
                  <div class="col-sm-4">
                  <select  
                  name="recordsPerPage" 
                  id="recordsPerPage" 
                  onchange="document.forms.searchForm.submit()">
                        <option value="">Seleziona</option>
                        <?php foreach ($recordsPerPageOptions as $val){ ?>
                        
                        <option value="<?=$val?>" <?=$recordsPerPage ==$val?'selected':''?>><?=$val?></option>
                        <?php }?>
                    </select>
                  </div>
                </div>
                
                <div class="form-footer" style="margin-top: 0px;">
                    <button type="button" onclick="location.href='<?=$pageUrl?>'" id="resetBtn" class="btn btn-danger"><i class="fa fa-trash"></i> Reset</button>
                    
                    <button type="submit" onclick="document.forms.searchForm.page.value=1" class="btn btn-success"><i class="fa fa-search"></i> Ricerca</button>
                </div> 
              </form>
            </div>
          </div>
        </div>
      </div>




      
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Lista Istanze</h5>
           
            <small style="float: right;">Totale Istanze <b><?=$totalUsers?></b><br> Pagina <b><?=$page?></b> di <b><?=$numPages?></b></small>
            <br>
                <div class="table-responsive" style="font-size:15px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="<?=$orderBy === 'id'?$orderDirClass: '' ?> ">
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=id&orderDir=<?=$orderDir?>">id RAM</a></th>
                                <th class="<?=$orderBy === 'data_invio'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=username&orderDir=<?=$orderDir?>">Data Invio</a></th>
                                <th class="<?=$orderBy === 'username'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=username&orderDir=<?=$orderDir?>">Ragione Sociale</a></th>

                                
                                <th class="<?=$orderBy === 'cognome'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">Pec Impresa</a></th>    
                                <th>Stato Istanza</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($istanze){
                                    foreach ($istanze as $i){
                                      $status=checkRend($i['id_RAM']);?>
                            <tr>
                                <td><?=$i['id_RAM']?></td>
                                <td><?=date("d/m/Y",strtotime($i['data_invio']))?></td></td>
                                <td><?=$i['ragione_sociale']?></td>
                                <td><?=$i['pec']?></td>
                                <?php
                                 if($status){

                                  if($status['aperta']==true){?>
                                  <td>
                                    <span class="badge badge-primary">In Rendicontazione</span>
                                    </td>
                                    <td>
                                      <button onclick="window.location.href='istanza.php?id=<?=$i['id_RAM']?>'" type="button" class="btn btn-warning" title="Visualizza Istanza"><i class="fa fa-list" aria-hidden="true"></i></button>
                                    </td>
                                  <?php
                                  }else{?>
                                  <td>
                                    <span class="badge badge-success">In Istruttoria</span><br>
                                    Rendicondazione chiusa il <?=date("d/m/Y",strtotime($status['data_chiusura']))?>
                                    </td>
                                    <td>
                                      <button onclick="window.location.href='istanza.php?id=<?=$i['id_RAM']?>'" type="button" class="btn btn-warning" title="Visualizza Istanza"><i class="fa fa-list" aria-hidden="true"></i></button>
                                    </td>
                                  <?php
                                  
                                  }
          
                                }else{?>
                                <td>
                                  <span class="badge badge-warning">Attiva</span>
                                  </td><td></td>
                                <?php
                                }
                                ?>
                            </tr>
                            <?php

                                    }
                                }else{
                                    
                                    echo '<tr><td colspan=2>NO Records Found</td></tr>';
                                }?>


                        </tbody>
                        
                        
                    

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
                            require_once 'view/template/navigation.php';
                                ?>
