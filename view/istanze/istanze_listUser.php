

<div class="row">
  <div class="col-8 ">
    <!--start card-->
    <div class="card-wrapper">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Le mie Istanze</h3>
          <p class="card-text">pec impresa: <?=$_SESSION['userData']['email']?></p>

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">id RAM</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Data invio xml</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($istanze as $i){?>
                    <tr>
                    <td>2020/<?=$i['id_RAM']?></td>
                    <td>Investimenti 2020</td>
                    <td><span class="badge badge-success">Evasa</span>
                    <br><span class="badge badge-success">In Rendicontazione</span>
                    <br><span class="badge badge-success">In Istruttoria</span>
                    </td>
                    <td><?=date("d/m/Y", strtotime($i['data_agg']))?></td>
                    <td>
                        <div  class="btn-group btn-group-sm" role="group">
                        <a type="button" href="istanza.php"class="btn btn-primary" style="color:white;"> Accedi a Istanza</a>
                        </div>
                    </td>
                    </tr>
                 <?php
                    }
                    ?>   
                </tbody>
            </table>
        </div>
      </div>
    </div>
    <!--end card-->
  </div>
</div>