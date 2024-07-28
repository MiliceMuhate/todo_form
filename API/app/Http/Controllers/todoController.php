<?php

namespace App\Http\Controllers;

use App\Models\todoMoldel;
use Illuminate\Http\Request;

class todoController extends Controller
{
    public function index()
    {
        $todos = todoMoldel::all();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tarefa_type' => 'required',
            'tarefa_id' => 'required|integer',
            'descricao' => 'required',
        ]);

        todoMoldel::create($request->all());

        return redirect()->route('todos.index')
            ->with('success', 'Tarefa criada com sucesso.');
    }

    public function show(todoMoldel $todo)
    {
        return view('todos.show', compact('todo'));
    }

    public function edit(todoMoldel $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, todoMoldel $todo)
    {
        $request->validate([
            'tarefa_type' => 'required',
            'tarefa_id' => 'required|integer',
            'descricao' => 'required',
        ]);

        $todo->update($request->all());

        return redirect()->route('todos.index')
            ->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy(todoMoldel $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Tarefa deletada com sucesso.');
    }
}
