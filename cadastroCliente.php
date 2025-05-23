<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inserir Cliente</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f5f7fa;
      color: #333;
      padding: 20px;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #0077b6;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    header h1 {
      font-size: 20px;
      color: #0077b6;
    }

    .info {
      text-align: right;
      font-size: 14px;
    }

    h2 {
      margin-bottom: 20px;
      font-size: 26px;
    }

    form {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .form-group {
      flex: 1;
      min-width: 200px;
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: 600;
      margin-bottom: 6px;
    }

    input, select {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .section {
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 20px;
    }

    .section-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .checkbox-group {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: -10px;
    }

    .btn-submit {
      background-color: #0077b6;
      color: white;
      border: none;
      padding: 12px 20px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
      align-self: flex-start;
    }

    .btn-submit:hover {
      background-color: #005f8e;
    }

    .icon-button {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      background-color: #e0e0e0;
      border: none;
      padding: 8px 10px;
      border-radius: 6px;
      cursor: pointer;
    }

    .contact-box {
      flex: 1;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 20px;
      min-width: 250px;
    }

    .contact-box h3 {
      margin-bottom: 15px;
    }

    .address-row {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
      }
    }
  </style>
</head>


<body>

   <header>
    <h1>RQF3 - Inserir Cliente</h1>
    <div class="info">
      <div>26/08/2024&nbsp;&nbsp;15:35</div>
      <div>Olá usuário</div>
    </div>
  </header>

  <h2>Inserir Cliente</h2>

  <form action="cadastrarCliente.php" method="POST">
    <div class="form-row">
      <div class="form-group">
        <label for="cpf">CPF*</label>
        <input type="text" id="cpf" name="cpf" placeholder="___.___.___-__">
      </div>
      <div class="form-group">
        <label for="nome">Nome*</label>
        <input type="text" id="nome" name="nome">
      </div>
      <div class="form-group">
        <label for="sobrenome">Sobrenome*</label>
        <input type="text" id="sobrenome" name="sobrenome">
      </div>
      <div class="form-group">
        <label for="nascimento">Data de nascimento*</label>
        <input type="date" id="nascimento" name="nascimento">
      </div>
    </div>

    <div class="form-row">
      <div class="section" style="flex: 2;">
        <div class="section-title">Endereço</div>

        <div class="address-row">
          <div class="form-group" style="flex: 1;">
            <label for="cep">CEP*</label>
            <input type="text" id="cep" name="cep">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="logradouro">Logradouro</label>
            <input type="text" id="logradouro" name="logradouro">
          </div>
          <div class="form-group">
            <label for="numero">Número*</label>
            <input type="text" id="numero" name="numero">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="bairro">Bairro*</label>
            <input type="text" id="bairro" name="bairro">
          </div>
          <div class="form-group">
            <label for="estado">Estado*</label>
            <input type="text" id="estado" name="estado">
          </div>
          <div class="form-group">
            <label for="cidade">Cidade*</label>
            <input type="text" id="cidade" name="cidade">
          </div>
        </div>
      </div>

      <div class="contact-box">
        <h3>Contato</h3>
        <div class="form-group">
          <label for="telefone">Telefone / Celular*</label>
          <input type="text" id="telefone" name="telefone" placeholder="(99) 99999-9999">
        </div>
        <div class="form-group">
          <label for="whatsapp">WhatsApp</label>
          <input type="text" id="whatsapp" name="whatsapp" placeholder="(99) 99999-9999">
        </div>
        <div class="form-group">
          <label for="email">E-mail*</label>
          <input type="email" id="email" name="email" placeholder="email@email.com">
        </div>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Endereço de cobrança</div>

      <div class="checkbox-group">
        <input type="checkbox" id="mesmoEndereco" name="mesmoEndereco">
        <label for="mesmoEndereco">Utilizar o mesmo endereço de residência</label>
      </div>

      <div class="address-row">
        <div class="form-group" style="flex: 1;">
          <label for="cep-cob">CEP*</label>
          <input type="text" id="cep-cob" name="cep-cob">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="logradouro-cob">Logradouro</label>
          <input type="text" id="logradouro-cob" name="logradouro-cob">
        </div>
        <div class="form-group">
          <label for="numero-cob">Número*</label>
          <input type="text" id="numero-cob" name="numero-cob">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="bairro-cob">Bairro*</label>
          <input type="text" id="bairro-cob" name="bairro-cob">
        </div>
        <div class="form-group">
          <label for="estado-cob">Estado*</label>
          <input type="text" id="estado-cob" name="estado-cob">
        </div>
        <div class="form-group">
          <label for="cidade-cob">Cidade*</label>
          <input type="text" id="cidade-cob" name="cidade-cob">
        </div>
      </div>
    </div>
    <button type="submit" class="btn-submit">Salvar</button>
  </form>
  <script>
  document.getElementById('mesmoEndereco').addEventListener('change', function () {
    const checked = this.checked;

    // Endereço residencial
    const cep = document.getElementById('cep').value;
    const logradouro = document.getElementById('logradouro').value;
    const numero = document.getElementById('numero').value;
    const bairro = document.getElementById('bairro').value;
    const estado = document.getElementById('estado').value;
    const cidade = document.getElementById('cidade').value;

    // Endereço de cobrança
    document.getElementById('cep-cob').value = checked ? cep : '';
    document.getElementById('logradouro-cob').value = checked ? logradouro : '';
    document.getElementById('numero-cob').value = checked ? numero : '';
    document.getElementById('bairro-cob').value = checked ? bairro : '';
    document.getElementById('estado-cob').value = checked ? estado : '';
    document.getElementById('cidade-cob').value = checked ? cidade : '';
  });
</script>

</body>
</html>
