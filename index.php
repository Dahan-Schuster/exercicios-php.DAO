<?php
require_once ('config.php');


$usuario = new Usuario("Patolino Físico", "Quark");

$usuario->insert();

echo $usuario;