<?php

namespace App\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{

    /**
     * @var Model
     */
    private $repository;

    public function __construct(Model $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}