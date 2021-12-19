<style type="text/css">

/* @group Blink */
.blink {
 -webkit-animation: blink .75s linear infinite;
 -moz-animation: blink .75s linear infinite;
 -ms-animation: blink .75s linear infinite;
 -o-animation: blink .75s linear infinite;
 animation: blink .75s linear infinite;
}
@-webkit-keyframes blink {
 0% { opacity: 1; }
 50% { opacity: 1; }
 50.01% { opacity: 0; }
 100% { opacity: 0; }
}
@-moz-keyframes blink {
 0% { opacity: 1; }
 50% { opacity: 1; }
 50.01% { opacity: 0; }
 100% { opacity: 0; }
}
@-ms-keyframes blink {
 0% { opacity: 1; }
 50% { opacity: 1; }
 50.01% { opacity: 0; }
 100% { opacity: 0; }
}
@-o-keyframes blink {
 0% { opacity: 1; }
 50% { opacity: 1; }
 50.01% { opacity: 0; }
 100% { opacity: 0; }
}
@keyframes blink {
 0% { opacity: 1; }
 50% { opacity: 1; }
 50.01% { opacity: 0; }
 100% { opacity: 0; }
}
/* @end */

</style>
<?php
//var_dump($tipo_istanza);
/*
 $activeIst = true;
 $status= checkRend($i['id_RAM']);
if(date("Y-m-d",strtotime($tipo_istanza['data_rendicontazione_fine']))<date("Y-m-d")){
  $span='<span class="badge badge-success">In Istruttoria</span><br>Termine per la rendicondazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
  $activeIst = false;
  

}else{
 
// var_dump($status);

 if($status){

  if($status['aperta']==1){
    $stato= getStatoIstanza('C');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span>';
   
  }elseif($status['aperta']==0){
    $stato= getStatoIstanza('D');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Rendicondazione chiusa il '.date("d/m/Y",strtotime($status['data_chiusura']));
    $activeIst = false;
  }
  if($status['data_annullamento']){
    $stato= getStatoIstanza('B');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Annullata da Impresa ';

    $activeIst = false;
  }
  if(($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d H:i:s")&&$status['aperta']==1)){
    $stato= getStatoIstanza('B');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Tempi di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
    $activeIst = false;
  } 
}else{
  $span='<span class="badge badge-warning">Attiva</span>';
}
}


*/

