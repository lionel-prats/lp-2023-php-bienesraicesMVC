<?php 

namespace Helpers;

class FormValidate {
    public function __construct($args = [])
    {
        foreach($args as $key => $value){
            $this->$key = $value;
        }
    }
    public function validate($fields) {
        // $fields -> array con los campos del form que queremos validar, los tipos de validaciones, y el mensaje de error (en caso de haber) para cada tipo de validacion
        /* 
        FORMATO DE FIELDS vvv
        $fields = [
            "nombre" => [
                "empty" => "mensaje si empty...",
                "min_max" => [8, 10, "mensaje si error..."]
            ],
            "mensaje" => [
                "empty" => "mensaje si empty..."
            ]
        ]
        */

        $errors = [];
        foreach($fields as $field => $arrayValidations) {
            foreach($arrayValidations as $validation => $errMsg) {
                if(isset($this->$field)) {
                    if($validation === "int_min_max") {
                        if(self::$validation($this->$field, $errMsg[0], $errMsg[1])){
                            if(!isset($errors[$field])) {
                                $errors[$field] = $errMsg[2];
                            }
                        };
                    } elseif(self::$validation($this->$field)){
                        if(!isset($errors[$field])) {
                            $errors[$field] = $errMsg;
                        }
                    };
                } else {
                    $errors[$field] = $errMsg;
                }
            }

           
        }
        return $errors;
    }
    protected function empty($var) {
        if($var) {
            return false;
        }
        return true;
    }
    protected function int_min_max($var, $min, $max) {
        // esta funcion es para validar que la cadena enviada por el usuario sea estrictamente numerica, y de una extencion determinada entre un minimo y un maximo 
        // ej: 8 y 10 digitos, cuya expresion regular seria vvv
        // "|^\d\d\d\d\d\d\d\d\d?\d?$|"
        $validFormat = "|^"; 
        for ($i = 1; $i <= $max; $i++) {
            if($i <= $min) {
                $validFormat .= "\d"; 
            } else {
                $validFormat .= "\d?"; 
            }
        }
        $validFormat .= "$|"; 
        if(preg_match($validFormat, $var)) {
            return false;
        }
        return true;
    }
    protected function email($var) {
        if (filter_var($var, FILTER_VALIDATE_EMAIL)) {
            return false;
        } 
        return true;
    }
}




