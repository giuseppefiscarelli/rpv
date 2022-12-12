<page pagegroup="new"  style="font-size:12px" backtop="mm" backleft="15mm" backright="15mm" backbottom="9mm">
	
<style>
	.testoParagrafo {
		text-align:justify;	
        font-weight: bold;
	}
    .smallBox {
    	border:1px solid #333;
    	height:3mm; 
    	width:3mm; 
    	display:inline;
    }
</style>
<style>

.tab{
    border: 1px solid black;
  border-collapse: collapse;
}
 .bordered-bottom {
    	border-bottom: 1px dashed black;	
    }
    .separator {
    	border-top:1px solid #333;
    }
    .box {
    	border:1px solid #333;
    	height:5mm; 
    	width:5mm; 
    	display:inline;
    }
    .priv{
        text-align: justify;
        font-size:8px;

    }
	</style>
<style type="text/css">

    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {
					width: 91%;
					text-align:"center";
					border: none; 
					border-top: solid 1mm black; 
					padding: 1mm; 
					margin-left :10mm;
					}
    div.note {border: solid 1mm #DDDDDD;background-color: #EEEEEE; padding: 2mm; border-radius: 2mm; width: 100%; }
    ul { width: 95%; list-style-type: square; }
    ul li { padding-bottom: 2mm; }
    h1 { text-align: center; font-size: 20mm}
	
  

</style>
    

<table style="width:50%;">
        <tr><td style="text-align:center;"><img style="width:300px;display:inline;"  src="../../images/int_amm.png"></td></tr>
        

        </table>
        
	

    <table>
    <tr><td>Roma li,</td><td><?=$data_prot?></td></tr>
    <tr><td>Prot n°</td><td  style="font-weight:bold;"> <?=$rep['prot_RAM']?></td></tr>

    </table>

    <table style="margin-left:400px;">
        <tr><td>Spett.le</td><td ></td><td></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;font-weight:bold;"><?=$user['ragione_sociale']?></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['indirizzo_impr']?>, <?=$user['civico_impr']?></td></tr>
        <tr><td></td><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['cap_impr']?> - <?=$user['comune_impr']?> (<?=$user['prov_impr']?>)</td></tr>
        
    </table>
    <table style="margin-top:60px;">
      
        <tr><td style="text-align:right;">Raccomandata via pec all&#39;indirizzo: </td><td  style="font-weight:bold;"> <?=$data_RAM['pec_impr']?></td></tr>
    </table>
    <table style="width:70%;margin-right:50mm">
        <tr><td style="font-weight:bold;text-align:justify;vertical-align:top;">Oggetto:</td>
        <td style="width:150mm;font-weight:bold;text-align:justify;"> 
        Contributi ai sensi del D.D. 21 ottobre 2020 n.187 per le finalità di cui al D.I.
        14 agosto 2020 n. 355 - &quot;Incentivi agli investimenti nel settore dell&#39;autotrasporto&quot;.<br>
        Protocollo Istanza Rpv <?=$rep['id_RAM']?>/<?=$tipo_istanza['anno']?> Informativa ai sensi dell'art.10-bis legge 241/90</td>
</tr>

    </table>
    <h5 style="text-align:center">IL DIRETTORE GENERALE</h5>
   
    
    <table>
      
      
        <tr><td style="text-align:justify;">- VISTA la domanda di ammissione al contributo di cui all'oggeto presentata da Codesta impresa e acquisista con protocollo n <?=$rep['id_RAM']?>/<?=$tipo_istanza['anno']?> del <?=date("d/m/Y", strtotime($data_RAM['data_invio']))?>;</td></tr>
        <tr><td style="text-align:justify;">- VISTO il verbale di riunione della Commissione, istituita ai sensi dell'art. 12, comma 3, del D.I. 14 agosto 2020 n.355 , tenutasi il giorno <?=$data_verb?>;</td></tr>
                    
    
    
    </table>
    <table>
        <tr><td style="text-align:justify;">fermo restando la permanenza dei requisiti di ammissibilità richiesti dalla normativa vigente, dispone per l'istanza di finanziamento presenteta da Codesta impresa la relativa</td></tr>
    </table>
    <h5 style="text-align:center">AMMISSIONE</h5>
    <table>
        <tr><td style="text-align:justify;">per gli importi di seguito ripartiti secondo le categorie e sottocategorie di investimento di cui agli artt. 1 e 2 D.I. 14 agosto 2020 n. 355:</td></tr>
    </table>


    <table style="border-collapse: collapse;border: 1px solid black;font-size:11px;padding:3px;">
       <tr style="text-align:center;border: 1px solid black;">
        <th style="width:35mm; border: 1px solid black;">Categoria Investimenti</th>
        <th style="width:35mm; border: 1px solid black;">Sotto-Categoria Investimenti</th>
        <th style="width:22mm; border: 1px solid black;">Numero acquisizioni finanziabili</th>
       
        <th style="width:25mm; border: 1px solid black;">Importo Totale Contributo (€)</th>

       </tr>

  
    


       <tr >
        <td style=" border: 1px solid black;padding:3px;" rowspan=4>Art.2, comma 5, lett a) </td>
        <td style=" border: 1px solid black;padding:3px;">CNG o IBRIDA di massa complessiva pari o superiore a  3,5  e inferiore a  7 t.</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5A1?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5A1, 2, ',', '.').' €' ?></td>
       </tr>

       <tr > 
        <td style=" border: 1px solid black;padding:3px;">CNG o IBRIDA di massa complessiva da 7 e inferiore a 16 t.</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5A2?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5A2, 2, ',', '.').' €' ?></td>
       </tr>

       <tr >   
        <td style=" border: 1px solid black;padding:3px;">ELETTRICA di massa complessiva pari o superiore a  3,5  e inferiore a  16 t.</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5A3?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5A3, 2, ',', '.').' €' ?></td>
       </tr>
       
       <tr >         
       <td style=" border: 1px solid black;padding:3px;">CNG o LNG di massa complessiva pari o superiore a 16 t.</td>
       <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5A4?></td>
       <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5A4, 2, ',', '.').' €' ?></td>
      </tr>
      <tr >
        <td style=" border: 1px solid black;padding:3px;" rowspan=3>Art.2, comma 5, lett a) </td>
        <td style=" border: 1px solid black;padding:3px;">EURO VI o EURO VI D Temp con massa complessiva da 3,5 e inferiore a 7 t.</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5B1?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5B1, 2, ',', '.').' €' ?></td>
       </tr>

       <tr > 
        <td style=" border: 1px solid black;padding:3px;">EURO VI  con massa complessiva da 7 e inferiore a 16 t.</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5B2?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5B2, 2, ',', '.').' €' ?></td>
       </tr>

       <tr >   
        <td style=" border: 1px solid black;padding:3px;">EURO VI di massa complessiva pari o superiore a 16 t.</td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=$qnt5B3?></td>
        <td style="text-align:right; border: 1px solid black;padding:3px;"><?=number_format($tot5B3, 2, ',', '.').' €' ?></td>
       </tr>
       
      
       
      


