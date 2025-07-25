<?php
$password = "Asd!@#"; // change this to your real password
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed password: " . $hash;
?>