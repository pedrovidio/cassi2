<div id="menu-cati" style="display: flex; justify-content: space-between">
  <img src="<?php echo base_url('assets/img/logo.png')?>" alt="logo opiniao" width="50" >
  <div id="menuBt">
    <a href="<?php echo base_url('painel')?>"><button class="bt-cati">Disponíveis nunca contatados</button></a>  
    <a href="<?php echo base_url('painel/lists/contatados')?>"><button class="bt-cati">Disponíveis - já contatados</button></a>
    <a href="<?php echo base_url('painel/lists/agendados')?>"><button class="bt-cati">Agendados</button></a>
    <a href="<?php echo base_url('painel/lists/agendadosTodos')?>"><button class="bt-cati">Agendados Todos</button></a>
    <a href="<?php echo base_url('painel/lists/andamento')?>"><button class="bt-cati">Parcialmente preenchidos</button></a>
    <a href="<?php echo base_url('painel/lists/finalizados')?>"><button class="bt-cati">Finalizados</button></a>
  </div>
  <div>
    <span><?php echo $oper;?></span>
    <a href="<?php echo base_url('login/logout')?>"><button class="bt-cati">Sair</button></a>
  </div>
</div>