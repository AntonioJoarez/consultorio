<?php
include 'conexao.php';

// ======= EXCLUSÃO =======
if (isset($_GET['excluir'])) {
  $idExcluir = (int) $_GET['excluir'];
  $conn->query("DELETE FROM clientes WHERE id = $idExcluir");
  header("Location: gestao.php");
  exit();
}

// ======= PAGINAÇÃO =======
$registrosPorPagina = 5;
$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Consulta total de registros
$totalRegistros = $conn->query("SELECT COUNT(*) as total FROM clientes")->fetch_assoc()['total'];
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Consulta paginada
$sql = "SELECT * FROM clientes LIMIT $inicio, $registrosPorPagina";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Listagem de Clientes</title>
  <style>
    /* Seu CSS aqui (pode colar o mesmo da versão anterior) */
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f7fa;
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
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

    a {
      color: #0077b6;
      text-decoration: none;
    }

    .btn {
      padding: 6px 12px;
      background-color: #e0e0e0;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-icon {
      background: none;
      border: none;
      font-size: 18px;
      cursor: pointer;
      margin: 0 5px;
    }

    .btn-icon:hover {
      color: #0077b6;
    }

    .pagination {
      margin-top: 15px;
      text-align: center;
    }

    .pagination button {
      margin: 0 3px;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      background-color: #ddd;
      cursor: pointer;
    }

    .pagination .active {
      background-color: #0077b6;
      color: white;
    }

    .modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      max-width: 300px;
    }

    .modal-content p {
      margin-bottom: 20px;
    }

    .modal-content button {
      margin: 0 10px;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-confirm {
      background-color: #e74c3c;
      color: white;
    }

    .btn-cancel {
      background-color: #2ecc71;
      color: white;
    }
  </style>
</head>
<body>
  <header>
    <h1>RQF2 - Listagem de clientes</h1>
    <div class="info">
      <div><?= date('d/m/Y H:i') ?></div>
      <div>Olá usuário</div>
    </div>
  </header>

  <h2>Gestão de Clientes</h2>
  <a href="cadastroCliente.html" class="btn">Inserir cliente</a>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Whatsapp</th>
        <th>Data de Nascimento</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['nome']) ?></td>
          <td><?= htmlspecialchars($row['telefone']) ?></td>
          <td><a href="https://wa.me/55<?= preg_replace('/\D/', '', $row['telefone']) ?>" target="_blank"><?= htmlspecialchars($row['telefone']) ?></a></td>
          <td><?= date("d/m/Y", strtotime($row['data_nascimento'])) ?></td>
          <td>
            <button class="btn-icon" title="Editar">✏️</button>
            <button class="btn-icon" title="Excluir" onclick="abrirModal('<?= addslashes($row['nome']) ?>', <?= $row['id'] ?>)">🗑️</button>
            <button class="btn-icon" title="Agendar">📅</button>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Paginação -->
  <div class="pagination">
    <?php if ($paginaAtual > 1): ?>
      <a href="?pagina=<?= $paginaAtual - 1 ?>"><button>&lt;</button></a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <a href="?pagina=<?= $i ?>"><button class="<?= ($i == $paginaAtual) ? 'active' : '' ?>"><?= $i ?></button></a>
    <?php endfor; ?>

    <?php if ($paginaAtual < $totalPaginas): ?>
      <a href="?pagina=<?= $paginaAtual + 1 ?>"><button>&gt;</button></a>
    <?php endif; ?>
  </div>

  <!-- Modal de exclusão -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <h3>Exclusão de cliente</h3>
      <p id="mensagem"></p>
      <button class="btn-confirm" onclick="confirmarExclusao()">Sim</button>
      <button class="btn-cancel" onclick="fecharModal()">Não</button>
    </div>
  </div>

  <script>
    let idExcluir = null;

    function abrirModal(nome, id) {
      idExcluir = id;
      document.getElementById("mensagem").textContent = `Deseja realmente excluir o cliente ${nome}?`;
      document.getElementById("modal").style.display = "flex";
    }

    function fecharModal() {
      document.getElementById("modal").style.display = "none";
    }

    function confirmarExclusao() {
      if (idExcluir !== null) {
        window.location.href = `?excluir=${idExcluir}`;
      }
    }
  </script>
</body>
</html>
