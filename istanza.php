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
                                                $("#almsg").alert('close')
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
                                                field+='<input type="file" class="form-control-file" id="file_allegato" name="file_allegato"required></div>'

                                                $('#campi_allegati').append(field) 
    

                                    },
                                    error: function()
                                    {
                                    alert("Chiamata fallita, si prega di riprovare...");
                                    }

                              });//ajax
            


      });
      $('#form_allegato').submit(function(event){
            event.preventDefault();
            tipo=$('#tipo_documento option:selected').text()
            console.log(tipo)
            formData = new FormData(this);
            //alert("ok")
                  $.ajax({
                        url: "controller/updateIstanze.php?action=newAllegato",
                        type:"POST",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                              console.log(data)
                              data_ins=convData(data.data_agg)
                              id_table= formData.get('doc_idvei')
                              $('#docModal').modal('toggle');
                              row='<tr><td>'+tipo+'</td><td>'+data_ins+'</td><td>'+data.note+'</td><td>col4</td></tr>'
                              $('#tab_doc_'+id_table+' > tbody:last-child').append(row);
                        }
                  })

      });
      $('#docModal').on('hidden.bs.modal', function (e) {
            $('#campi_allegati').empty();
      }) 
      
     
      function infomodal(id){

            //alert(id);
            $("#infoModal").modal("toggle");
            $("#info_idvei").val(id);

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
      function getAlle(id){
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getAllegato",
                        data: {id:id},
                        dataType: "json",
                      
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
</script>

</body>
</html>    