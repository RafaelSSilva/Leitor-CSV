<?php

class CSVParser {
    private $filename, $data, $header, $counter, $separator;

    public function __construct($filename, $separator = ',') {
        $this->filename  = $filename; // nome do arquivo
        $this->separator = $separator; // separador de colunas
        $this->counter   = 1; // contador de linhas
    }

    public function parse() {
        
        if (!file_exists($this->filename)) {
            throw new FileNotFoundException("Arquivo {$this->filename} não existe.");
        }

        if (!is_readable($this->filename)) {
            throw new FilePermissionException("Arquivo {$this->filename} sem permissão.");
        }
        

        $this->data   = file($this->filename); // Lê o arquivo, que carrega em memória e o transforma em array.
        $this->header = str_getcsv($this->data[0], $this->separator); // efetua a leitura da primeira linha e armazena na variável header
    }

    public function fetch() {
        if (isset($this->data[$this->counter])) {
            $row = str_getcsv($this->data[$this->counter ++], $this->separator); // Efetua a leitura da linha do contador
            foreach ($row as $key => $value) {
                $row[$this->header[$key]] = $value;
            }

            return $row;
        }
    }
}