<?php //esto solo era para añadir la contraseña hasheada en el script de la base de datos
function checkPasswordHash($password){
$salt = "impossibletoguess";
$passwordToCheck = $password;
$passwordToHash = $passwordToCheck . $salt;
$hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);
echo $hashedPassword . "<br>";
}

checkPasswordHash("password1"); //user 1
checkPasswordHash("password2"); //user 2
checkPasswordHash(1234); //OscarHueso
checkPasswordHash(12345); //Ahmad

?>
