<?php
require_once ('config.php');


$usuarios = Usuario::search('a');

echo $usuarios;