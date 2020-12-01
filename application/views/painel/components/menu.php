<div id="menu" style="display: flex; justify-content: space-between">
  <img src="<?php echo base_url('assets/img/logo.png')?>" alt="logo opiniao" width="50" >
  <div>
    <a href="<?php echo base_url('painel')?>"><button>Disponíveis</button></a>  
    <a href="<?php echo base_url('painel/lists/agendados')?>"><button>Agendados</button></a>
    <a href="<?php echo base_url('painel/lists/agendadosTodos')?>"><button>Agendados Todos</button></a>
    <a href="<?php echo base_url('painel/lists/andamento')?>"><button>Parcialmente preenchidos</button></a>
    <a href="<?php echo base_url('painel/lists/finalizados')?>"><button>Finalizados</button></a>
  </div>
  <div>
    <span><?php echo $oper;?></span>
    <a href="<?php echo base_url('login/logout')?>"><button>Sair</button></a>
  </div>
</div>