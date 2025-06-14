<?php

namespace App\Core;

use App\Core\AbstractController;
use App\Core\Model;
use App\Core\Request;
use App\Core\Response;

/**
 * Controller is parent for all of controller class
 */

class Controller extends AbstractController {

    protected $modelName;
    protected $model;
    protected $request;
    protected $response;


    public function __construct() {
        if ($this->modelName != null) {
            $modelName = "App\Model\\".$this->modelName;
            $this->setModel(new $modelName);
        }
        $this->request = new Request;
        $this->response = new Response;
    }

    public function index($id = null) {
        $this->processStandardRequest();
    }

    protected function setModel(Model $model) {
        $this->model = $model;
    }

    protected function getModel() {
        return $this->model;
    }

    /**
     * Render a view file
     * @param string $view The view file to render (without .php extension)
     * @param array $data Data to be extracted and available in the view
     * @return void
     */
    protected function render($view, $data = []) {
        // Extract data to make variables available in view
        extract($data);
        
        // Build the view path
        $viewPath = dirname(__DIR__) . "/Views/{$view}.php";
        
        // Check if view exists
        if (!file_exists($viewPath)) {
            throw new \Exception("View {$view} not found");
        }
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        include $viewPath;
        
        // Get the contents of the buffer and clean it
        $content = ob_get_clean();
        
        // Output the content
        echo $content;
    }

    protected function processStandardRequest() {
        if ($this->request->_isGet()) {
            $this->processStandardGet();
        }
        if ($this->request->_isPost()) {
            $this->processStandardPost();
        }
        if ($this->request->_isPut()) {
            $this->processStandardPut();
        }
    }

    public function processStandardGet() {
        $data = $this->getModel()->get("1");
        $this->processStandardResponse($data);
    }

    public function processStandardGetList() {
    }

    public function processStandardPost() {
        $data = $this->request->post("name");
        $this->processStandardResponse($data);
    }
    public function processStandardPut() {
        $data = $this->request->put();
        $this->processStandardResponse($data);
    }

    public function executeGet() {
        echo 'Execute get method';
    }

    public function processStandardResponse($data) {
        $header = getallheaders();
        $response = array('status' => '', 'message' => '', 'data' => $data);
        if ($header['Accept'] == Response::RESPONSE_JSON) {
            return $this->response->json($response);
        }
        if ($header['Accept'] == Response::RESPONSE_XML) {
            return $this->response->xml($response);
        }
        return $this->response->json($response);
    }
}