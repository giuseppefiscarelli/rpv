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
    
$(window).on( 'scroll', function(){
    var team = $('#header_menu').offset().top;
    if ($(window).scrollTop() >= team) {
       $('#li_logo').show()
    }else{
      $('#li_logo').hide()
    } 
});
     var myVar= $('[id^=nav-vertical-tab-bg]').find("active")
     
      $('#form_infovei').submit(function( event ) {
            idvei = $('#info_idvei').val()
            targa=$('#targa').val()
            marca=$('#marca').val()
            modello=$('#modello').val()
            costo=$('#costo').val()
            tipo=$('#tipo_acquisizione option:selected').val()
                              $.ajax({
                                    type: "POST",
                                    url: "controller/updateIstanze.php?action=upVeicolo",
                                    data: {id:idvei,targa:targa,marca:marca,modello:modello,costo:costo,tipo:tipo},
                                    dataType: "html",
                                    success: function(msg)
                                    {     
                                          $('#targa_'+idvei).html(targa)
                                          $('#marca_'+idvei).html(marca)
                                          $('#modello_'+idvei).html(modello)
                                          deuro = parseFloat(costo).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                                          
                                          $('#costo_'+idvei).html(deuro)
                                          if(tipo=='01'){
                                                tipo="Acquisto";
                                          }
                                          if(tipo=='02'){
                                                tipo='Leasing';
                                          }
                                          $('#tipo_acquisizione_'+idvei).html(tipo)
                                          alert='<div id="message2"style="position: fixed;z-index: 1000;right: 0;bottom: 0px;">' 
                                          alert+='<div id="almsg"class="alert alert-success" style="background-color: white;"role="alert">'
                                          alert+='Dati Veicolo Aggiornati</div></div>'  
                                          $( ".container" ).append(alert);
                                          $("#message2").delay(6000).slideUp(200, function() {
                                                $(".alert").alert('close')
                                          });
    

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
                                               required= v.richiesto
                                               if(required=="o"){
                                                     req = true
                                               }
                                               if(required =="f"){
                                                     req=false
                                               }
                                               conter=1
                                               console.log(req)
                                           if (v.tipo_valore=='d'){
                                                field='<div class="it-datepicker-wrapper "><div class="form-group">'
                                                field+='<input class="form-control it-date-datepicker" id="data_allegato"name="data_allegato" type="text" required placeholder="inserisci la data">'
                                                field+='<label for="data_allegato">'+v.nome_campo+'</label></div></div>'
                                                
                                                $('#campi_allegati').append(field)
                                                $( ".it-date-datepicker" ).datepicker({
                                                      inputFormat: ["dd/MM/yyyy"],
                                                      outputFormat: 'dd/MM/yyyy',
                                                });
                                                $("#data_allegato").attr("required", req);
                                           }
                                           if (v.tipo_valore=='t'){
                                                field='<div class="form-group">'
                                                field+='<label for="testo_allegato">'+v.nome_campo+'</label>'
                                                field+='<input type="text" class="form-control" id="testo_allegato" name="testo_allegato" required>'
                                                field+='</div>'
                                               
                                                $('#campi_allegati').append(field)
                                                $("#testo_allegato").attr("required", req);
                                           }
                                           if (v.tipo_valore=='i'){
                                                field='<label for="importo_allegato" class="input-number-label">'+v.nome_campo+'</label>'
                                                field+='<span class="input-number input-number-currency">'
                                                field+='<input type="number" id="importo_allegato" name="importo_allegato" value="0.00" min="0" required>'
                                                field+='</span>'
                                                
                                                $('#campi_allegati').append(field)
                                                $("#importo_allegato").attr("required", req);
                                           }
                                           if (v.tipo_valore=='n'){
                                                field='<label for="numero_allegato" class="input-number-label">'+v.nome_campo+'/label>'
                                                field+='<span class="input-number">'
                                                field+='<input type="number" id="numero_allegato" name="numero_allegato" value="0" required>'
                                                field+='</span>'
                                              
                                                $('#campi_allegati').append(field)
                                                $("#numero_allegato").attr("required", req);
                                           }
                                                

                                          })
                                          field='<div class="form-group" style="margin-top: inherit;">'
                                                field+='<label for="note_allegato">Note</label>'
                                                field+='<input type="text" class="form-control" id="note_allegato" name="note_allegato">'
                                                field+='</div>'
                                                $('#campi_allegati').append(field) 
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
            var htmltext='<div class="progress"><div class="progress-bar" role="progressbar" id="progress-bar"style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div></div>'
      
        Swal.fire({ 
                html:true,
                title: "Upload in Corso",
                text:htmltext,
                type: "info",
                showLoaderOnConfirm: true,
                showCancelButton: false,
                showConfirmButton: false
        });
           
            event.preventDefault();
            tipo=$('#tipo_documento option:selected').text()
            console.log(tipo)
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
                              
                                Swal.fire("Operazione Non Completata!", "Allegato non caricato correttamente.", "warning");
                             
                            },
                        success: function(data){
                              
                              
                                Swal.fire("Operazione Completata!", "Allegato caricato correttamente.", "success");
                              
                             
                              data_ins=convData(data.data_agg)
                              id_table= formData.get('doc_idvei')
                            
                              button='<a type="button" href="download.php?id='+data.id+'" download title="Scarica Documento"class="btn btn-primary "><i class="fa fa-download" aria-hidden="true"></i></a>'
                              buttonb='<button type="button" onclick="window.open(\'allegato.php?id='+data.id+'\', \'_blank\')"title="Vedi Documento"class="btn btn-danger "><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                              row='<tr><td>'+tipo+'</td><td>'+data_ins+'</td><td>'+data.note+'</td><td>'+button+''+buttonb+'</td></tr>'
                              $('#tab_doc_'+id_table+' > tbody:last-child').append(row);
                             
                        }
                  })

      })
      $('#form_allegato_mag').submit(function(event){
            $('#docMaggiorazione').modal('toggle');
            
            var htmltext='<div class="progress"><div class="progress-bar" role="progressbar" id="progress-bar"style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div></div>'
      
        Swal.fire({ 
                html:true,
                title: "Upload in Corso",
                text:htmltext,
                type: "info",
                showLoaderOnConfirm: true,
                showCancelButton: false,
                showConfirmButton: false
        });
           
            event.preventDefault();
            tipo=$('#tipo_doc_mag').val()
            console.log(tipo)
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
      
     
      function infomodal(id){
         $('#form_infovei')[0].reset();
         $("#tipo_acquisizione").val('').selectpicker("refresh");

            //alert(id);
            $("#infoModal").modal("toggle");
            $("#info_idvei").val(id);

      } 
      function infomodalup(id){

            //alert(id);
            $("#infoModal").modal("toggle");
            getInfoVei(id);
            $("#info_idvei").val(id);
           

      } 
      function docmagmodal(id){
            //$("#infoModal").modal("toggle");
            $("#docMaggiorazione").modal("toggle");
            $("#tipo_doc_mag").val(id);
            tipo = $('#tipo_magg_'+id).text();
            console.log(tipo);
            $('#tipo_documento_magg').val(tipo);



            
      }

      function getInfoVei(id){
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getInfoVei",
                        data: {id:id},
                        dataType: "json",
                        success: function(data){
                              console.log(data)
                              $('#targa').val(data.targa)
                              $('#marca').val(data.marca)
                              $('#modello').val(data.modello)
                              $('#costo').val(data.costo)
                              
                              $('.bootstrap-select-wrapper select').val(data.tipo_acquisizione);
                              $('.bootstrap-select-wrapper select').selectpicker('render');
                              
                            
                                                          
                        }
                  })


      }
      function docmodal(id,tipdoc){
            //$('#tipo_documento').remove();
            $(".bootstrap-select-wrapper option").remove();
            $('.bootstrap-select-wrapper select').selectpicker('refresh')
            //alert(id);
            $("#docModal").modal("toggle");
            $("#doc_idvei").val(id);
                  $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getDocVei",
                        data: {tipdoc:tipdoc},
                        dataType: "json",
                        success: function(data){
                              //console.log(data)
                              $.each(data, function(k,v){
                                    console.log(v.codice_tipo_documento)
                                    tip=v.codice_tipo_documento
                                    tipoDoc(tip)


                              })
                                                          
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
                                    input +='<input type="number" id="'+id+'" name="'+id+'" value="0.00" min="0">'
                                   
                                    //input +='<button class="input-number-add">'
                                   // input +='<span class="sr-only">Aumenta valore Euro</span>'
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
      function tipoDoc(tipo){
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getTipoDoc",
                        data: {tipo:tipo},
                        dataType: "json",
                        success: function(data){
                              $.each(data, function(k,v){
                                    console.log(v.tdoc_descrizione)
                                    $('#tipo_documento').append('<option value="' + v.tdoc_codice + '">' + v.tdoc_descrizione + '</option>');
                                    $('.bootstrap-select-wrapper select').selectpicker('refresh')
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

      function delAlle(ida,elem){
           
            div_down= elem.parentNode.id;
            div_up=div_down.split("_");
            //console.log(div_up)
            div_up = div_up[1];
            //console.log("upload_"+div_up)
            Swal.fire({
                  title: 'Vuoi elinimare l\'allegato?',
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
         
            
</script>

</body>
</html>    