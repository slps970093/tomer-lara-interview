<?php


namespace App\Repository;


use App\Todo;

class TodoRepository
{

    private $todo;

    public function __construct( Todo $todo){
        $this->todo = $todo;
    }

    public function getData() {
        return $this->todo->get();
    }

    public function create($data) {
        $this->todo->create($data);
    }

    public function modify($primaryKey,$name){
        $res = $this->todo->find($primaryKey);
        $res->name = $name;
        $res->save();
    }

    public function delete($primaryKey){
        $res = $this->todo->find($primaryKey);
        $res->delete();
    }

    public function completed($primaryKey){
        $res = $this->todo->find($primaryKey);
        $res->is_completed = 1;
        $res->save();
    }

}