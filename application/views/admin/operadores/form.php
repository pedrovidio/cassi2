<div id="formBody">
  <form enctype="multipart/form-data" method="post" action="<?php echo base_url('admin/operadores/add') ?>">
    <div class="input-form-oper">
      <strong>Nome do operador: </strong><input type="text" name="user" value="<?= $user = ($oper)? $oper['user'] : "" ;?>">
      <strong>Senha: </strong><input type="password" name="password" value="<?= $password = ($oper)? $oper['password'] : "" ;?>">
    </div>
    <input type="hidden" name="id" value="<?= $password = ($oper)? $oper['id'] : "" ;?>">
    <button class="btn btn-success" type="submit">Salvar</button>
  </form>
</div>