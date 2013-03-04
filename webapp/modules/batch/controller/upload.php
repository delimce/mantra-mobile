<?php

$tool = new Tools();
$subido = $tool->upload_file($_FILES['archivo'], './files/lista_precios.csv', 1);

if ($subido) {

    $csv = new ParseCSV();

    # Parse '_books.csv' using automatic delimiter detection...
    $csv->offset = 2; //que empiece desde la fila 2
    $nomProd = 0; ///nombre del producto
    $codprod = 1; ///campos del cod de producto
    $precioP = 4; //campo del precio a ajustar
    $csv->auto('./files/lista_precios.csv');
    $i = 0;
    ///titulos 
    foreach ($csv->titles as $value): $ncampos[$i] = $value;
        $i++;
    endforeach;

    
}
?>
