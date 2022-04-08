<?php
$file = fopen('zip://C:/Users/Dario/workspace/SIU/proyectos/pedidos_3_3/php/importadores/nuevo/temp/42471-advertencia.zip#datos.txt', 'r');
var_dump(fgetcsv($file, null, '|'));