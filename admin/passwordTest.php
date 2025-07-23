<?php
$hash = password_hash("Abc!@#",PASSWORD_BCRYPT);
echo $hash;
echo "<br>hash length".strlen($hash);

?>