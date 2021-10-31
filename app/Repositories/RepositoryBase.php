<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class RepositoryBase
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}