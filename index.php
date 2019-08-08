<?php

require_once("config.php");

//Carrega um usuario
// $us = new Usuario();

// $us->loadById(3);

// echo $us;

//Carrega uma lista de usuarios
// $lista = Usuario::getList();

// print_r($lista);

//Carrega uma lista de usuarios buscando pelo login
// $search = Usuario::search("ena");

// print_r($search);

//Carrega um usuario usando login e senha
// $usuario = new Usuario();

// $usuario->login("Renato", 12345);

// echo $usuario;

//Executando o novo metodo insert
// $us = new Usuario();

// print_r($us->insert("Tainara", "13579"));


//Utilizando o novo metodo update
$us = new Usuario();
$us->loadById(5);
$us->update("Doutor", "ksjdfvblsj");

echo $us;