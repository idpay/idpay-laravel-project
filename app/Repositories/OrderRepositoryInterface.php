<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function createActivity(array $data, $id);
}