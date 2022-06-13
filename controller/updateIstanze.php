
<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/istanze.php';
$params = $_GET;
switch ($action){
   
    case 'store':
      
    break; 

    case 'getTipDoc':

      $tipo_documento=$_REQUEST['tipo'];
      $res = getCampoDoc($tipo_documento);
      //echo json_encode($res);
     // var_dump($res);
      if ($res){
        $res2 = array();
        
            foreach($res as $r){
              $cod = getInfoCampo($r['cod_campo']);

              array_push($res2,$cod);
            }
            
            echo json_encode($res2);
      }
      
    break;

    case 'upVeicolo':
      $data=$_REQUEST;

      $res = upVeicolo($data);

      echo json_encode($res);

    break;

    case 'newAllegato':
       $file=$_FILES['file_allegato'];
       $data=$_POST;
       $json = $data;
      
       array_splice($json,0,3);

       $data['json_data'] = addslashes(json_encode($json));
      /* var_dump($data['json_data']);
       
       die;
     */
      // $data['json_data'] = $json;
      
       //upload file

      $data['docu_nome_file_origine']=$file['name'];
      $id_ram = $data['id_RAM'];
      //$id_veicolo = $data['doc_idvei'];
      //$infovei =  getInfoVei($id_veicolo);
      $tipo_veicolo= $data['tipo_veicolo'];
      $progressivo = $data['progressivo'];

      $tipo_documento = $data['tipo_documento'];
      $docu_nome_file_origine =  $file['name'];
      $path_parts = pathinfo($docu_nome_file_origine);

      $docu_id_file_archivio = $id_ram."_".$tipo_veicolo."_".$progressivo."_".strtotime("now").".".$path_parts['extension'];
      $data['docu_id_file_archivio']=$docu_id_file_archivio;
      $data['docu_nome_file_origine']=$docu_nome_file_origine;
       move_uploaded_file($file['tmp_name'],$pathAlle.$docu_id_file_archivio);
       if(file_exists($pathAlle.$docu_id_file_archivio)){
        $data['tipo_veicolo'] = $tipo_veicolo;
        $data['progressivo'] = $progressivo;
        $res= newAllegato($data);

       }
       if($res){
        $res2=getAllegatoID($res);
       }
       
       echo json_encode($res2);
        

    break; 

    case 'getAllegati':
      $data=$_REQUEST;
      $res =getAllegati($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      
      
      
      //$tipo = getTipDoc($res['tipo_documento']);
      //var_dump($res);
      if($res){
       
        
        echo json_encode($res); 
      }
       // var_dump($res);
       // var_dump($res);
        
     // echo json_encode($res);
     // echo json_encode($res);
    break;
    case 'getAllegatiCheck':
      $data=$_REQUEST;
      $status= checkRend($data['id_RAM']);
      $res =getAllegati($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);

     
      $alleok = getAlleOk($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      $alleno = getAlleNo($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      $countAlle = countAlle($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      $ok = ($alleok + $alleno) == $countAlle??false;
      $json = array(
        'res' => $res,
        'ok' => $ok,
        'rend' => $status['data_chiusura']
      );
      //$tipo = getTipDoc($res['tipo_documento']);
      //var_dump($res);
      if($res){
       
        
        echo json_encode($json); 
      }
       // var_dump($res);
       // var_dump($res);
        
     // echo json_encode($res);
     // echo json_encode($res);
    break;
    
    case 'newAllegatoMag':
      $file=$_FILES['file_allegato'];
      $data=$_POST;
      //var_dump($file);var_dump($data);die;
      //upload file
     $data['docu_nome_file_origine']=$file['name'];
     $id_ram = $data['id_RAM'];
     
     $data['doc_idvei']= 0;
     $id_veicolo = 0;
     $data['tipo_documento'] = $data['tipo_doc_mag'];
     $tipo_documento=$data['tipo_documento'];
     $docu_nome_file_origine =  $file['name'];
     $path_parts = pathinfo($docu_nome_file_origine);
     $docu_id_file_archivio = $id_ram."_".$tipo_documento."_".strtotime("now").".".$path_parts['extension'];
     $data['docu_id_file_archivio']=$docu_id_file_archivio;
     $data['docu_nome_file_origine']=$docu_nome_file_origine;
      move_uploaded_file($file['tmp_name'],$pathAlle.$docu_id_file_archivio);
      if(file_exists($pathAlle.$docu_id_file_archivio)){
        $data['tipo_veicolo']=0;
        $data['progressivo']=0;
       $res= newAllegato($data);

      }
      if($res){
       $res2=getAllegatoID($res);
      }
      
      echo json_encode($res2);
       

    break; 

    case 'delAllegato':
      $id=$_REQUEST['id'];
      //var_dump($id);
      $res=delAllegatoID($id);
      echo json_encode($res);


    break;
    
    case 'getDocVei':
      $data=$_REQUEST['tipovei'];
      $id_RAM = $_REQUEST['id_RAM'];
      //var_dump($data);
      $res = getTipoDocumento($data);
     // var_dump($res);
      /*  if($res){
        $check = array();
          foreach($res as $r){
            $datas['tipo_documento']=$r['codice_tipo_documento'];
            $datas['id_ram']=$id_RAM;
            $datas['tipo_veicolo']=$data;
            $datas['progressivo']=$_REQUEST['progressivo'];

            $res2= checkSelectTipoDoc($datas);
          // var_dump($res2);
            if($res2){
              
              //echo "ok tipo veicolo".$res2['tipo_veicolo'];
              //echo "ok progressivo".$res2['progressivo'];
              //echo "ok tipo_documento".$res2['tipo_documento'];
            // array_push
            }

          }
        }
      */


      echo json_encode($res);

    break  ;

    case 'getTipoDoc':
      $data=$_REQUEST['tipo'];
      $res =getTipDocumento($data);


      echo json_encode($res);
    break;  

    /*case 'getInfoVei':
      $id=$_REQUEST['id'];
      $res =getInfoVei($id);
      echo json_encode($res);


    break;*/  
    case 'getInfoVei': 
      $id=$_REQUEST['id'];
      $res =getInfoVei($id);

      $res['check_rottamazione'] = false;
     
      $c_i = checkIstanza($res['id_RAM']);
     // var_dump($c_i);die;
      $c_iCheck = false;
      if($c_i){
        if(!is_null($c_i['pec'])&&!is_null($c_i['firma'])&&!is_null($c_i['doc'])&&!is_null($c_i['contratto'])&&!is_null($c_i['delega'])&&!is_null($c_i['dim_impresa'])){
            $c_iCheck = true;
        }
      }
      // var_dump($c_i);die;
      $contr= calcolaContributo($res);
      
      if($contr === '{"result":"KO"}'){
        $contr = false;
      }
      //var_dump($contr);
      if(!$contr){
        $res['val_contributo']=0;
       
      }else{
        $res['val_contributo']=$contr[0]['contributo'];
        
      }
     

      $res['check_istruttoria'] = $c_iCheck;

      
      echo json_encode($res);


    break;  

    case 'getAllegato':
      $id=$_REQUEST['id'];
      $res =getAllegatoID($id);
      $tipo = getTipDocumento($res['tipo_documento']);
      $res['tipo_documento']=$tipo[0]['tdoc_descrizione'];
      
      $json = array(
        "allegato" => $res,
        //"test" =>$res
        
      );
      echo json_encode($json);
      //echo json_encode($res);
    break;  

    case 'getInfoCampo':
      $cod=$_REQUEST['cod'];
      $res = getInfoCampo($cod);
      echo json_encode($res);


    break;

    case 'checkDoc':
      $data=$_REQUEST;
      $id_RAM =$data['id_RAM'];
      $tipo_veicolo=$data['tipo_veicolo'];
      $progressivo=$data['progressivo'];
      $res =countDocVeicoloInfo($id_RAM,$tipo_veicolo,$progressivo);
      $res2 = countDocVeicolo($tipo_veicolo);
      $json= array(

        "n"=>$res,
        "of"=>$res2
      );



      echo json_encode($json);
    
    
    
    break;
      
    case 'closeRend':

      $id_ram = $_REQUEST['id_ram'];

      $res = closeRend($id_ram);

      echo json_encode($res);
    break;

    case 'countDocVeicolo':
      $tipo_veicolo = $_REQUEST['tipo_veicolo'];
      $res = countDocVeicolo($tipo_veicolo);
      echo  json_encode($res);
    break;

    case 'getIstanza':
    
      $id = $_REQUEST['id'];
      //var_dump($id);
      $res=getIstanza($id);
      $res['data_nascita']= date("d/m/Y",strtotime($res['data_nascita']));
      $res['luogo_nascita']=$res['luogo_nascita']."(".$res['prov_nascita'].")";

      $res['indirizzo_residenza']= $res['indirizzo_residenza'].", ".$res['civico_residenza'];
      $res['indirizzo_impr']= $res['indirizzo_impr'].", ".$res['civico_impr'];

      $res['comune_residenza']= $res['cap_residenza']." - ".$res['comune_residenza']."(".$res['prov_residenza'].")";
      $res['comune_impr']= $res['cap_impr']." - ".$res['comune_impr']."(".$res['prov_impr'].")";
      $res['tel_impr'] = $res['pref_tel_impr']."/".$res['num_tel_impr'];  
      $tipod=getTipoDich($res['tipo_dichiarante']);
      $res['tipo']=$tipod['descrizione_tipo'];
      $res['cciaa']="Provincia ".$res['cciaa_prov']." <br>Codice ".$res['cciaa_codice']."<br>Data ".date("d/m/Y",strtotime($res['cciaa_data']));
      $res['banca']="Istituto ".$res['banca_istituto']."<br>Agenzia ".$res['banca_agenzia']."<br>IBAN ".$res['iban_it']." ".$res['iban_num_chk']." ".$res['iban_cin']." ".$res['iban_abi']." ".$res['iban_cab']." ".$res['iban_cc'];
      //var_dump($res);
      echo json_encode($res);
      
    break;

    case 'displayHome2': 
      
      $tipi_istanze=getTipiIstanza();
      $json = []; 
      $now =date("Y-m-d H:i:s");
      foreach ($tipi_istanze as $ti){
        $params['search4']='';
        $params['search5']='';
        $params['search3']=intval($ti['id']);
        $totIst= getIstanzeHome($params);
        $totalIstanze =0;
        $istAttive = 0;
        $istAnnullate = 0;
        $istRend = 0;
        $istIstr = 0;
        $istScadute = 0;
        $IstrIntegrazione = 0;
        $IstrPreavviso = 0;
        $IstrAmmessa = 0;
        $IstrRigettata = 0;
        foreach($totIst as $total){
         
          $totalIstanze ++;
          
          if(is_null($total['aperta']) && $ti['data_rendicontazione_fine']>$now){
            $istAttive ++;
          }
          if(!is_null($total['data_annullamento'])){
            $istAnnullate ++;
          }
          if($total['aperta'] == 1 && $ti['data_rendicontazione_fine']>$now && is_null($total['data_chiusura']) && is_null($total['data_annullamento'])){
            $istRend ++;
          }
          
          if($total['aperta'] == 0  && !is_null($total['data_chiusura']) && is_null($total['data_annullamento'])){
            $istIstr ++;
            if($total['tipo_report'] ==1){
              $IstrIntegrazione ++;
            }
            if($total['tipo_report'] ==2){
              $IstrPreavviso ++;
            }
            if($total['tipo_report'] ==3){
              $IstrAmmessa ++;
            }

          }
          if($total['tipo_report'] ==4){
            $IstrRigettata ++;
          }
          if(($total['aperta'] == 1 || is_null($total['aperta'])) && $ti['data_rendicontazione_fine']<$now && is_null($total['data_chiusura']) && is_null($total['data_annullamento'])){
            $istScadute ++;
          }

        }

        $js = array(
          'tipo' => $ti['id'],
          'titolo' => $ti['des'],
          'totali' => $totalIstanze,
          'attive' => $istAttive,
          'annullate' => $istAnnullate,
          'rendicontazione' => $istRend,
          'istruttoria' => $istIstr,
          'scadute' => $istScadute,
          'integrazione' => $IstrIntegrazione,
          'preavviso' => $IstrPreavviso,
          'ammessa' => $IstrAmmessa,
          'rigettata' => $IstrRigettata
        

        );
        array_push($json,$js);

      }
    
      echo json_encode($json);
    
    
    break;

    case 'upIstruttoria':
      $data=$_REQUEST;
      $res =upIstruttoria($data); 
      echo json_encode($res);
    break;

    case 'upAlleAdmin':
      $data=$_REQUEST;

      $res2 = upAlleAdmin($data);
      //var_dump($res2);die;
      $id = $data['id'];
      $v =  getAllegatoID($id);
      //var_dump($v);die;
      $alleok = getAlleOk($v['id_ram'],$v['tipo_veicolo'],$v['progressivo']);
      $alleno = getAlleNo($v['id_ram'],$v['tipo_veicolo'],$v['progressivo']);
      $countAlle = countAlle($v['id_ram'],$v['tipo_veicolo'],$v['progressivo']);
      $vei=getVeicolo($v['id_ram'],$v['tipo_veicolo'],$v['progressivo']);

      //var_dump( $vei);die;
      $res = array(
              'response' => intVal($res2),
              'accettati' =>  intVal($alleok),
              'respinti' => intVal($alleno),
              'totali' => intVal($countAlle),
              'id_veicolo'=> $vei['id'],
              'tipo_documento'=> $v['tipo_documento']
      );
              //var_dump($res);

      //die;
      echo json_encode($res);

    break;
    case 'getRiepilogo':
      $id_RAM = $_REQUEST['idRAM'];

      $veiRiep = getVeicoli($id_RAM);
      $datavei = array();
      $totcosto=0;
      $totcontr =0;
      $totpmi = 0;
      $totrete = 0;
      $tottotale=0;
      $check_rottamazione = false;
      //$check_rottamazione = checkMaggRottamazione($id_RAM);
      foreach($veiRiep as $v){
       
            $tipo = getTipoVeicolo($v['tipo_veicolo']);
            $categ = getCategoria($tipo['codice_categoria_incentivo']);
            if($v['stato_admin'] == 'B'){
             
                $totale = $v['valore_contr'];
                $totcosto += $v['costo_istr'];
                $totcontr  +=  $v['valore_contr'];
                $totpmi +=$v['pmi_istr'];
                $totrete +=$v['rete_istr'];
                $tottotale += $totale;
              }
            //var_dump($v);
            $veicolo = array(
              'stato_admin' =>$v['stato_admin'],
              'categoria' => $categ['ctgi_categoria'],
              'tipologia' =>$tipo['tpvc_descrizione_breve'],
              'prog' => $v['progressivo'],
              'targa' => $v['targa'],
              'costo' => $v['costo_istr'],
              'contributo' => $v['valore_contr'],
              'pmi' => $v['pmi_istr'],
              'rete' =>$v['rete_istr'],
              'totale' =>$v['valore_contr']+$v['pmi_istr']+$v['rete_istr'],
              'note' => $v['note_admin']??'' 
            );
            array_push($datavei,$veicolo); 
      }
      
     
      $json= array(
        'datavei' => $datavei,
        'totcosto' => $totcosto,
        'totcontr'=> $totcontr,
        'totpmi' => $totpmi,
        'totrete' => $totrete,
        'tottotale' => $tottotale,
        'rottamazione' => $check_rottamazione?true:false
      );
     echo json_encode($json);
    break;
    case 'getComunicazioni':
      $id_RAM = $_REQUEST['id_RAM'];
      $stato_istruttoria = getStatusIstruttoria_full($id_RAM);
      $status= checkRend($id_RAM);
     
      if($status){
        if($status['aperta'] == '1'){
          $statusRend = false;
        }else{
          $statusRend = true;
        }
      }else{
        $statusRend = false;
      }
     if(!$stato_istruttoria){
       $stato_istruttoria = 0;
     }
      $check_ammissione = 0;
      
      $veicoli = getVeicoli($id_RAM);
      foreach($veicoli as $v){
        if($v['stato_admin']=='A'||$v['stato_admin']==null){
            $check_ammissione++;
        }
      }
      //var_dump($check_ammissione);
      //var_dump($stato_istruttoria);
      $json = [
        'check_ammissione' =>$check_ammissione,
        'stato_istruttoria'=>$stato_istruttoria,
        'stato_rendicondazione' => $statusRend
      ];
      echo json_encode($json);
    break;
    case 'delReport': 
      $data = $_REQUEST;
      $res= delReport($data['id']);
      $status_istr= getStatusIstruttoria_full($data['id_RAM']);
      $veicoli=getVeicoli($data['id_RAM']);
      $check_ammissione = 0;
      foreach($veicoli as $v){
          if($v['stato_admin']=='A'||$v['stato_admin']==null){
              $check_ammissione++ ;
          }
      }
      $json = array(
        'res' => $res,
        'status' => $status_istr,
        'check'=> $check_ammissione
      );

      echo json_encode($json);
    break;
    case 'getReport': 
        $id = $_REQUEST['id'];
        $res= getReportId($id);
        $res2 = getTipoRep($res['tipo_report']);
        $res['descrizione_rep'] = $res2;
        echo json_encode($res);
    break;
    case 'saveReport':
      $data = $_REQUEST;
      //var_dump($data);die;
      $res = saveReport($data);
      $res2 =getReportId($data['id']);
      
      $res3 = getTipoRep($res2['tipo_report']);
      
      if ($res2['tipo_report'] === 3){
        $dett= array(
          'id_RAM' => $res['id_RAM'],
          'id_report'=> $data['id'],
          'prog'=> '',
          'tipo' => 3,
          'descrizione' => $data['data_verbale']
        );
        $nt = newIntDett($dett);
      }
      
      $res2['descrizione'] = $res3;
      $res2['data_inserimento'] = date("d/m/y H:i", strtotime($res2['data_ins']));
      //var_dump($res2);
      //die;
      echo json_encode($res2);
    break;
    case 'upContributo':
      $id_RAM = $_REQUEST['idRAM'];
      $veiRiep = getVeicoli($id_RAM);
      $datavei = array();
      $tottotale=0;
      $check_rottamazione = false;
      $check_rottamazione = checkMaggRottamazione($id_RAM);
      foreach($veiRiep as $v){
        if($v['stato_admin'] == 'B'){
            $totale = $v['valore_contr']+$v['pmi_istr']+$v['rete_istr'];
            $tottotale += $totale;
        }    
      }
      if($check_rottamazione){
        $tottotale += 2000;
      }
      if($tottotale> 550000){
        $tottotale = 550000;
      }
      $json= array(
        'id_RAM' => $id_RAM,
        'tot_contributo' => $tottotale
      );
      //var_dump($json);
      $up = upContributo($json);
      //var_dump($up);
      echo json_encode($up);

    break; 

    case 'newInt':
      $data = $_REQUEST;
      $res = newInt($data);
      echo json_encode($res);
    break;
    case 'getDocR':
      $id_RAM =$_REQUEST['id_RAM'];
      $veicoli = getVeicoli($id_RAM);
      var_dump($veicoli);
      $arr =array();
      foreach ($veicoli as $v){
        $tipo_veicolo = $v['tipo_veicolo'];
        $progressivo =$v['progressivo'];
        $allegati = getAllegatiR($id_RAM,$tipo_veicolo,$progressivo);
        var_dump($allegati);
        foreach ($allegati as $a){
          $a['id_RAM']= $a['id_ram'];
         // var_dump($a);die; 
          $res=getInfoVeiData($a);       
            $a['tipo_documento'] = getTipDoc($a['tipo_documento']);           
            $a['targa']=$res['targa'];
            array_push($arr,$a);
          }
        }
      echo json_encode($arr);
    break;
    case 'getTipoInt':
      $id=$_REQUEST['tipo'];
      $res =getTipoInt($id);

      
      
      echo json_encode($res);
    
      break;

    case 'newIntDett': 
      $data = $_REQUEST;
      $res = newIntDett($data);
      echo json_encode($res);

      break;
    case 'checkCert':
      $data = $_REQUEST;
      $res = checkIstanza($data['id_ram']);
      //var_dump($res);
      if($res){
        $tipo = $data['tipo'];
        $note =  $res['note_'.$tipo]?$res['note_'.$tipo]:'';
        $sel = $res[$tipo];
        if(is_null($sel)){
          $select = "A";
        }
        if($sel==1){
          $select = "B";
        }
        if($sel=='0'){
          $select = "C";
        }
        $json = array(
          "note" => $note,
          "select" => $select
        );
      }else{
        $json = array(
          "note" => '',
          "select" => ''
        );
      }
      
      echo json_encode($json);
      break;
      case 'upCert':
        $data = $_REQUEST;
        $findInstanza = findCheckIstanza($data['id_ram']);
       
        $find = $findInstanza?$findInstanza:0;
          if($find){
            $res= upCert($data);
            
          }else{
            $istanza = getIstanza($data['id_ram']);
          
            $res = newCheckIstanzaB($data['id_ram']);
          }
         
        $res= upCert($data);
        
        
          $c = getcheckIstanza($data);
        
          $n = $c['note_'.$data['tipo']];
          $tipo = $c[$data['tipo']];
          //var_dump($tipo);die;
          $stato_tipo='';
          if(is_null($tipo)){
            $stato_tipo ='<span class="badge badge-warning" >In Lavorazione</span>';
          }
          if ($tipo==1){
            $stato_tipo ='<span class="badge badge-success" >Accettato</span>';
          }
          if($tipo =='0'){
            $stato_tipo ='<span class="badge badge-danger" >Respinto</span>';
          }
          $json = array(
  
            "note"=> $n,
            "stato_tipo"=>$stato_tipo,
            "tipo"=> $data['tipo']
          );
          echo json_encode($json);
        
       
        break;  
   }