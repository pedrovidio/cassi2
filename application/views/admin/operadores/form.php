<div id="formBody">
  <div class="add-oper-form">
    <form enctype="multipart/form-data" method="post" action="<?php echo base_url('admin/operadores/add') ?>">
      <div class="input-form-oper">
        <label>Nome do operador: </label>
        <input type="text" name="user" value="<?= $user = ($oper)? $oper['user'] : "" ;?>">
        
        <label>Senha: </label>
        <input type="password" name="password" value="<?= $password = ($oper)? $oper['password'] : "" ;?>">
      </div>
      <input type="hidden" name="id" value="<?= $password = ($oper)? $oper['id'] : "" ;?>">
      <button type="submit">Salvar</button>
    </form>
  </div>
</div>