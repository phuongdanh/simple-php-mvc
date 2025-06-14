<?php

namespace App\Controller;

use App\Core\Controller;
/**
 * @HomeController default controller, you are able to edit in index.php
 */
class HomeController extends Controller
{
    function __construct() {
        parent::__construct();
    }

	public function index($id = null) {
        $data = [
            'title' => 'Welcome to Simple PHP MVC',
            'message' => 'Hello World!',
            'description' => 'This is your first view in the Simple PHP MVC framework.'
        ];
        
        $this->render('home/index', $data);
    }
}