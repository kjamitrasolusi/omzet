<?php

$password = '11223344';

$hash = '$2y$10$tEKtJhLr.cRhyIZPxCZFhu275n6pUK.KjF0HMA7M2m8mc6oK12hxa';

echo '<pre>';

echo "Hash:\n";
echo $hash;

echo "\n\nPassword:\n";
echo $password;

echo "\n\npassword_verify():\n";

var_dump(
    password_verify(
        $password,
        $hash
    )
);

echo '</pre>';