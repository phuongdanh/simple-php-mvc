<?php

namespace App\Core;

class Request {
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';

    private $method;

    function __construct() {
        $this->_setMethod();
    }

    public function post(string $paramName = '') {
        if ($paramName === '') {
            return $_POST;
        }
        if (isset($_POST[$paramName])) {
            return $_POST[$paramName];
        }
        return null;
    }

    public function get(string $paramName = '') {
        if ($paramName === '') {
            return $_GET;
        }
        if (isset($_GET[$paramName])) {
            return $_GET[$paramName];
        }
        return null;
    }

    public function put(string $paramName = '') {
        parse_str(file_get_contents("php://input"), $putdata);
        foreach ($putdata as $key => $value) {
            $putdata[str_replace('amp;', '', $key)] = $value;
        }
        if ($paramName === '') {
            return $putdata;
        }
        if (isset($putdata[$paramName])) {
            return $putdata[$paramName];
        }
        return null; 
    }

    public function header($paramName = '') {
        if ($paramName !== '') {
            $tempName = 'HTTP_' . str_replace('-', '_', strtoupper($paramName));
            if (isset($_SERVER[$tempName])) {
                return $_SERVER[$tempName];
            }   
            if (function_exists('apache_request_headers')) {
                $headers = apache_request_headers();
                if (isset($headers[$paramName])) {
                    return $headers[$paramName];
                }
                $paramName = strtolower($paramName);
                foreach ($headers as $key => $value) {
                    if (strtolower($key) == $paramName) {
                        return $value;
                    }
                }
            }
            return null;
        }
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
            return $headers;
        }
        return null;
    }

    public function getUsername() {
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            return $_SERVER['PHP_AUTH_USER'];
        }
        return null;
    }

    public function getPassword() {
        if (isset($_SERVER['PHP_AUTH_PW'])) {
            return $_SERVER['PHP_AUTH_PW'];
        }
        return null;
    }

    public function getToken() {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
         if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public function _setMethod() {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function _getMethod() {
        return $this->method;
    }

    public function _isGet() {
        if ($this->method == self::METHOD_GET) {
            return true;
        }
        return false;
    }

    public function _isPost() {
        if ($this->method == self::METHOD_POST) {
            return true;
        }
        return false;
    }

    public function _isPut() {
        if ($this->method == self::METHOD_PUT) {
            return true;
        }
        return false;
    }
    
    public function _isPatch() {
        if ($this->method == self::METHOD_PATCH) {
            return true;
        }
        return false;
    }

    public function _isDelete() {
        if ($this->method == self::METHOD_DELETE) {
            return true;
        }
        return false;
    }

}