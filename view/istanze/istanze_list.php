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
                  <label for="search1" class="col-sm-6 col-form-label">Email Richiedente</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="search1" name="search1" value="<?=$search1?>" placeholder="Inserisci Email Richiedente">
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="search1" class="col-sm-6 col-form-label">Email Impresa</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="search2" name="search2" value="<?=$search2?>" placeholder="Inserisci Email Impresa">
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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="<?=$orderBy === 'id'?$orderDirClass: '' ?> ">
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=id&orderDir=<?=$orderDir?>">id</a></th>
                                <th class="<?=$orderBy === 'username'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=username&orderDir=<?=$orderDir?>">data</a></th>
                                <th class="<?=$orderBy === 'username'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=username&orderDir=<?=$orderDir?>">Ragione Sociale</a></th>

                                <th class="<?=$orderBy === 'roletype'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=roletype&orderDir=<?=$orderDir?>">Email richiedente</a></th>
                                <th class="<?=$orderBy === 'email'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=email&orderDir=<?=$orderDir?>">Email impresa</a></th>
                                <th class="<?=$orderBy === 'cognome'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">pec</a></th>    
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($istanze){
                                    foreach ($istanze as $i){?>
                            <tr>
                                <td><?=$i['id']?></td>
                                <td>data</td>
                                <td><?=$i['ragione_sociale']?></td>
                                <td><?=$i['email_richiedente']?></td>
                                <td><?=$i['email_impr']?></td>
                                <td><?=$i['pec_impr']?></td>
                                
                                
                                <td>
                                <button onclick="window.location.href='istanza.php?id=<?=$i['id']?>'" type="button" class="btn btn-warning" title="Visualizza Istanza"><i class="fa fa-list" aria-hidden="true"></i></button>

                                   
                                </td>
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
