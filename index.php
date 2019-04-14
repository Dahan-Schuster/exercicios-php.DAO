<?php
require_once ('config.php');


$usuario = new Usuario();


# Exemplo de delete do registro do próprio objeto
$usuario->loadById(6);
$usuario->delete();

# Exemplo de delete de outro registro
$usuario->delete(5);

echo $usuario;