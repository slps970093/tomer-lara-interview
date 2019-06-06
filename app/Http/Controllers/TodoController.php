<?php

namespace App\Http\Controllers;

use App\Repository\TodoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodoController extends Controller
{
    //
    private $todoRepository;

    public function __construct(TodoRepository $todoRepository) {
        $this->todoRepository = $todoRepository;
    }

    public function index() {
        $data = $this->todoRepository->getData();
        return view('index',[
            'data' => $data
        ]);
    }

    public function create(Request $request) {
        try {
            $data = [
                'name' => $request->post('name'),
                'is_completed' => 0
            ];

            $this->todoRepository->create($data);
            return Redirect::to('/');
        }catch (\Exception $e){
            return Redirect::to('/?flog=error');
        }
    }

    public function modify($id,Request $request){
        $this->todoRepository->modify($id,$request->post('name'));

        return response()->json([
            'status' => 'ok'
        ],201);
    }

    public function delete($id) {
        $this->todoRepository->delete($id);
        return response()->json([
            'status' => 'ok'
        ],201);
    }
}
