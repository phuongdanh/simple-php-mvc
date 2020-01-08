<?php

namespace App\Controller;
use App\Model\UserModel;
use App\Model\CityModel;
/**
 * @UserController
 */
class UserController
{

	public function index() {
		echo 'Echo From UserController';
		$userModel = new UserModel;
		$cityModel = new CityModel;
		$userModel->index();
		$cityModel->index();
	}
}