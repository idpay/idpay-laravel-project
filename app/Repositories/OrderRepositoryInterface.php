<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function createActivity(array $data, $id);
}
