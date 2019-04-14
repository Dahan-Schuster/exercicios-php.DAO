<?php
require_once ('config.php');


$usuario = new Usuario();

$usuario->login("Fanisz", "y2y2y2y2");

echo $usuario;