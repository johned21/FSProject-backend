<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Exception;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    public function show(Todolist $list) {
        return response()->json($list,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $lists = Todolist::where('title','like',"%$request->key%")
            ->orWhere('body','like',"%$request->key%")->get();

        return response()->json($lists, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'string|required',
            'body' => 'string|required',
        ]);

        try {
            $list = Todolist::create($request->all());
            return response()->json($list, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Todolist $list) {
        try {
            $list->update($request->all());
            return response()->json($list, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Todolist $list) {
        $list->delete();
        return response()->json(['message'=>'List deleted.'],202);
    }

    public function index() {
        $lists = Todolist::orderBy('title')->get();
        return response()->json($lists, 200);
    }
}
