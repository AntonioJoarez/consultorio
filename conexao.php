<?php
$host = "localhost"; // ou 127.0.0.1
$usuario = "root"; // geralmente é root no XAMPP
$senha = ""; // senha do MySQL (vazia no XAMPP por padrão)
$banco = "consultorio";

// Cria a conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se houve erro
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
