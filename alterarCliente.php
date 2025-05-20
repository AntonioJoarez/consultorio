<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'conexao.php';

// Verifica se o ID foi passado na URL
if (!isset($_GET['id'])) {
  echo "Cliente não identificado.";
  exit();
}

$id = (int) $_GET['id'];

// Se o formulário foi enviado (método POST), atualiza os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $nascimento = $_POST['nascimento'];

  // Atualiza no banco
  $sql = "UPDATE clientes SET nome = ?, telefone = ?, nascimento = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssi", $nome, $telefone, $nascimento, $id);

  if ($stmt->execute()) {
    header("Location: gestao.php?sucesso=1");
    exit();
  } else {
    echo "Erro ao atualizar: " . $conn->error;
  }
}

// Se chegou aqui, ainda é GET (exibe o formulário)
$sql = "SELECT * FROM clientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();

if (!$cliente) {
  echo "Cliente não encontrado.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f7fa;
      padding: 20px;
    }

    h2 {
      color: #0077b6;
    }

    form {
      background: white;
      padding: 20px;
      max-width: 400px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button {
      padding: 10px 20px;
      background-color: #0077b6;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    a {
      display: inline-block;
      margin-top: 10px;
      color: #0077b6;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h2>Editar Cliente</h2>

  <form method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>

    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>

    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="date" name="nascimento" id="nascimento" value="<?= $cliente['nascimento'] ?>" required>

    <button type="submit">Salvar Alterações</button>
  </form>

  <a href="gestao.php">← Voltar para a gestão</a>
</body>
</html>