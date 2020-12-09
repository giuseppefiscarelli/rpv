<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

require_once 'model/istanze.php';
//$updateUrl = 'userUpdate.php';
$deleteUrl = 'controller/updateIstanze.php';
require_once 'headerInclude.php';
?>
<style>
.it-datepicker-wrapper {
    position: relative;
    margin-top: 50px;
}</style>
<div class="container my-4" style="max-width:90%">
 

    
      <?php
     
       require_once 'controller/displayIstanza.php' ;
          

      ?>
      
</div>    
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>

<script type="text/javascript"> 

      $(document).ready(function() {
            $('.it-date-datepicker').datepicker({
                  inputFormat: ["dd/MM/yyyy"],
                  outputFormat: 'dd/MM/yyyy',
                  
            });
      
      
      });  
      $('#form_infovei').submit(function( event ) {
            id_RAM = <?=$i['id_RAM']?>;

            prog=$('#info_prog').val()
            //console.log(prog)
            idvei = $('#info_idvei').val()
            targa=$('#targa').val()
            marca=$('#marca').val()
            modello=$('#modello').val() 
            costo=$('#costo').val()
            tipo_veicolo = $('#info_tipo_veicolo').val()
            totdoc =getTotDoc(tipo_veicolo)
            tipo=$('#tipo_acquisizione option:selected').val()
                              $.ajax({
                                    type: "POST",
                                    url: "controller/updateIstanze.php?action=upVeicolo",
                                    data: {id:idvei,targa:targa,marca:marca,modello:modello,costo:costo,tipo:tipo},
                                    dataType: "html",
                                    success: function(msg)
                                    {     
                                          
                                          //console.log(totdoc)
                                          
                                          $('#targa_'+idvei).html(targa)
                                          $('#marca_'+idvei).html(marca)
                                          $('#modello_'+idvei).html(modello)
                                          deuro = parseFloat(costo).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                                          
                                          $('#costo_'+idvei).html(deuro)
                                          if(tipo=='01'){
                                                tipo="Acquisto";
                                                checkdoc = $('#c_t_d_'+tipo_veicolo+'_'+prog).html()
                                                checkdoc = parseInt(checkdoc)
                                                checkdoc =parseInt(totdoc)-1;
                                                $('#c_t_d_'+tipo_veicolo+'_'+prog).html(checkdoc)
                                                $('#btn_docmodal_'+idvei).attr('onclick','docmodal('+prog+','+tipo_veicolo+','+id_RAM+',\'01\');')
                                                
                                          }
                                          if(tipo=='02'){
                                                tipo='Leasing';
                                                $('#c_t_d_'+tipo_veicolo+'_'+prog).html(parseInt(totdoc))
                                                $('#btn_docmodal_'+idvei).attr('onclick','docmodal('+prog+','+tipo_veicolo+','+id_RAM+',\'02\');')
                                          }
                                          $('#tipo_acquisizione_'+idvei).html(tipo)
                                          alert='<div id="message2"style="position: fixed;z-index: 1000;right: 0;bottom: 0px;">' 
                                          alert+='<div id="almsg"class="alert alert-success" style="background-color: white;"role="alert">'
                                          alert+='Dati Veicolo Aggiornati</div></div>'  
                                          $( ".container" ).append(alert);
                                          $("#message2").delay(6000).slideUp(200, function() {
                                                $(".alert").alert('close')
                                          });
                                          $("#btn_up_"+prog+"_"+idvei).attr('onclick','infomodalup('+prog+','+idvei+');')
                                          html='<i class="fa fa-info" aria-hidden="true"></i> Aggiorna dati veicolo'
                                          $("#btn_up_"+prog+"_"+idvei).html(html)
                                          htmlck ='<i class="fa fa-check" style="color:green" aria-hidden="true"></i> Dati Veicolo presenti'
                                          $("#ckeck_info_vei_"+prog+"_"+idvei).html(htmlck)
    

                                    },
                                    error: function()
                                    {
                                    alert("Chiamata fallita, si prega di riprovare...");
                                    }

                              });//ajax

                              
         $("#infoModal").modal('hide');
         $(this)[0].reset();
         $("#tipo_acquisizione").val('').selectpicker("refresh");
         event.preventDefault();
           
      });
      $('#tipo_documento').change(function(){
            $('#campi_allegati').empty();
            tipo=$('#tipo_documento option:selected').val()
            $.ajax({
                                    type: "POST",
                                    url: "controller/updateIstanze.php?action=getTipDoc",
                                    data: {tipo:tipo},
                                    dataType: "json",
                                    success: function(results){     
                                        
                                          $.each(results,function(k,v){
                                               //console.log(k)
                                               //console.log(v)
                                               
                                                  
                                               required= v.richiesto
                                               if(required=="o"){
                                                     req = true
                                               }
                                               if(required =="f"){
                                                     req=false
                                               }
                                               //conter=1
                                               //console.log(req)
                                               var namecampo = v.nome_campo.replace(" ", "_");
                                            
                                           if (v.tipo_valore=='d'){
                                                field='<div class="it-datepicker-wrapper "><div class="form-group">'
                                                field+='<input onblur="testDate(this)" onkeypress="return event.charCode >= 47 && event.charCode <= 57" class="form-control it-date-datepicker" id="'+namecampo+'"name="'+namecampo+'" maxlength="10"type="text"  placeholder="inserisci la data">'
                                                field+='<label for="'+namecampo+'">'+v.nome_campo+'</label></div></div>'
                                                
                                                $('#campi_allegati').append(field)
                                                $( ".it-date-datepicker" ).datepicker({
                                                      inputFormat: ["dd/MM/yyyy"],
                                                      outputFormat: 'dd/MM/yyyy',
                                                });
                                                $("#"+namecampo).attr("required", req);
                                           }
                                           if (v.tipo_valore=='t'){
                                                field='<div class="form-group" style="margin-top: inherit;">'
                                                field+='<label for="'+namecampo+'">'+v.nome_campo+'</label>'
                                                field+='<input oninput="this.value = this.value.toUpperCase();" type="text" class="form-control" id="'+namecampo+'" name="'+namecampo+'" >'
                                                field+='</div>'
                                               
                                                $('#campi_allegati').append(field)
                                                $("#"+namecampo).attr("required", req);
                                           }
                                           if (v.tipo_valore=='i'){
                                                field='<label for="'+namecampo+'" class="input-number-label">'+v.nome_campo+'</label>'
                                                field+='<span class="input-number input-number-currency">'
                                                field+='<input type="number" id="'+namecampo+'" name="'+namecampo+'" step="any" value="0"  >'
                                                field+='</span>'
                                                
                                                $('#campi_allegati').append(field)
                                                $("#"+namecampo).attr("required", req);
                                           }
                                           if (v.tipo_valore=='n'){
                                                field='<label for="'+namecampo+'" class="input-number-label">'+v.nome_campo+'</label>'
                                                field+='<span class="input-number">'
                                                field+='<input type="number" id="'+namecampo+'" name="'+namecampo+'" step="any" value="0" >'
                                                field+='</span>'
                                              
                                                $('#campi_allegati').append(field)
                                                $("#"+namecampo).attr("required", req);
                                           }
                                                    

                                          })

                                          field='<div class="form-group" style="margin-top: inherit;">'
                                                field+='<label for="note_allegato">Note</label>'
                                                field+='<textarea  class="form-control" id="note_allegato" rows="3" id="note_allegato" name="note_allegato"></textarea>'
                                                field+='</div>'
                                                $('#campi_allegati').append(field); 
                                                field='<div class="form-group">'
                                                field+='<label for="file_allegato" class="active">Documento</label>'
                                                field+='<input type="file" accept="application/pdf" class="form-control-file" id="file_allegato" name="file_allegato"required></div>'

                                                $('#campi_allegati').append(field) 
    

                                    },
                                    error: function()
                                    {
                                    alert("Chiamata fallita, si prega di riprovare...");
                                    }

                              });//ajax
            


      });
      $('#form_allegato').submit(function(event){
            $('#docModal').modal('toggle');
            var htmltext='<div class="progress"><div class="progress-bar" role="progressbar" id="progress-bar"style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>'
      
       
            Swal.fire({ 
                  html:true,
                  title: "Caricamento in Corso",
                  html:htmltext,
                  type: "info",
                  allowOutsideClick:false,
                  showConfirmButton:false
            });
           
            event.preventDefault();
            tipo=$('#tipo_documento option:selected').attr("data-content")
            tipo= tipo.replace(/(<([^>]+)>)/ig,"");
           // console.log(tipo)
            formData = new FormData(this);
            
                  $.ajax({
                              xhr: function() {
                              var xhr = new window.XMLHttpRequest();
                              xhr.upload.addEventListener("progress", function(evt) {
                                  if (evt.lengthComputable) {
                                      var percentComplete = ((evt.loaded / evt.total) * 100);
                                      $("#progress-bar").width(percentComplete + '%');
                                     
                                      //$(".progress-bar").html(percentComplete+'%');
                                  }
                              }, false);
                              return xhr;
                          },
                        url: "controller/updateIstanze.php?action=newAllegato",
                        type:"POST",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){
                                $("#progress-bar").width('0%');
                                $('#uploadStatus').html('<img src="images/loading.gif"/>');
                            },
                            error:function(){
                              
                                Swal.fire("Operazione Non Completata!", "Allegato non caricato.", "warning");
                             
                            },
                        success: function(data){
                              
                              console.log('newallegato')
                              Swal.fire("Operazione Completata!", "Allegato caricato correttamente.", "success");
                              tipoalle=data.tipo_veicolo;
                              console.log(tipoalle);
                              progalle=data.progressivo;
                              checkDocVei(tipoalle,progalle);
                              data_ins=convData(data.data_agg);
                              ora_ins= convOre(data.data_agg);
                              //tipo_vei= formData.get('doc_idvei')
                              buttonA='<button type="button" onclick="infoAlle('+data.id+');"class="btn btn-warning btn-xs" title="Visualizza Info Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>';
                              buttonB='<button type="button" onclick="window.open(\''+data.id+'\', \'_blank\')"title="Vedi Documento"class="btn btn-xs btn-primary " style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';
                              buttonC='<a type="button" href="download.php?id='+data.id+'" download title="Scarica Documento"class="btn btn-xs btn-success " style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i> </a>';
                              buttonD='<button type="button" onclick="delAll('+data.id+',this)"title="Elimina Documento"class="btn btn-xs btn-danger " style="padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>';

                              
                              
                              
                              row='<tr><td>'+tipo+'</td><td>'+data_ins+' '+ora_ins+'</td><td>'+data.note+'</td><td>'+buttonA+' '+buttonB+' '+buttonC+' '+buttonD+'</td></tr>'
                              $('#tab_doc_'+tipoalle+'_'+progalle+' > tbody:last-child').append(row);
                             
                        }
                  })

      })
      $('#form_allegato_mag').submit(function(event){
            $('#docMaggiorazione').modal('toggle');
            var htmltext='<div class="progress"><div class="progress-bar" role="progressbar" id="progress-bar"style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>'
      
                  Swal.fire({ 
                        html:true,
                        title: "Caricamento in Corso",
                        html:htmltext,
                        type: "info",
                        allowOutsideClick:false,
                        showConfirmButton:false
                  });
                  
            event.preventDefault();
            tipo=$('#tipo_alle').val()
            //tipo= tipo.replace(/(<([^>]+)>)/ig,"");
            //console.log(tipo)
            formData = new FormData(this);
            
                  $.ajax({
                              xhr: function() {
                              var xhr = new window.XMLHttpRequest();
                              xhr.upload.addEventListener("progress", function(evt) {
                                    //console.log(evt)
                                  if (evt.lengthComputable) {
                                      var percentComplete = ((evt.loaded / evt.total) * 100);
                                      //console.log(evt)
                                      $("#progress-bar").width(percentComplete + '%');
                                     
                                      //$(".progress-bar").html(percentComplete+'%');
                                  }
                              }, false);
                              return xhr;
                          },
                        url: "controller/updateIstanze.php?action=newAllegatoMag",
                        type:"POST",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){
                                $("#progress-bar").width('0%');
                                $('#uploadStatus').html('<img src="images/loading.gif"/>');
                            },
                            error:function(){
                              
                                Swal.fire("Operazione Non Completata!", "Allegato non caricato correttamente.", "warning");
                             
                            },
                        success: function(data){
                                                       
                                Swal.fire("Operazione Completata!", "Allegato caricato correttamente.", "success");
                              
                             
                              data_ins=convData(data.data_agg)
                              $('#data_'+tipo).html(data_ins)
                              $('#upload_'+tipo).hide()
                              $('#download_'+tipo).show()
                              $('#open_'+tipo).attr("onclick","window.open('allegato.php?id="+data.id+"', '_blank')");
                              $('#del_'+tipo).attr("onclick","delAlle("+data.id+",this);");
                              $('#down_'+tipo).attr("href","download.php?id="+data.id)
                              //id_table= formData.get('doc_idvei')
                              $('#file_allegato').val(null);
                            
                              
                             
                        }
                  })

      })
      $('#docModal').on('hidden.bs.modal', function (e) {
            $('#campi_allegati').empty();
      }) 
      function getTotDoc(tipo){
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=countDocVeicolo",
                        data: {tipo_veicolo:tipo},
                        dataType: "json",
                        success: function(data){
                             // console.log("conta documenti "+data)
                             totdoc = parseInt(data)
                             //console.log("conta documenti "+data)
                              return totdoc;
                            
                                                          
                        }
                       
                  })

               //   return totdoc;

      }
      function getCampo(cod){
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getInfoCampo",
                        data: {cod:cod},
                        dataType: "json",
                        success: function(data){
                             // console.log(data)
                             
                              return data
                            
                                                          
                        }
                  })


      }
      function infoAlle(id){
            const formatter = new Intl.NumberFormat('it-IT', {
                  style: 'currency',
                  currency: 'EUR',
                  minimumFractionDigits: 2
            })
            $('#infoAllegato').modal('toggle');
            $('#info_tab_alle tbody').empty();
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getAllegato",
                        data: {id:id},
                        dataType: "json",
                        success: function(data){
                              //console.log(data)
                             // console.log(data['allegato'].json_data)
                              test = $.parseJSON(data['allegato'].json_data)
                             // console.log(test)
                              //test = $.parseJSON(data.json_data)
                              $.each(test, function(k, v) {
                                    campo = k.split("_")
                                    campo= capitalizeFirstLetter(campo[0])+' '+ capitalizeFirstLetter(campo[1])
                                   // console.log(campo)
                                    if(campo=="Importo "){
                                          v = formatter.format(v);

                                    }
                                    $('#info_tab_alle').append('<tr><td>'+campo+'</td><td>'+v+'</td></tr>');

                              });
                              view = '<button type="button" onclick="window.open(\'allegato.php?id='+id+'\', \'_blank\')" title="Vedi Documento"class="btn btn-xs btn-primary " style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'

                              down ='<a type="button" href="download.php?id='+id+'" download title="Scarica Documento"class="btn btn-xs btn-success " style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i> </a>'

                              $('#info_tab_alle').append('<tr><td>Scarica Allegato</td><td>'+down+'</td></tr>');
                              $('#info_tab_alle').append('<tr><td>Visualizza allegato</td><td>'+view+'</td></tr>');


                            
                                                          
                        }
                  })



      }     
      function infomodal(prog,id){
         $('#form_infovei')[0].reset();
         $("#tipo_acquisizione").html('<option value="01">Acquisto</option><option value="02">Leasing</option>');
         $("#tipo_acquisizione").prop('required',true);
         $(".bootstrap-select-wrapper select").selectpicker("refresh");
         getInfoVei2(id);
            //alert(id);
            $("#infoModal").modal("toggle");
            $("#info_idvei").val(id);
            $("#info_prog").val(prog);

      } 
      function infomodalup(prog,id){

            //alert(id);
            $("#infoModal").modal("toggle");
            getInfoVei(id);
            $("#info_prog").val(prog);
            $("#info_idvei").val(id);
           

      } 
      function docmagmodal(id,tipodoc){
            //$("#infoModal").modal("toggle");
            $("#docMaggiorazione").modal("toggle");
            $("#tipo_doc_mag").val(tipodoc);
            $("#tipo_alle").val(id);
            tipo = $('#tipo_magg_'+id).text();
           // console.log(tipo);
            $('#tipo_documento_magg').val(tipo);



            
      }
      function getInfoVei(id){
            //$(".selinfo option").remove();
            //$('.selinfo select').selectpicker('refresh')
                  $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getInfoVei",
                        data: {id:id},
                        dataType: "json",
                        success: function(data){
                              console.log(data.tipo_acquisizione)
                             $('#targa').val(data.targa)
                              $('#marca').val(data.marca)
                              $('#modello').val(data.modello)
                              $('#costo').val(data.costo)
                              //$('#info_prog').val(data.progressivo)
                              $('#info_tipo_veicolo').val(data.tipo_veicolo)
                              
                              $('#tipo_acquisizione').val(data.tipo_acquisizione);
                              $('.selinfo select').selectpicker('render');
                              
                            
                                                          
                        }
                  })


      }  
      function getInfoVei2(id){
            //$(".selinfo option").remove();
            //$('.selinfo select').selectpicker('refresh')
                  $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getInfoVei",
                        data: {id:id},
                        dataType: "json",
                        success: function(data){
                            
                            
                              $('#info_tipo_veicolo').val(data.tipo_veicolo)
                              
                             
                            
                                                          
                        }
                  })


      }      
      function docmodal(prog,tipovei,istanza,tipoac){
            id_RAM =istanza;
           // var ckdoc = ckInfoVei(id);
            
            //$('#tipo_documento').remove();
            $(".seldoc option").remove();
            $('.seldoc select').selectpicker('refresh')
            //alert(id);
            $("#docModal").modal("toggle");
            //$("#doc_idvei").val(id);
            $("#tipo_veicolo").val(tipovei);
            $("#progressivo").val(prog);
                  $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getDocVei",
                        data: {tipovei:tipovei,id_RAM:id_RAM,progressivo:prog},
                        dataType: "json",
                        success: function(data){
                              //console.log(data)
                              
                              $.each(data, function(k,v){
                                    console.log(v.codice_tipo_documento)
                                    tip=v.codice_tipo_documento
                                    //console.log(ckdoc)
                                    tipoDoc(tip,tipoac)


                              })
                                                          
                        }
                  })
                
                

                  
      } 
       /////////////////////   
      function ckInfoVei(id){
                  $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getInfoVei",
                        data: {id:id},
                        dataType: "json",
                        success: function(data){
                             console.log(data.tipo_acquisizione)
                             // return data;
                              if(data.tipo_acquisizione=='01'){
                                    return true;
                              }else{
                                    return false;
                              }
                              
                            
                                                          
                        }
                  })


      } 
      function tipDoc(tip){
       $('#row_doc').empty();

           
           $.ajax({

                 url:"controller/updateIstanze.php?action=getTipDoc",
                 type:"POST",
                 data:{tip:tip},
                 dataType:"json",
                 success:function(data){
                       $.each(data, function(k,v){
                              
                              tipo=v.tipo_valore;
                              if (tipo=="d"){
                                    type='date';
                                    id="data_documento";
                                    input = '<div class="form-group">';
                                    input +='<div class="it-datepicker-wrapper">'
                                    input +='<div class="form-group">'
                                    input +='<input class="form-control it-date-datepicker" id="'+id+'" type="text" placeholder="inserisci la data in formato gg/mm/aaaa">'
                                    input +='<label for="'+id+'">'+v.nome_campo+'</label>'
                                    input +='</div>'
                                    input +='</div>'
                                    input +='</div>'
                                    

                              }
                              if (tipo=="n"){
                                    type='number';
                                    id="numero_documento";
                              }
                              if (tipo=="i"){
                                    type='number';
                                    id="importo_documento";

                                    
                                    input='<div class="w-50 mt-5">'
                                   // input ='<label for="'+id+'" class="input-number-label">'+v.nome_campo+'</label>';
                                   // input +=' <span class="input-number input-number-currency">'
                                   // input +='<input type="'+type+'" class="form-control" id="'+id+'" min="0" value="0"></span>';
                                    
                                    // ';
                                    input+='<label for="'+id+'" class="input-number-label">'+v.nome_campo+'</label>'
                                    input +='<span class="input-number input-number-currency">'
                                    input +='<input type="number" id="'+id+'" name="'+id+'" step="any" value="0.00" min="0">'
                                   
                                    //input +='<button class="input-number-add">'
                                   // input +='<span class="sr-only">Aumenta valore Euro</spstep="any"an>'
                                    ////input +='</button>'
                                    //input +='<button class="input-number-sub">'
                                    //input +='<span class="sr-only">Diminuisci valore Euro</span>'
                                    //input +='</button>'
                                    input +='</span>'
                                    input +='</div>'
                                   
                              }
                              if (tipo=="t"){
                                    type='text';
                                    id="testo_documento";
                                    input = '<div class="form-group">';
                                    input +='<input type="'+type+'" class="form-control" id="'+id+'">';
                                    input +='<label for="'+id+'">'+v.nome_campo+'</label>';
                                    input +=' </div>';
                              }
                              $('.it-date-datepicker').datepicker({
                                          inputFormat: ["dd/MM/yyyy"],
                                          outputFormat: 'dd/MM/yyyy',
                                    });
                              $('#row_doc').append(input);
                       });

                 }
           })
      }
      function tipoDoc(tipo,tipoac){
            //id_RAM = '<?=$i['id_RAM']?>';
           // var cktipac = ckInfoVei(id);
         //console.log(tipoac)
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getTipoDoc",
                        data: {tipo:tipo},
                        dataType: "json",
                        success: function(data){
                              $.each(data, function(k,v){
                                   if(v.tdoc_codice=='9' && tipoac=='01'){
                                         console.log('entra '+v.tdoc_codice)
                                  //  $('.bootstrap-select-wrapper select').append('<option data-subtext="Documento già inserito" data-content="' + v.tdoc_descrizione + '" value="' + v.tdoc_codice + '"></option>');
                                   // $('.bootstrap-select-wrapper select').selectpicker('refresh')
                                   }else{
                                    $('.seldoc select').append('<option data-subtext="Documento già inserito" data-content="' + v.tdoc_descrizione + '" value="' + v.tdoc_codice + '"></option>');
                                    $('.seldoc select').selectpicker('refresh')

                                   }
                                    //console.log(v.tdoc_descrizione)
                                    //$('#tipo_documento').append('<option data-subtext="Documento già inserito" data-content="' + v.tdoc_descrizione + ' <i class=\'fa fa-ban\' aria-hidden=\'true\' style=\'color:red;\'></i>" value="' + v.tdoc_codice + '"></option>');

                                    
                              })

                              }
                                                          
                        
                  })
                  


      
      }      
      function convData(isodata){
            newdata = new Date(isodata);
            newgiorno =newdata.getDate()
            if(newgiorno<10){
                  newgiorno="0"+newgiorno
            }
            newmese=newdata.getMonth()+1;
            if(newmese<10){
                  newmese="0"+newmese
            }
            newanno=newdata.getFullYear();
            return newgiorno+'/'+newmese+'/'+newanno;
      }
      function convOre(isodata){
            newdata = new Date(isodata);
            ore = newdata.getHours();
            minuti = newdata.getMinutes();
            
            return ore+':'+minuti;
      }
      function delAlle(ida,elem){
           
            div_down= elem.parentNode.id;
            div_up=div_down.split("_");
            //console.log(div_up)
            div_up = div_up[1];
            //console.log("upload_"+div_up)
            Swal.fire({
                  title: 'Vuoi eliminare l\'allegato?',
                  text: "Non potrai più recuperarlo",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'SI Eliminalo!',
                  cancelButtonText: 'NO, Annulla!'
                  }).then((result) => {
                        if (result.isConfirmed) {
                              $.ajax({
                                    url: "controller/updateIstanze.php?action=delAllegato",
                                    data: {id:ida},
                                    dataType: "json",
                                    success: function(results){
                                         
                                          if(results)
                                          {
                                                $('#upload_'+div_up).show();
                                                $('#'+div_down).hide()
                                                $('#data_'+div_up).text("Allegato non Caricato")
                                                Swal.fire(
                                                      'Eliminato!',
                                                      'L\'allegato è stato eliminato correttamente.',
                                                      'success'
                                                )
                                          }
                                          //console.log(results)
                                    }

                              })


                        }
                  })
      }
      function delAll(ida,elem){
           
           

         

           Swal.fire({
                 title: 'Vuoi eliminare l\'allegato?',
                 text: "Non potrai più recuperarlo",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'SI Eliminalo!',
                 cancelButtonText: 'NO, Annulla!'
                 }).then((result) => {
                       if (result.isConfirmed) {
                             $.ajax({
                                   url: "controller/updateIstanze.php?action=delAllegato",
                                   data: {id:ida},
                                   dataType: "json",
                                   success: function(results){
                                        
                                         if(results)
                                         {
                                               
                                          $(elem).closest('tr').remove();
                                               Swal.fire(
                                                     'Eliminato!',
                                                     'L\'allegato è stato eliminato correttamente.',
                                                     'success'
                                               )
                                         }
                                         //console.log(results)
                                   }

                             })


                       }
                 })
      }
      function checkDocVei(tipo,prog){
            console.log('check')
            checkvp=$('#c_p_d_'+tipo+'_'+prog).html()
            checkvt=$('#c_t_d_'+tipo+'_'+prog).html()
            
            checkcatp= $('#ch_p_'+tipo).html()
            checkcatt= $('#ch_t_'+tipo).html()

            checkvp = parseInt(checkvp)
            checkvt= parseInt(checkvt)
            checkcatp= parseInt(checkcatp)
            checkcatt= parseInt(checkcatt)

            if(checkvp == checkvt){
                  docvei = true
            }else{
                  docvei = false
            }
            //console.log(checkvp)
            console.log('chech ' +checkvt)
            //console.log(docvei)
            if(checkcatp==checkcatt){
                  catvei = true
            }else{
                  catvei = false
            }
            //console.log(checkcatp)
            //console.log(checkcatt)
            //console.log(catvei)

            
            id_RAM =<?=$i['id_RAM']?>,
            
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=checkDoc",
                        data: {id_RAM:id_RAM,tipo_veicolo:tipo,progressivo:prog},
                        dataType: "json",
                        success: function(data){
                              //console.log(data)
                              if(data.n==checkvt){
                                    ic="check"
                                    color="green"
                                    if(catvei == false){
                                          checkcatp++ ;
                                          $('#ch_p_'+tipo).html(checkcatp)
                                          if(checkcatp==checkcatt){

                                                $('#ch_i_'+tipo).removeClass();
                                                $('#ch_i_'+tipo).addClass("fa fa-check");
                                                $('#ch_i_'+tipo).css("color", "green");

                                          }    

                                    }
                              }else{
                                    ic="ban"
                                    color="red"
                              }
                              
                              icon='<i class="fa fa-'+ic+'" style="color:'+color+';"aria-hidden="true"></i> Documenti veicoli caricati <b id="c_p_d_'+tipo+'_'+prog+'">'+data.n+'</b> di  <b id="c_t_d_'+tipo+'_'+prog+'">'+checkvt+'</b>'
                              $('#check_vei_'+tipo+'_'+prog).html(icon);
                             
                              
                            
                                                          
                        }
                  })


      }
      function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
      }
      function closeRend(id_ram){
            check=checkIstanza();
            console.log(check);
            textAlert="";
            if(check==0){
                  Swal.fire({
                  
                  title: 'Vuoi chiudere la Rendicontazione?',
                  html: "Non potrai più aggiornarla",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'SI Chiudila!',
                  cancelButtonText: 'NO, Annulla!'
                  }).then((result) => {
                        if (result.isConfirmed) {
                              $.ajax({
                                    url: "controller/updateIstanze.php?action=closeRend",
                                    data: {id_ram:id_ram},
                                    dataType: "json",
                                    success: function(results){
                                         
                                          if(results)
                                          {
                                                Swal.fire({
                                                                  allowOutsideClick:false,

                                                                  title: 'Rendicontazione Chiusa!',
                                                                  html:'La rendicontazione è stata chiusa correttamente.',
                                                                  icon:'success'
                                                            }).then((result) => {
                                                                               if (result.isConfirmed) {
                                                                                          location.href='home.php'
                                                                              }
                                                                  })
                                          }
                                          //console.log(results)
                                    }

                              })


                        }
                  })

            }else{
             textAlert= check; 
             Swal.fire({
                  
                  title: 'La rendicontazione è incompleta! ',
                  html: textAlert,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'SI Procedi!',
                  cancelButtonText: 'NO, Annulla!'
                  }).then((result) => {
                        if (result.isConfirmed) {
                              Swal.fire({
                              
                              title: 'Vuoi chiudere la Rendicontazione?',
                              html: "Non potrai più aggiornarla",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'SI Chiudila!',
                              cancelButtonText: 'NO, Annulla!'
                              }).then((result) => {
                                    if (result.isConfirmed) {
                                          $.ajax({
                                                url: "controller/updateIstanze.php?action=closeRend",
                                                data: {id_ram:id_ram},
                                                dataType: "json",
                                                success: function(results){
                                                
                                                      if(results)
                                                      {
                                                            Swal.fire({
                                                                  allowOutsideClick:false,

                                                                  title: 'Rendicontazione Chiusa!',
                                                                  html:'La rendicontazione è stata chiusa correttamente.',
                                                                  icon:'success'
                                                            }).then((result) => {
                                                                               if (result.isConfirmed) {
                                                                                          location.href='home.php'
                                                                              }
                                                                  })






                                                      }
                                                      //console.log(results)
                                                }

                                          })


                                    }
                              })




                        }
                  })    

            }
           


      }
      function testDate(str) {
            //console.log(str.value)
            //console.log(str.id)
            data= str.value
            var t = data.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
            if(t === null)
            Swal.fire({ 
                //html:true,
                title: "Inserire una Data",
                text:"formato gg/mm/aaaa",
                icon: "warning"
                
            });
            var d = +t[1], m = +t[2], y = +t[3];

            // Below should be a more acurate algorithm
            if(m >= 1 && m <= 12 && d >= 1 && d <= 31) {
            return true;  
            }
            $('#'+str.id).val("");
            Swal.fire({ 
                //html:true,
                title: "Inserire la Data in modo corretto!",
                text:"formato gg/mm/aaaa",
                icon: "warning"
                
            });
      }   

      function checkIstanza(){

            veiok=0;
            veitot=0
            //checkvei=$("[id^=ch_p_]").html();
            //console.log(checkvei);
            $("[id^=ch_p_]").each(function() {
                  value=$(this).text()
                       //console.log(value)
                       value = parseFloat(value);
                       if(!isNaN(value) && value.length != 0) {
                        veiok += value;
                       }
   
                      
                   });
            $("[id^=ch_t_]").each(function() {
                  valuet=$(this).text()
                       //console.log(value)
                       valuet = parseFloat(valuet);
                       if(!isNaN(valuet) && valuet.length != 0) {
                        veitot += valuet;
                       }
   
                      
                   });

                   if(veitot==veiok){
                         return 0;
                   }else{
                         return "<b>Hai inserito i documenti di "+veiok+" veicoli su "+ veitot+"!</b><br>Vuoi Procedere con la Chiusura?";
                   }
                 
      }
     
            
</script>

</body>
</html>    