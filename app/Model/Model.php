<?php

namespace App\Model;
/**
 * @Model
 */
class Model
{
	public function index() {
		$arr = explode('\\', get_class($this));
		echo 'Echo from '.$arr[count($arr) - 1];
	}
}