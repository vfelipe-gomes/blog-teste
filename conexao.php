<?php

$mysql = new mysqli('localhost', 'root', '', 'blog');
$mysql->set_charset('UTF-8');

if ($mysql == false) {
    echo "Erro na conexão!";
}

