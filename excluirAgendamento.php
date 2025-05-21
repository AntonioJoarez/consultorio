<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'conexao.php';

if (!isset($_GET['id']) || !isset($_GET['cliente_id'])) {
    die("Dados incompletos.");
}

$id = (int) $_GET['id'];
$cliente_id = (int) $_GET['cliente_id'];

$sql = "DELETE FROM agendamentos WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: agendamentos.php?cliente_id=$cliente_id");
    exit();
} else {
    echo "Erro ao excluir agendamento: " . $conn->error;
}
