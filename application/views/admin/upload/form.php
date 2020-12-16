<div id="formBody">
  <div class="upload-form">
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
        <button type="submit">Enviar arquivo</button>
      </div>
    </form>
  </div>
</div>