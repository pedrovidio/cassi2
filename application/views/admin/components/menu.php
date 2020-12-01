<div id="menu" style="display: flex; justify-content: space-between">
  <a href="<?= base_url('home/index')?>">
    <img src="<?= base_url('assets/img/logo.png')?>" alt="logo opiniao" width="50" >
  </a>
  <div>
      <a href="<?= base_url('home')?>"><button>Home</button></a>
      <a href="<?= base_url('operadores')?>">
        <button>Operadores - <?= $this->session->userdata('qtdOpers')?></button>
      </a>
      <a href="<?= base_url('distribuir')?>"><button>Distribuir contatos</button></a>
      <a href="<?= base_url('importar')?>"><button>Importação</button></a>
      <a href="<?= base_url('cotas')?>"><button>Cotas</button></a>
  </div>
  <div>
      <span><?= $this->session->userdata('usuario')?></span>
      <a href="<?= base_url('login/logout')?>"><button>Sair</button></a>
  </div>
</div>
