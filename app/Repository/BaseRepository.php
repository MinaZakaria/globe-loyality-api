<?php

namespace App\Repository;

abstract class BaseRepository
{
    abstract protected function model();

    public function find($id)
    {
        return $this->model()::find($id);
    }

    public function findOneBy(array $attributes)
    {
        return $this->model()::firstWhere($attributes);
    }

    public function findBy(array $attributes)
    {
        return $this->model()::where($attributes)->get();
    }

    public function create(array $data)
    {
        return $this->model()::create($data);
    }

    public function all()
    {
        return $this->model()::all();
    }
}