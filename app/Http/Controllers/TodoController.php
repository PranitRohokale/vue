<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy("updated_at", "DESC")->get();
        
        if (!$todos) {
            return response()->json(['error' => 'Todos not found', 'success' => false], 404);
        }

        return response()->json([
            'todos' => $todos,
            'success' => true
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'isComplete' => 'boolean',
                'complexity' => 'in:low,medium,high'
            ]);    
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors(), 'success' => false], 400);
        }

        $todo = Todo::create($validatedData);

        if($todo)
            return response()->json([
                'message' => 'Todo created successfully.',
                'todo' => $todo,
                'success' => true
            ],200);
            
        return response()->json(['message' => "something went wrong", 'todo' => [], 'success' => false],400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors(), 'success' => false], 400);
        }

        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found', 'success' => false], 404);
        }
        return response()->json(['message' => 'Todo retrieved successfully', 'todo' => $todo, 'success' => true], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'isComplete' => 'boolean',
                'complexity' => 'in:low,medium,high'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors(), 'success' => false], 422);
        }

        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json(['error' => 'Todo not found', 'success' => false], 404);
        }

        $todo->update($validatedData);

        if($todo)
            return response()->json([
                'message' => 'Todo updated successfully',
                'todo' => $todo,
                'success' => true
            ],200);

        return response()->json(['error' => 'Todo not found', 'success' => false], 404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

        $todo = Todo::find($id);
        if (!$todo) {
                    return response()->json(['error' => 'Todo not found', 'success' => false], 404);
                }
        $todo->delete();

        return response()->json(['message' => 'Todo deleted successfully', 'success' => true],200);
    }

}
