<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements Interfaces\UserRepositoryInterface {

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index($paginate){
        return $this->model->paginate($paginate);
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function create($attributes){
        return $this->model->create($attributes);
    }

    public function update($model, $attributes){
        return $model->update($attributes);
    }

    public function delete($model){
        return $model->delete();
    }
}