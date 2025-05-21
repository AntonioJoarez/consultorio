<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'conexao.php';

if (!isset($_GET['cliente_id'])) {
    die("Cliente não informado.");
}

$cliente_id = (int) $_GET['cliente_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data_hora = $_POST['data_hora'];

    $sql = "INSERT INTO agendamentos (cliente_id, data_hora) VALUES ($cliente_id, '$data_hora')";

    if ($conn->query($sql) === TRUE) {
        header("Location: agendamentos.php?cliente_id=$cliente_id");
        exit();
    } else {
        echo "Erro ao cadastrar agendamento: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Agendamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 40px;
        }

        .container {
            background-color: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 20px;
            color: #555;
        }

        input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-container {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-salvar {
            background-color: #28a745;
        }

        .btn-cancelar {
            background-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Novo Agendamento</h2>
        <form method="POST">
            <label for="data_hora">Data e Hora:</label>
            <input type="datetime-local" name="data_hora" required>

            <div class="btn-container">
                <button type="submit" class="btn btn-salvar">Salvar</button>
                <a href="listarAgendamentos.php?cliente_id=<?= $cliente_id ?>" class="btn btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