<tr>
     
        <td style=" border: 1px solid black;padding:3px;text-align:right;"colspan="3" >Totale Contributo(€)</td>
        
        <td style="text-align:right; border: 1px solid black;;padding:3px;font-weight:bold;"><?=number_format($totFin, 2, ',', '.').' €' ?></td>
       </tr>
      
             
    </table>
    <?php if($totFin > 550000){?>
    <table>
        <tr><td style="text-align:justify;">come stabilito dall'art 1 comma 7 del D.I. 14 agosto 2020 n. 355, qualora il valore del contributo superi l'importo massimo
ammissibile, questo <b>viene ridotto fino al raggiungimento della soglia ammessa di € 550.000,00</b></td></tr>
    </table>
    <?php } ?>
    </page>
    <page pagegroup="new"  style="font-size:14px" backtop="10mm" backleft="15mm" backright="15mm" backbottom="9mm">
    <p style="text-align:justify;">Si comunica altresì che, ai sensi dell’art. 3, comma 4, della legge 7 agosto 1990 n. 241, avverso il presente atto è
    ammesso ricorso giurisdizionale avanti al competente Tribunale Amministrativo Regionale oppure, in alternativa, ricorso
    straordinario al Presidente della Repubblica, rispettivamente entro sessanta e centoventi giorni dal ricevimento dello
    stesso
    </p>
    <p style="text-align:justify;"><b>AVVERTENZE:</b>
    <br>
    Si ricorda che a norma dell’<b>Art. 2 co. 7 del D.I. 355/2020 i mezzi oggetti di contributo non possono essere alienati,
concessi in locazione o in noleggio e devono rimanere nella piena disponibilità del beneficiario</b> del contributo fino a tutto
il <b>31 dicembre 2023</b>, pena la revoca del contributo erogato. Non si procede all'erogazione del contributo anche nel
caso di trasferimento della disponibilità dei beni oggetto degli incentivi nel periodo intercorrente fra la data di
presentazione della domanda e la data di pagamento del beneficio.
    </p>
    <p style="text-align:justify;">
    Ai fini della liquidazione del contributo spettante, compatibilmente con la disponibilità di cassa e ad esito favorevole
degli accertamenti di legge, dovrà pervenire - <b>nel termine perentorio di 5 (cinque) giorni dal ricevimento della
presente - l’eventuale nuovo IBAN (soltanto in caso di variazione rispetto a quello dichiarato in sede di istanza).</b>
    </p>
    <p style="text-align:justify;">
    <b>Soltanto in caso di contributo spettante di importo superiore ad euro 150.000,00</b> – essendo necessario acquisire
l’informazione antimafia ai sensi del decreto legislativo n. 159/2011 e successive ii e mm – dovrà essere allegata, entro
15 (quindici) giorni lavorativi dal ricevimento della presente:
<ul>
    <li>l’attestazione dell’iscrizione nella “white list”, prevista dalla legge n. 190/2012 e dal D.P.C.M. del 18 aprile 2013;</li>
    <li>oppure, in mancanza dell’iscrizione di cui sopra, dovrà essere trasmessa da codesta Impresa, la dichiarazione sostitutiva
resa da ognuno dei soggetti di cui all’articolo 85 del decreto legislativo n. 159/2011, recante l’indicazione dei propri
conviventi di maggiore età (con i dati anagrafici e i relativi codici fiscali degli stessi), corredata da copia di un
documento di identità, in corso di validità, del sottoscrittore (vedi modello allegato).</li>
</ul>
    </p>
    <p style="text-align:justify;">
    L’eventuale documentazione di cui sopra dovrà essere trasmessa in <b>un unico file PDF (comprensivo del documento di
identità del legale rappresentante dell’impresa)</b>, tramite posta elettronica certificata all’indirizzo <b>dg.ts-div1@pec.mit.gov.it</b>
    </p>
    <p style="text-align:justify;">
    Per qualsiasi informazione, è a disposizione il servizio Help Desk Incentivi (e-mail: <b>ricambioveicolare@ramspa.it</b>)
    </p>
    

   
    <table style="margin-left:350px;margin-top:10px;">
   
    <tr><td style="font-style:italic;"><img style="width:220px;display:inline;"  src="../../images/firma_disanto.png"></td></tr>
   
    </table>
    </page>