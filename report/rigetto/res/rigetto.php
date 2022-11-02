<page pagegroup="new"  style="font-size:14px" backtop="55mm" backleft="15mm" backright="15mm" backbottom="9mm">
	
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
    
    <page_header> 
        <table width="75%" style="margin:30px;text-align:left;">
        <tr><td style="text-align:center;"><img style="width:300px;display:inline;"  src="../../images/intest_new.png"></td></tr>
        <tr><td style="text-align:center;font-weight:bold;">Dipartimento per la Mobilità Sostenibile</td></tr>
        <tr style="max-width:250px;font-weight:bold;"><td style="text-align:center;">Commissione per la valutazione degli investimenti</td></tr>
        <tr style="max-width:250px;font-weight:bold;"><td style="text-align:center;">per il rinnovo del parco veicolare da cui al Dl 355/2020</td></tr>
        <tr style="max-width:250px;font-weight:bold;"><td style="text-align:center;"> di cui al D.I. 355/2020</td></tr>
        

        </table>
        
	</page_header>

    

    
    <table style="margin-top:45px;">
    <tr><td>Roma li,</td><td><?=date("d/m/Y",strtotime($rep['data_ins']))?></td></tr>
        <tr><td>Prot n°</td><td  style="font-weight:bold;"> <?=$rep['prot_RAM'] !== '00'?$rep['prot_RMA']:'' ?></td></tr></table>
        
    <table style="margin-left:400px;">
        <tr><td>All'impresa</td><td ></td><td></td></tr>
        <tr><td colspan="2" style="width:50mm;justify-content:left;font-weight:bold;"><?=$user['ragione_sociale']?></td></tr>
        <tr><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['indirizzo_impr']?>, <?=$user['civico_impr']?></td></tr>
        <tr><td colspan="2" style="width:50mm;justify-content:left;"><?=$user['cap_impr']?> - <?=$user['comune_impr']?> (<?=$user['prov_impr']?>)</td></tr>
        
    </table>
    <table>
        <tr><td style="text-align:right;">Raccomandata via pec all&#39;indirizzo: </td><td  style="font-weight:bold;"> <?=$user['pec_impr']?></td></tr>
    </table>
     <table style="width:70%;margin-right:50mm">
        <tr><td style="font-weight:bold;text-align:justify;vertical-align:top;">Oggetto:</td>
        <td style="width:150mm;font-weight:bold;text-align:justify;">Contributi ai sensi del D.D. 21 ottobre 2020 n.187 per le finalità di cui al D.I.
                                                                        14 agosto 2020 n. 355 - &quot;Incentivi per il rinnovo del parco veicolare.<br>
Protocollo Istanza Rpv <?=$user['id_RAM']?>/<?=$tipo_istanza['anno']?> Informativa ai sensi dell'art.10-bis legge 241/90</td>
</tr>

    </table>
    <table>
        <tr><td style="text-align:justify;">In riferimento alla domanda di ammissione agli incentivi di cui al D.I.
                                                                        14 agosto 2020 n. 355 acquisita in data <?=date("d/m/Y", strtotime($data_RAM['data_invio']))?> con prot. n.<?=$user['id_RAM']?>/<?=$tipo_istanza['anno']?> si comunica che, sulla base delle risultanze
        dell'istruttoria effettuata dalla società RAM S.p.A e della valutazione di questa Commissione, l'istanza di ammissione al finanziamento degli investimenti di cui all'art. 1 del D.I.
        14 agosto 2020 n.355, destinato alle imprese di autotrasporti merci, è risultata</td></tr>
    </table>
    <h5 style="text-align:center">INAMMISSIBILE</h5>
    <table style="margin-left:25px;">
                    <tr><td >Per la/le seguente/i motivazione/i:</td></tr>
    </table>                
    <div class="row"style="max-height:250px;margin-top:20px;">               
    <table>
        <?php
        //var_dump($dettagli);
        foreach($dettagli as $d){?>
        <tr><td style="text-align:justify;">-  <?=$d['descrizione']?></td></tr>
       <?php } ?>     
    </table>                   
    </div> 
    <div>
    <table >
        <tr><td style="text-align:justify;">Si comunica che, ai sensi dell'art. 10-bis, comma 1, della legge n. 241/1990, l'impresa in indirizzo ha tempo 10 giorni dalla 
        ricezione della presente per produrre per iscritto le proprie eventuali osservazioni, corredate se del caso, da idonea documentazione che  
        <u style="font-weight:bold;">dovrà essere inviata alla RAM S.p.A., esclusivamente presso il seguente indirizzo di posta elettronica certificata: ram.rinnovoparcoveicolare@pec.it</u></td></tr>               
    </table>
    <table style="margin-left:400px;margin-top:20px;text-align:center;">
        <tr><td>Il Presidente</td></tr>
        <tr><td>(Dott.ssa Monica Macioce)</td></tr>

    </table>
</div>    
</page>
