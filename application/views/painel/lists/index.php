<div id="list-painel">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Beneficiário</th>
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
          <tr>
            <td>".$val['beneficiario']."</td>
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