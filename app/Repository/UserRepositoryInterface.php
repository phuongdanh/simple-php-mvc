<?php

namespace App\Repository;

interface UserRepositoryInterface {
  public function getList(array $input);
  public function getOne(array $input);
  public function create(array $input);
  public function update(array $input);
  public function delete(array $input);
}