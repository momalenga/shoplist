<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoComponent extends Component
{
    public $todo;

    protected function rules()
    {
        return [
            'todo.item' => ['required', 'min:3'],
            'todo.user_id' => ['required'],
            'todo.done' => ['required'],
        ];
    }

    public function mount()
    {
        $this->makeBlankTodo();
    }

    public function makeBlankTodo()
    {
        $this->todo = Todo::make();
    }

    public function editTodo(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function toggleTodo(Todo $todo)
    {
        // $this->editTodo($todo);
        // dump($this->todo->done);
        $this->todo = $todo;
        $this->todo->done = ! $todo->done;
        // dd($this->todo->done);
        $this->todo->save();
        $this->makeBlankTodo();
    }

    public function render()
    {
        $todos = Todo::get();

        return view('livewire.todo-component', compact('todos'));
    }

    public function saveTodo()
    {
        $this->todo->user_id = auth()->id();
        $this->todo->done = false;

        $this->validate();
        $this->todo->save();
        $this->makeBlankTodo();
    }
}
