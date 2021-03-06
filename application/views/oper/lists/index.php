<div class="content">
  <div class="data-table">
    <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Data</th>
        <th>Hora</th>
        <th>Status da última ligação</th>
        <th>Operador</th>
        <?= $iniciar = (!empty($list) && $list === "finalizados")? "" : "<th>Iniciar</th>" ?>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach($contacts as $key => $val){
          echo "
          <tr class='linha'>
            <td>".$val['id']."</td>
            <td>".$val['nome']."</td>
            <td>".implode('/',array_reverse(explode('-',$val['dia'])))."</td>
            <td>".$val['hora']."</td>
            <td>".$val['statusLigacao']."</td>
            <td>".$val['operador']."</td>";
            if(!empty($list) && $list === "finalizados"){
              echo "";
            }else{
              echo "
            <td>
              <a href='".base_url('oper/approach/form\/').$val['id']."'>
                <button>Acessar</button>
              </a>
            </td>
            ";
            }
            
          echo "<tr>
          ";
        }
      ?>
    </tbody>
    </table>
  </div>
</div>