<?php
require_once "classes".DIRECTORY_SEPARATOR."CSVParser.php";
require_once "classes".DIRECTORY_SEPARATOR."fileNotFoundException.php";
require_once "classes".DIRECTORY_SEPARATOR."filePermissionException.php";

$csv = new CSVParser('arquivos/clientes.csv', ';');

try {
    $csv->parse();

    while ($row = $csv->fetch()) {
        echo $row['Cliente']." - ".$row['Cidade']."<br>".PHP_EOL;
    }
    
} 
catch (FileNotFoundException $e) {
    print_r($e->getTrace());
    die($e->getMessage());
}
catch (FilePermissionException $e) {
    echo $e->getFile()." : ". $e->getLine(). " # ". $e->getMessage();
}


