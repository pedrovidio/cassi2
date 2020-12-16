<div id="menu-cati" style="display: flex; justify-content: space-between">
  <a href="<?= base_url('home/index')?>">
    <img src="<?= base_url('assets/img/logo.png')?>" alt="logo opiniao" width="50" >
  </a>
  <div>
    <a href="<?= base_url('home')?>"><button class="bt-cati">Home</button></a>
    <a href="<?= base_url('operadores')?>">
      <button class="bt-cati">Operadores - <?= $this->session->userdata('qtdOpers')?></button>
    </a>
    <a href="<?= base_url('importar')?>"><button class="bt-cati">Importação</button></a>
    <a href="<?= base_url('cotas')?>"><button class="bt-cati">Cotas</button></a>
  </div>
  <div>
    <span><?= $this->session->userdata('usuario')?></span>
    <a href="<?= base_url('login/logout')?>"><button class="bt-cati">Sair</button></a>
  </div>
</div>
