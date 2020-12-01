<div id="formBody">
  <form enctype="multipart/form-data" method="post" action="<?php echo base_url('importar/upload') ?>">
    <div>
      <div style="margin-bottom: 10px">
        <label style="width:50px">Ação:</label>
        <select id="tipo" name="tipo" required>
          <option value=""></option>
          <option value="cadastrar">Cadastrar</option>
          <option value="atualizar">Atualizar</option>
        </select>
      </div>
    </div>
    <div>
      <div>
        <label>Selecione o arquivo:</label>
        <input name="userfile" type="file" />
      </div>
      <div>
        <input type="submit" class="btn btn-success" value="Enviar arquivo">
      </div>
    </div>
  </form>
  <?php if($msg){echo "<div id='msg_import'>$msg</div>";}?>
</div>