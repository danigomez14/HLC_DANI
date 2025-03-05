<?php
// Define la contraseña en texto plano
$password = 'consejo'; // Cambia esto por la contraseña que deseas cifrar

// Generar el hash de la contraseña con password_hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Imprimir la contraseña en texto plano y la versión cifrada
echo "Contraseña en texto plano: " . htmlspecialchars($password) . "<br>";
echo "Contraseña cifrada: " . htmlspecialchars($hashed_password) . "<br>";
?>
