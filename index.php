<?php
require_once ('config.php');


$usuarios = Usuario::loadAll(Usuario::JSON_LIST);

echo $usuarios;