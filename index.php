<?php
require_once ('config.php');


$usuario = new Usuario();

$usuario->loadById(6);
$usuario->update("Sakura", "TESTAndo");

echo $usuario;