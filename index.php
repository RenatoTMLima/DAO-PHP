<?php

require_once("config.php");

$sql = new SQL();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

print_r($usuarios);