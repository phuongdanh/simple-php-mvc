<?php

namespace App\Core\Process;

class MyException extends \Exception {
    public function errorMessage() {
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b>';
        return $errorMsg;
    }
}