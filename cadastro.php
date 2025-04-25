<?php
$servername = "localhost";
$username = "root";
$password = ""; // ajuste conforme necessário
$dbname = "sistema_login";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$telefone = $_POST['telefone'];

$sql = "INSERT INTO usuarios (email, senha, telefone) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $senha, $telefone);

if ($stmt->execute()) {
    echo "<script>alert('Cadastro concluído com sucesso!'); window.location.href='login.html';</script>";
} else {
    echo "<script>alert('Erro no cadastro: " . $stmt->error . "'); window.location.href='Cadastro.html';</script>";
}

$conn->close();
?>