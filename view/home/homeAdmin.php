<style>
   .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }
  .card-counter-baby{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 10px 5px;
    background-color: #fff;
    height: 50px;
    border-radius: 5px;
    transition: .3s linear all;
    font-size: 0.8vw;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger, .card-counter-baby.danger{
    background-color: #ef5350;
    color: #FFF;
  }  
  .card-counter.warning, .card-counter-baby.warning{
    background-color: #ff9800;
    color: #FFF;
  }

  .card-counter.success, .card-counter-baby.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info,.card-counter-baby.info{
    background-color: #26c6da;
    color: #FFF;
  }  
  .card-counter-baby.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }
 </style>      
  <div id="loadSpin">
        <div class="d-flex justify-content-center" >
            <p style="position:absolute;"><strong>Caricamento in corso...</strong></p>
            <div class="progress-spinner progress-spinner-active" style="margin-top:30px;">
                <span class="sr-only">Caricamento...</span>
            </div>
        </div>
    </div>



<script>
  $(document).ready(function(){
    $('#loadSpin').fadeOut("slow")



  $.ajax({
      type: "POST",
      url: "controller/updateIstanze.php?action=displayHome2",
      data: {},
      dataType: "json",
      success: function(response){
        $.each(response, function (k,v){
           
           element = '<div class="row"><div class="col-12 "><div class="card-wrapper card-space"><div class="card card-bg"><div class="card-body"><h3 class="card-title" style="align-text:center;">Istanze "'+v.titolo+'"</h3><div class="row">'
           element +='<div class="col-md-2 col-12"><div class="card-counter primary"><i class="fa fa-list"></i><span class="count-numbers">'+v.totali+' <small>Istanze</small></span><span class="count-name">Totali</span></div></div>'
           element +='<div class="col-md-2 col-12"><div class="card-counter success"><i class="fa fa-ticket"></i><span class="count-numbers">'+v.attive+' <small>istanze</small></span><span class="count-name">Attive</span></div></div>' 
           element +='<div class="col-md-2 col-12"><div class="card-counter warning"><i class="fa fa-pencil"></i><span class="count-numbers">'+v.rendicontazione+' <small>istanze</small></span><span class="count-name">In Rendicontazione</span></div></div>'
           element += '<div class="col-md-2 col-12"><div class="card-counter info" onclick="$(\'.istr_'+v.tipo+'\').toggle();" style="cursor: pointer;"><i class="fa fa-users"></i><span class="count-numbers">'+v.istruttoria+' <small>istanze</small></span><span class="count-name">In Istruttoria</span></div>'
           if(parseInt(v.istruttoria) >0 ){
                 element += '<p><em>Clicca per visualizzare le istanze</em></p>'
                 element +='<div class="card-counter-baby info istr_'+v.tipo+'"style="display:none; cursor:pointer;" onclick="javascript:location.href=\'istanze.php?search3='+v.tipo+'&search4=D\'"><i class="fa fa-users"></i><span class="count-numbers">'+v.istruttoria+' <small style="font-size: 0.8vw;">istanze</small></span><span class="count-name" style="float: right;">Tutte le istanze</span></div>'
                 element +='<div class="card-counter-baby warning istr_'+v.tipo+'" style="display:none; cursor:pointer;"onclick="javascript:location.href=\'istanze.php?search3='+v.tipo+'>&search4=D&search5=A\'"><i class="fa fa-pencil"></i><span class="count-numbers">'+v.integrazione+' <small style="font-size: 0.8vw;">istanze</small></span><span class="count-name" style="float: right;">Integrazione</span></div>'
                 element +='<div class="card-counter-baby warning istr_'+v.tipo+'" style="display:none; cursor:pointer;"onclick="javascript:location.href=\'istanze.php?search3='+v.tipo+'&search4=D&search5=B\'"><i class="fa fa-times"></i><span class="count-numbers">'+v.preavviso+' <small style="font-size: 0.8vw;">istanze</small></span><span class="count-name" style="float: right;">Preavviso di rigetto</span></div>'
                 element +='<div class="card-counter-baby success istr_'+v.tipo+'" style="display:none; cursor:pointer;"onclick="javascript:location.href=\'istanze.php?search3='+v.tipo+'&search4=D&search5=C\'"><i class="fa fa-check"></i><span class="count-numbers">'+v.ammessa+' <small style="font-size: 0.8vw;">istanze</small></span><span class="count-name" style="float: right;">Ammesse</span></div>'
                 element +='<div class="card-counter-baby danger istr_'+v.tipo+'" style="display:none; cursor:pointer;"onclick="javascript:location.href=\'istanze.php?search3='+v.tipo+'&search4=D&search5=D\'"><i class="fa fa-ban"></i><span class="count-numbers">'+v.rigettata+' <small style="font-size: 0.8vw;">istanze</small></span><span class="count-name" style="float: right;">Rigettate</span></div>'
           }
           element +='</div>'
           element +='<div class="col-md-2 col-12"><div class="card-counter danger"><i class="fa fa-calendar-times-o"></i><span class="count-numbers">'+v.scadute+' <small>istanze</small></span><span class="count-name">Scadute</span></div></div>'
           element +='<div class="col-md-2 col-12"><div class="card-counter danger"><i class="fa fa-times"></i><span class="count-numbers">'+v.annullate+' <small>istanze</small></span><span class="count-name">Annullate</span></div></div>'
           element += '</div></div></div></div></div></div>'
           $('#home').append(element)
         
         })
        $('#loadSpin').fadeOut("slow")
        
      }
                
          
                                        
          
    })
  })
</script>