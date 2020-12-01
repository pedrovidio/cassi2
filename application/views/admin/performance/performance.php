<div class="filter">
  <select id="date" onchange="filterDate()">
    <option value="1">01</option>
    <option value="2">02</option>
    <option value="3">03</option>
    <option value="4">04</option>
    <option value="5">05</option>
    <option value="6">06</option>
    <option value="7">07</option>
    <option value="8">08</option>
    <option value="9">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>

  <a href="<?php echo base_url('dashboard')?>">
    <button id="clean" type="button">Limpar filtro</button>
  </a>
</div>
<div id="dash">
  <div id="finish">
    <h1>Finalizados</h1>
    <table id="tabela" class="table table-hover">
      <thead>
        <tr>
          <th>Data</th>
          <th>Operador 01</th>
          <th>Operador 02</th>
          <th>Operador 03</th>
          <th>Operador 04</th>
          <th>Operador 05</th>
          <th>Operador 06</th>
          <th>Operador 07</th>
          <th>Operador 08</th>
          <th>Operador 09</th>
          <!-- <th>Operador 10</th> -->
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($finalized as $key => $dates){
            echo "<tr>";
            foreach($dates as $id => $values){
              if($id === 0){
                $mes = explode('/', $values);
              }else{
                $sum[$id][] = $values;
              }
              echo "<td class='".$mes[1]."'>$values</td>";

            }
            echo "</tr>";
          }
          echo "<tr><td>Total</td>";
          foreach($sum as $id => $num)
          {
            $total = array_sum($num);
            echo "<td>$total</td>";
          }
          echo "</tr>";
        ?>
      </tbody>
    </table>
  </div>
  <div id="day">
    <h1>Ligações Efetuadas</h1>
    <table id="tabela" class="table table-hover">
      <thead>
      <tr>
          <th>Data</th>
          <th>Operador 01</th>
          <th>Operador 02</th>
          <th>Operador 03</th>
          <th>Operador 04</th>
          <th>Operador 05</th>
          <th>Operador 06</th>
          <th>Operador 07</th>
          <th>Operador 08</th>
          <th>Operador 09</th>
          <!-- <th>Operador 10</th> -->
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
      <?php
          foreach($made as $key => $dates){
            echo "<tr>";
            foreach($dates as $id => $values){
              if($id === 0){
                $mes = explode('/', $values);
              }else{
                $suMade[$id][] = $values;
              }
              echo "<td class='".$mes[1]."'>$values</td>";

            }
            echo "</tr>";
          }
          echo "<tr><td>Total</td>";
          foreach($suMade as $id => $num)
          {
            $total = array_sum($num);
            echo "<td>$total</td>";
          }
          echo "</tr>";
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  function filterDate(){
    const months = [01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12];
    const mes = document.getElementById('date').value;

    months.map(function(month) {
      if(month < mes ){

        let classe = month.toString();

        if(month < 10){
          classe = "0" + classe;
        }

        if(document.getElementsByClassName(classe)){
          const aux = document.getElementsByClassName(classe);
          for (let i = 0; i < aux.length; i++) {
            aux[i].style.display = "none";
          }
        }
      }
    });

  }
</script>