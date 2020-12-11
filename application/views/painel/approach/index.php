<div id="formBody">
<?php if(!empty($msg)){ echo "<div class='alert alert-warning'>$msg</div>";} ?>
  <div id="contact-details">
    <div id='details'>
      <div><strong>ID:</strong> <?= $contact['id']?></div>
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
    <input type="hidden" name="publico" id="publico" value="<?= $contact['publico']?>">
      <div>
        <p>
          A1. Bom dia!/Boa tarde!/Boa noite!. 
          Por gentileza, eu poderia falar com o(a) Sr(a) <?= $contact['nome']?>?
        </p>
      </div>
      <div>
        <p>A2. Meu nome é <strong><?= $contact['operador']?></strong> sou pesquisador(a) da Opinião, 
        empresa que realiza pesquisas em todo o Brasil. 
        Nós estamos realizando uma pesquisa para a CASSI com o objetivo de avaliar questões relacionadas a planos de saúde.</p>

        <p>
          Para selecionar os entrevistados, fizemos um sorteio aleatório, a partir do banco de dados fornecido pela instituição, 
          e foi desta maneira que chegamos ao(à) sr(a).
        </p>

        <p>O sr. (a) poderia colaborar conosco respondendo a nossa pesquisa sobre plano de saúde? Ela tem uma duração média de apenas 8 minutos.</p>
        <p>
          <button type="button" class="btsim" id="bt1" onclick="conditionInteresse('tem_interesse')">Sim</button>
          <button type="button" class="btnao" id="bt2" onclick="conditionInteresse('nao_tem')">Não</button>
          <input type="hidden" name="filtro1" id="filtro1">
        </p>
        <p id="msg-tem-interesse">
          Suas respostas são sigilosas e em nenhum momento sua identidade será revelada, 
          respeitando o código de ética que rege o exercício da atividade de pesquisa, 
          para sua segurança está entrevista será gravada e o código da entrevista é <strong><?=$contact['id']?></strong>.
        </p>
      </div>
      
      <div id="ex-par-elegiveis">
        <p>O(a) sr(a) tem autonomia para decidir e escolher seu plano de saúde?</p>
        <p>
          <button type="button" class="btsim" id="bt3" onclick="conditionEx('tem_poder_decisao')">Tem poder de decisão </button>
          <button type="button" class="btnao" id="bt4" onclick="conditionEx('nao_tem_poder_decisao')">Não tem poder de decisão </button>
          <input type="hidden" name="filtro2" id="filtro2">
        </p>

        <p id="msg-tem-poder-decisao">
          Suas respostas são sigilosas e em nenhum momento sua identidade será revelada, 
          respeitando o código de ética que rege o exercício da atividade de pesquisa, 
          para sua segurança está entrevista será gravada e o código da entrevista é <strong><?=$contact['id']?></strong>.
        </p>
      </div>
      
      <div class="quest-hidden" id="quest-hidden">
        <p>Caso o (a) Sr(a) esteja atarefado(a) neste momento, 
          poderíamos entrar em contato em um outro horário, se preferir, em outro telefone? 
          Sua participação é muito importante para nós!
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
  const publico = document.getElementById("publico").value;
  const questHidden = document.getElementById("quest-hidden");
  const statusLigacao = document.getElementById("statusLigacao");
  const btSubmit = document.getElementById("quest-hidden-submit");
  const agenda = document.getElementById("quest-hidden-a3");
  
  function conditionInteresse(val){
    const exParElegiveis = document.getElementById("ex-par-elegiveis");
    const msgTemInteresse = document.getElementById("msg-tem-interesse");
    
    if(val === 'tem_interesse'){
      questHidden.style.display = "none";
      agenda.style.display = "none";
      statusLigacao.value = "";

      if(publico === 'Participantes'){
        msgTemInteresse.style.display = "block";
        exParElegiveis.style.display = "none";
        btSubmit.style.display = "block";
      }else{
        msgTemInteresse.style.display = "none";
        exParElegiveis.style.display = "block";
        btSubmit.style.display = "none";
      }

      document.getElementById("filtro1").value = "tem_interesse";
      document.getElementById("bt1").style.backgroundColor = "#ccc";
      document.getElementById("bt2").style.backgroundColor = "rgb(202, 86, 86)";

    }else{
      exParElegiveis.style.display = "none";
      msgTemInteresse.style.display = "none";
      questHidden.style.display = "block";
      btSubmit.style.display = "none";

      document.getElementById("bt2").style.backgroundColor = "#ccc";
      document.getElementById("bt1").style.backgroundColor = "rgb(68, 157, 68)";
      document.getElementById("filtro1").value = "nao_tem";
    }
  }

  function conditionEx(val){
    const msgTemPoderDecisao = document.getElementById("msg-tem-poder-decisao");
    btSubmit.style.display = "block";

    if(val === 'tem_poder_decisao')
    {
      msgTemPoderDecisao.style.display = "block";

      document.getElementById("filtro2").value = "tem_poder_decisao";
      document.getElementById("bt3").style.backgroundColor = "#ccc";
      document.getElementById("bt4").style.backgroundColor = "rgb(202, 86, 86)";

    }else{
      msgTemPoderDecisao.style.display = "none";

      document.getElementById("bt4").style.backgroundColor = "#ccc";
      document.getElementById("bt3").style.backgroundColor = "rgb(68, 157, 68)";

      document.getElementById("filtro2").value = "nao_tem_poder_decisao";
    }
  }

  function condition2(val){
    

    if(val === 'Agendado com dia e hora certo'){
      agenda.style.display = "block";
      btSubmit.style.display = "none";
    }else if(val){
      agenda.style.display = "none";
      btSubmit.style.display = "block";
    }else{
      agenda.style.display = "none";
      btSubmit.style.display = "none";
    }
  }

  function condition3(){
    const dia = document.getElementById("dia");
    const hora = document.getElementById("hora");

    if(dia.value && hora.value){
      btSubmit.style.display = "block";
    }else{
      btSubmit.style.display = "none";
    }
  }
</script>