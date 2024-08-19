<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function index($paginate);
    public function find($id);
    public function create($attributes);
    public function update($model, $attributes);
    public function delete($model);
}