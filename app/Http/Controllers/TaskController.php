<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {

        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));

    }

    public function create(Request $request)
    {

        $users = User::all();
        $categories = Category::all();

        return view('tasks.create', compact('users', 'categories'));

    }

    public function store(Request $request)
    {

        $rules = [
            'name' => ['required', 'string'],
            'category' => ['required', 'string'],
            'description' => ['required', 'string'],
            'start' => ['present'],
            'end' => ['required', 'date'],
            'priority' => ['required', 'int'],
            'responsibles' => ['required', 'array'],
        ];

        $validated = $request->validate($rules);

        $category = Category::firstOrCreate(['name' => $validated['category']]);

        $data = [
            'name' => $validated['name'],
            'category_id' => $category->id,
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'end' => $validated['end'],
            'status' => 'in process',
            'creator_id' => auth()->id(),
        ];

        if(isset($validated['start'])) {
            $data += ['start' => $validated['start']];
        }

        $task = Task::create($data);

        $task->responsibles()->attach($validated['responsibles']);

        return redirect()->route('task.index');
    }

    public function show(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    public function edit(Request $request, $id)
    {

        $task = Task::findOrFail($id);
        $users = User::all();
        $categories = Category::all();

        return view('tasks.edit', compact('task', 'users', 'categories'));

    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name' => ['required', 'string'],
            'category' => ['required', 'string'],
            'description' => ['required', 'string'],
            'start' => ['present', 'date'],
            'end' => ['required', 'date'],
            'priority' => ['required', 'int'],
            'status' => ['required', 'string'],
            'responsibles' => ['required', 'array'],
        ];

        $validated = $request->validate($rules);

        $category = Category::firstOrCreate(['name' => $validated['category']]);

        $data = [
            'name' => $validated['name'],
            'category_id' => $category->id,
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'end' => $validated['end'],
            'status' => $validated['status'],
        ];

        if(isset($validated['start'])) {
            $data += ['start' => $validated['start']];
        }

        $task = Task::findOrFail($id);

        $task->update($data);

        $task->responsibles()->sync($validated['responsibles']);

        return redirect()->route('task.index');

    }

    public function delete(Request $request, $id)
    {

        $task = Task::findOrFail($id);
        $task->responsibles()->detach();
        $task->delete();

        return redirect()->route('task.index');
    }
}
