<?php

require_once("config.php");

$us = new Usuario();

$us->loadById(3);

echo $us;