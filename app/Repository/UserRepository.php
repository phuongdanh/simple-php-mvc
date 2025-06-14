<?php

namespace App\Repository;
use App\Model\UserModel;
use App\Model\CityModel;
/**
 * @UserController
 */
class UserRepository implements UserRepositoryInterface
{
  protected $userModel;
  protected $cityModel;
  function __construct()
  {
    $this->userModel = new UserModel;
    $this->cityModel = new CityModel;
  }
	public function getList(array $input) {
		return $this->userModel->list_dummy();
  }
  public function getOne(array $input) {
		return 'Get one';
  }
  public function create(array $input) {
		return "created user";
  }
  public function update(array $input) {
		return 'Update user';
  }
  public function delete(array $input) {
		return "Deleted user";
	}
}