$activeIst = true;
$disable_istr=false;
$status= checkRend($i['id_RAM']);
$disable_actions = false;
$enable_status = 'A';
if($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d")){
 
  if($status){
    if($status['aperta']==1){
      $stato= getStatoIstanza('C');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span>';
     
    }elseif($status['aperta']==0){
      $stato= getStatoIstanza('D');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Rendicondazione chiusa il '.date("d/m/Y",strtotime($status['data_chiusura']));
      $activeIst = false;
      $enable_status = 'D';
    }
    if($status['data_annullamento']){
      $stato= getStatoIstanza('B');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Annullata da Impresa ';
      $disable_actions = true;
      $activeIst = false;
      $enable_status = 'B';
    }
    if(($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d H:i:s")&&$status['aperta']==1)){
      $stato= getStatoIstanza('E');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Termini di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
      $activeIst = false;
      $disable_actions = true;
      $enable_status = 'E';
    }
  }
}else{
  if($status){
    if($status['aperta']==1){
      $stato= getStatoIstanza('C');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span>';
     
    }elseif($status['aperta']==0){
      $stato= getStatoIstanza('D');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Rendicondazione chiusa il '.date("d/m/Y",strtotime($status['data_chiusura']));
      $activeIst = false;
      $enable_status = 'D';
    }
    if($status['data_annullamento']){
      $stato= getStatoIstanza('B');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Annullata da Impresa ';
      $disable_actions = true;
      $activeIst = false;
      $enable_status = 'B';
    }
    if(($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d H:i:s")&&$status['aperta']==1)){
      $stato= getStatoIstanza('E');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Termini di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
      $activeIst = false;
      $disable_actions = true;
      $enable_status = 'E';
    }
  }else{
    $status['data_annullamento']= false;
    $span='<span class="badge badge-warning">Attiva</span>';
    $activeIst = true;
  }
}
$status_istr= getStatusIstruttoria($i['id_RAM']);
$check_stato_istruttoria= getStatusIstruttoria_test($i['id_RAM']);

$ena_report = [];
$disableIstruttoriafoot = false;
$new_stato_istruttoria = getStatusIstruttoria_full($i['id_RAM']);
//var_dump($new_stato_istruttoria);
if($new_stato_istruttoria){
  $new_tipo_report = getTipoRepFull($new_stato_istruttoria['tipo_report']);
  // var_dump($new_tipo_report);
  $text_istr = $new_tipo_report['badge_text'];
  $type_istr = $new_tipo_report['style'];
  if($new_stato_istruttoria['stato']=='A'){                                 
      $span_istr = '<b class="blink">Pec da inviare</b>';
      $ena_report = [];
      if($new_stato_istruttoria['tipo_report'] == 3 || $new_stato_istruttoria['tipo_report'] == 4){
        $disableIstruttoriafoot = true;
        $disable_istr=true;
      }
  }
  if($new_stato_istruttoria['stato']=='B'){                                 
    if($new_stato_istruttoria['data_ins']){
      $span_istr = '<b class="blink">Pec da convalidare</b>';
      $ena_report = [];
      if($new_stato_istruttoria['tipo_report'] == 3  || $new_stato_istruttoria['tipo_report'] == 4){ 
        $disableIstruttoriafoot = true;
        $disable_istr=true;
      }
    }
    if($new_stato_istruttoria['data_conv']){
      $span_istr = '<b class="blink">Pec da inviare</b>';
      $ena_report = [];
      if($new_stato_istruttoria['tipo_report'] == 3  || $new_stato_istruttoria['tipo_report'] == 4){  
        $disableIstruttoriafoot = true;
        $disable_istr=true;
      }
    }
  }
  if($new_stato_istruttoria['stato']=='C'){
    $span_istr = 'Pec inviata il '.date("d/m/Y",strtotime($new_stato_istruttoria['data_invio']));
    if($new_stato_istruttoria['tipo_report'] == 1){
      array_push($ena_report, 1,2);
      $date_scad =  date("d/m/Y", strtotime($new_stato_istruttoria['data_invio'].' + '.$daysOpenRend.' days'));
      $span_istr .= '<br>Ricezione documentazione entro e non oltre il '.$date_scad;
    }
    if($new_stato_istruttoria['tipo_report'] == 2){
      array_push($ena_report, 4);  
      $disableIstruttoriafoot = true;
    }
    if($new_stato_istruttoria['tipo_report'] == 3){
      $ena_report = [];
      $disableIstruttoriafoot = true;
      $disable_istr=true;
    }
    if($new_stato_istruttoria['tipo_report'] == 4){
      $ena_report = [];
      $disableIstruttoriafoot = true;
      $disable_istr=true;
    }
  }

  
  //var_dump($ena_report);//ok
}
//

if($status_istr && $check_stato_istruttoria){
    $status_istr = $check_stato_istruttoria;
   
}elseif($check_stato_istruttoria){
  $status_istr = $check_stato_istruttoria;
}

   
?>
<div class="row">
  <div class="col-lg-8 col-12">
    <h3 class="card-title">Istanza n° <?=$i['id_RAM']?>/<?=$tipo_istanza['anno']?>  <span style="font-size:17px;"><?=$i['ragione_sociale']?></span></h3>
  </div>
  <div class="col-lg-2 col-12">
    Stato Istanza <?=$span?>
  </div>
<?php
if(!$status['data_annullamento']&&$activeIst){?>
<div class="col-lg-2 col-12">
  <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#offModal">
  Annulla Istanza
</button>
  </div>

<?php }
?>
  

  <?php if($new_stato_istruttoria){ ?>
  <div class="col-lg-2 col-12" id="status_istruttoria">
   Stato Istruttoria <span class="badge badge-<?=$type_istr?>"><?=$text_istr?></span><br><?=$span_istr?>
  </div>

<?php }else{ ?>
  <div class="col-lg-2 col-12" id="status_istruttoria" style="display:none;">
  
  </div>
<?php
} ?>

</div>




<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="offModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Annullamento Istanza
        </h5>
      </div>
      <div class="modal-body">
        <form id="annForm">
        <input type="hidden" name="id_RAM" value="<?=$i['id_RAM']?>">
          <div class="form-group">
            <textarea id="note_annullamento"  name="note_annullamento" rows="3" maxlenght=500 placeholder="Inserisci riferimenti annullamento" required></textarea>
            <label for="note_annullamento">Note Annullamento</label>
          </div>
          </form>  
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Esci senza annullare</button>
        <button class="btn btn-success btn-sm" type="submit" form="annForm" type="button">Esegui Annullamento</button>
      </div>
    </div>
  </div>
</div>
<div id="loadSpin">
          <div class="d-flex justify-content-center" >
              <p style="position:absolute;"><strong>Caricamento in corso...</strong></p>
                <div class="progress-spinner progress-spinner-active" style="margin-top:30px;">
                <span class="sr-only">Caricamento...</span>
                </div>
            </div>
</div>
  <div class="row" id="istanza_container" style="display: none;">

    <div class="col-5 col-md-4 col-lg-2">
      <div class="nav nav-tabs nav-tabs-vertical" id="nav-admin" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="nav-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Dati Impresa</a>
        <a class="nav-link" id="nav-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Dati Veicoli </a>
        <a class="nav-link" id="nav-3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Riepilogo </a>
        <a class="nav-link" id="nav-4" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">Comunicazioni </a>
        <a class="nav-link" id="nav-5" data-toggle="tab" href="#tab-5" role="tab" aria-controls="tab-5" aria-selected="false">Report </a>


      </div>
    </div>
    <div class="col-7 col-md-8 col-lg-10">
      <div class="tab-content" id="nav-tab-admin">
        <div class="tab-pane p-3 fade show active" id="tab-1" role="tabpanel" aria-labelledby="nav-1"><?php require_once 'Admin_tab1.php'; ?> </div>
        <div class="tab-pane p-3 fade" id="tab-2" role="tabpanel" aria-labelledby="nav-2"><?php require_once 'Admin_tab2.php'; ?></div>
        <div class="tab-pane p-3 fade" id="tab-3" role="tabpanel" aria-labelledby="nav-3"><?php require_once 'Admin_tab3.php'; ?></div>
        <div class="tab-pane p-3 fade" id="tab-4" role="tabpanel" aria-labelledby="nav-4"><?php //require_once 'Admin_tab4.php'; ?></div>
        <div class="tab-pane p-3 fade" id="tab-5" role="tabpanel" aria-labelledby="nav-5"><?php require_once 'Admin_tab5.php'; ?></div>
      
      </div>
    </div>
  </div>
                                             
