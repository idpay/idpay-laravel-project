<?php

namespace App\Repositories;

use App\Activity;
use App\Order;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements OrderRepositoryInterface
{
    // model property on class instances
    protected $model;

    protected $activity;


    // Constructor to bind model to repo
    public function __construct(Order $model,Activity $activity)
    {
        $this->model = $model;
        $this->activity = $activity;
    }


    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {

        return $this->model->create(

            [
                'API_KEY' => $data['api_key'],
                'sandbox' => $data['sandbox'],
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'email' => $data['email'],
                'amount' =>  $data['amount'],
                'reseller' => $data['reseller'],
                'status' => 'processing',
            ]
        );
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }


    public function createActivity(array $data, $id)
    {
        $activity = $this->model->findOrFail($id)->activities()->create($data);
        return $activity->toArray();
    }






}