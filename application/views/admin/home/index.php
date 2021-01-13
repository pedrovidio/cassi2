<?php if(!empty($msg)){ echo "<div class='alert alert-$class'>$msg</div>";} ?>
<div id="formBody" class="blocks">
  <div class="infos">
    <a href="<?php echo base_url('lists/respondentes/todos')?>">
    <div class="card card-1">
      <strong>Total de respondentes importados</strong>  
      <h1><?php echo $total?></h1>
    </div>
    </a>
    <a href="<?php echo base_url('lists/respondentes/disponiveis')?>">
    <div class="card card-2">
      <strong>Total de respondentes nunca contatados</strong>  
      <h1><?php echo $totalDisponiveis?></h1>
    </div>
    </a>
    <div></div>

    <a href="<?php echo base_url('lists/respondentes/agendados')?>">
    <div class="card card-3">
      <strong>Total de respondentes agendados</strong>  
      <h1><?php echo $totalAgendados?></h1>
    </div>
    </a>
    <a href="<?php echo base_url('lists/respondentes/finalizados')?>">
    <div class="card card-4">
      <strong>Total de entrevistas finalizadas</strong>  
      <h1><?php echo $totalFinalizados?></h1>
    </div>
    </a>
    <div></div>

    <a href="<?php echo base_url('historico')?>">
    <div class="card card-5">
      <strong>Histórico dos atendimentos</strong>
      <img style="border-radius: 25px" src="<?php echo base_url('assets/img/hist.png')?>" width="50" alt="">
    </div>
    </a>
    <a href="<?php echo base_url('dashboard')?>">
    <div class="card card-4">
    <strong>Acompanhamento por operadores</strong>
      <img style="border-radius: 25px" src="<?php echo base_url('assets/img/team.png')?>" width="50" alt="">
    </div>
    </a>
    <a target="_blank" href="https://projetos.sphinxnaweb.com/opiniao/cassipesquisa_2020/admin.htm?user=admin&pwd=admin">
      <div class="card card-6">
        <strong>Acesse aqui os resultados</strong>
        <img src="<?php echo base_url('assets/img/graph.png')?>" width="50" alt="">
      </div>
    </a>
  </div>
</div>
