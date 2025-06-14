<?php

namespace App\Controller;
use App\Core\Controller;
use SimpleResponse\Response;
use App\Repository\UserRepositoryInterface;

/**
 * @UserController
 */
class UserController extends Controller
{
	protected $userRepository;
	public function __construct(UserRepositoryInterface $userRepository) {
		parent::__construct();
		$this->userRepository = $userRepository;
	}

	public function getList($filter = null) {
		return Response::default(
			$this->userRepository->getList(['filter'])
		);
	}
}