<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conexao.php';

if (!isset($_GET['cliente_id'])) {
    echo "Cliente não informado.";
    exit();
}

$cliente_id = (int) $_GET['cliente_id'];

if ($cliente_id === 0) {
    die("Cliente não informado");
}

// Buscar dados do cliente
$sqlCliente = "SELECT * FROM clientes WHERE id = $cliente_id";
$resultCliente = $conn->query($sqlCliente);

if (!$resultCliente) {
    die("Erro na consulta ao cliente: " . $conn->error);
}

$cliente = $resultCliente->fetch_assoc();

if (!$cliente) {
    die("Cliente não encontrado.");
}

// Paginação dos agendamentos
$registrosPorPagina = 5;
$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
if ($paginaAtual < 1) $paginaAtual = 1;
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Total de agendamentos para o cliente
$sqlTotal = "SELECT COUNT(*) as total FROM agendamentos WHERE cliente_id = $cliente_id";
$totalRegistros = $conn->query($sqlTotal)->fetch_assoc()['total'];
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Consulta dos agendamentos com JOIN para trazer o whatsapp do cliente
$sql = "SELECT a.*, c.whatsapp 
        FROM agendamentos a
        INNER JOIN clientes c ON a.cliente_id = c.id
        WHERE a.cliente_id = $cliente_id
        ORDER BY a.data_hora DESC
        LIMIT $inicio, $registrosPorPagina";

$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta dos agendamentos: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Agendamentos de <?= htmlspecialchars($cliente['nome']) ?></title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f7fa;
      padding: 20px;
    }
    h2 {
      color: #0077b6;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #0077b6;
      color: white;
    }
    .btn {
      padding: 6px 12px;
      background-color: #0077b6;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
    }
    .pagination {
      margin-top: 15px;
      text-align: center;
    }
    .pagination a {
      margin: 0 3px;
      padding: 6px 12px;
      background-color: #ddd;
      border-radius: 4px;
      color: black;
      text-decoration: none;
    }
    .pagination .active {
      background-color: #0077b6;
      color: white;
    }
  </style>
</head>
<body>
  <h2>Agendamentos de <?= htmlspecialchars($cliente['nome']) ?></h2>
  <a href="gestao.php" class="btn">Voltar</a>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Data e Hora</th>
        <th>Whatsapp</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows === 0): ?>
        <tr><td colspan="4">Nenhum agendamento encontrado.</td></tr>
      <?php else: ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= date("d/m/Y H:i", strtotime($row['data_hora'])) ?></td>
            <td><?= htmlspecialchars($row['whatsapp']) ?></td>
            <td>
              <a href="editarAgendamento.php?id=<?= $row['id'] ?>&cliente_id=<?= $cliente_id ?>" class="btn">Editar</a>
              <a href="excluirAgendamento.php?id=<?= $row['id'] ?>&cliente_id=<?= $cliente_id ?>" class="btn" style="background:#e74c3c;">Excluir</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <div class="pagination">
    <?php if ($paginaAtual > 1): ?>
      <a href="?cliente_id=<?= $cliente_id ?>&pagina=<?= $paginaAtual - 1 ?>">&lt;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <a href="?cliente_id=<?= $cliente_id ?>&pagina=<?= $i ?>" class="<?= ($i == $paginaAtual) ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($paginaAtual < $totalPaginas): ?>
      <a href="?cliente_id=<?= $cliente_id ?>&pagina=<?= $paginaAtual + 1 ?>">&gt;</a>
    <?php endif; ?>
  </div>
</body>
</html>
