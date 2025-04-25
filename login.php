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
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($senha, $row['senha'])) {
        echo "<h2>Bem-vindo!</h2>";
        echo "Email: " . $row['email'] . "<br>";
        echo "Telefone: " . $row['telefone'];
    } else {
        echo "E-mail ou senha inválidos.";
    }
} else {
    echo "E-mail ou senha inválidos.";
}

$conn->close();
?>