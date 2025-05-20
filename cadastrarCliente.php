<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conexao.php';

// Verifica se os dados foram enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $nascimento = $_POST["nascimento"];
    $cep = $_POST["cep"];
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $telefone = $_POST["telefone"];
    $whatsapp = $_POST["whatsapp"];
    $email = $_POST["email"];

    // Endereço de cobrança
    $cep_cob = $_POST["cep-cob"];
    $logradouro_cob = $_POST["logradouro-cob"];
    $numero_cob = $_POST["numero-cob"];
    $bairro_cob = $_POST["bairro-cob"];
    $estado_cob = $_POST["estado-cob"];
    $cidade_cob = $_POST["cidade-cob"];

    // Monta o SQL (ajuste os campos conforme sua tabela)
    $sql = "INSERT INTO clientes 
        (cpf, nome, sobrenome, nascimento, cep, logradouro, numero, bairro, estado, cidade, telefone, whatsapp, email, cep_cob, logradouro_cob, numero_cob, bairro_cob, estado_cob, cidade_cob)
        VALUES 
        ('$cpf', '$nome', '$sobrenome', '$nascimento', '$cep', '$logradouro', '$numero', '$bairro', '$estado', '$cidade', '$telefone', '$whatsapp', '$email', '$cep_cob', '$logradouro_cob', '$numero_cob', '$bairro_cob', '$estado_cob', '$cidade_cob')";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
