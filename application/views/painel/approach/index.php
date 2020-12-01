<div id="formBody">
  <div id="contact-details">
    <div id='details'>
      <div><strong>Beneficiário:</strong> <?= $contact['beneficiario']?></div>
      <div><strong>Nome:</strong> <?= $contact['nome']?></div>
      <div><strong>Celular:</strong> <?= "(".$contact['dddcelular'].") ".$contact['celular']?></div>
      <div><strong>Telefone1:</strong> <?= "(".$contact['dddtelefone1'].") ".$contact['telefone1']?></div>
      <div><strong>Telefone2:</strong> <?= "(".$contact['dddtelefone2'].") ".$contact['telefone2']?></div>
      <div><strong>Público:</strong> <?= $contact['publico']?></div>
      <div><strong>UF:</strong> <?= $contact['uf']?></div>
      <div><strong>Sexo:</strong> <?= $contact['sexo']?></div>
    </div>
  </div>

  <div id="formContact">
    <form method="post" action="<?= base_url('oper/approach/getForm')?>">
      <div>
        <p>
          A1. Bom dia!/Boa tarde!/Boa noite!. 
          Por gentileza, eu poderia falar com o(a) Sr(a) <?= $contact['nome']?>?
        </p>
      </div>
      <div>
        <p>Meu nome é <strong><?= $contact['operador']?></strong> sou pesquisador(a) da Opinião, 
        empresa que realiza pesquisas em todo o Brasil. 
        Em nome da CASSI, estamos realizando uma pesquisa de opinião para avaliar os produtos e 
        serviços oferecidos pela Instituição. Nossa entrevista tem duração de aproximadamente 
        10 minutos. Você poderia colaborar respondendo algumas perguntas?</p>
        <p>Para selecionar os entrevistados, fizemos um sorteio aleatório, 
          a partir do banco de dados fornecido pela Sistel, 
          e foi desta maneira que chegamos (ao)à Sr(a)..</p>
        <p>
          <button type="button" class="btsim" id="bt1" onclick="condition('sim')">Sim</button>
          <button type="button" class="btnao" id="bt2" onclick="condition('nao')">Não</button>
          <input type="hidden" name="filtro1" id="filtro1">
        </p>
        <p id="categoria_nao">
        Suas respostas são sigilosas e em nenhum momento sua identidade será revelada, respeitando o código de ética que rege o exercício da atividade de pesquisa, para sua segurança está entrevista será gravada e o código da entrevista é <strong><?= $contact['beneficiario']?></strong>.
        </p>
      </div>
      <div class="quest-hidden" id="quest-hidden">
        <p>A2. Caso o (a) Sr(a) esteja atarefado(a) neste momento, poderíamos entrar em contato em um outro horário, se preferir, em outro telefone? Sua participação é muito importante para nós!
</p>
        <p>STATUS da ligação:</p>
        <select name="statusLigacao" id="statusLigacao" onchange="condition2(this.value)">
          <option value=""></option>
          <option value="Agendado com dia e hora certo">Agendado com dia e hora certo</option>
          <option value="Caixa postal/Fax/ Secretária Eletrônica">Caixa postal/Fax/ Secretária Eletrônica</option>
          <option value="Ligação caiu/ Não atende mais">Ligação caiu/ Não atende mais</option>
          <option value="Ligar depois">Ligar depois</option>
          <option value="Não atende">Não atende</option>
          <option value="Pessoa falecida">Pessoa falecida</option>
          <option value="Pessoa incapaz de responder">Pessoa incapaz de responder</option>
          <option value="Recusa">Recusa</option>
          <option value="Recusa por terceiro (não quis passar o telefone p/ pessoa responsável)">Recusa por terceiro (não quis passar o telefone p/ pessoa responsável)</option>
          <option value="Responsável menor de idade">Responsável menor de idade</option>
          <option value="Telefone errado">Telefone errado</option>
          <option value="Telefone indisponível ou fora de serviço">Telefone indisponível ou fora de serviço</option>
          <option value="Telefone inexistente (número não completa chamada)">Telefone inexistente (número não completa chamada)</option>
          <option value="Telefone ocupado">Telefone ocupado</option>
          <option value="Telefone mudo">Telefone mudo</option>
          <option value="Sem telefone para contato">Sem telefone para contato</option>
          <option value="Contato duplicado">Contato duplicado</option>
        </select>
      </div>
      <div class="quest-hidden-a3" id="quest-hidden-a3">
        <p>
          A3. Agendar:
        </p>
        Dia: <input type="date" name="dia" id="dia" onchange="condition3()">
        Hora: <input type="time" name="hora" id="hora" onchange="condition3()">
      </div>
    <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
    <input type="hidden" name="cotas_id" value="<?php echo $contact['cotas_id']; ?>">
    <input id="quest-hidden-submit" class="quest-hidden-submit" type="submit" class="btsuccess" value="Avançar">
    </form>
  </div>
</div>

<script>
  function condition(val){
    if(val === 'sim')
    {
      var x = document.getElementById("quest-hidden");
      x.style.display = "none";

      var x = document.getElementById("categoria_nao");
      x.style.display = "block";

      document.getElementById("filtro1").value = "sim";
      document.getElementById("bt1").style.backgroundColor = "#ccc";
      document.getElementById("bt2").style.backgroundColor = "rgb(202, 86, 86)";

      var y = document.getElementById("quest-hidden-submit");
      y.style.display = "block";
    }else{
      var x = document.getElementById("quest-hidden");
      x.style.display = "block";

      var x = document.getElementById("categoria_nao");
      x.style.display = "none";

      document.getElementById("bt2").style.backgroundColor = "#ccc";
      document.getElementById("bt1").style.backgroundColor = "rgb(68, 157, 68)";

      var y = document.getElementById("quest-hidden-submit");
      y.style.display = "none";
      document.getElementById("filtro1").value = "nao";
    }
  }

  function condition2(val){
    var agenda = document.getElementById("quest-hidden-a3");
    var btSumit = document.getElementById("quest-hidden-submit");

    if(val === 'Agendado com dia e hora certo'){
      agenda.style.display = "block";
    }else if(val){
      agenda.style.display = "none";
      btSumit.style.display = "block";
    }else{
      agenda.style.display = "none";
      btSumit.style.display = "none";
    }
  }

  function condition3(){
    var dia = document.getElementById("dia");
    var hora = document.getElementById("hora");
    var btSumit = document.getElementById("quest-hidden-submit");

    if(dia.value && hora.value){
      btSumit.style.display = "block";
    }else{
      btSumit.style.display = "none";
    }
  }
</script>