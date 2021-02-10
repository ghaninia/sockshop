<?php

namespace App\Repositories;

abstract class Repository
{

    public function __construct()
    {
        $this->model = app($this->model());
    }

    abstract public function model();

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($model, array $data)
    {
        return $model->update($data);
    }

    public function delete($model)
    {
        return $model->delete();
    }

    public function exists($id)
    {
        return $this->model->where('id', $id)->exists();
    }
}
