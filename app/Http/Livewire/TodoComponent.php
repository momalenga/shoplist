<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoComponent extends Component
{
    public $todo;

    public $item;

    public $done = false;

    public function render()
    {
        $todos = Todo::get();

        return view('livewire.todo-component', compact('todos'));
    }

    public function saveTodo()
    {
        // $this->validate();
        $todo = Todo::create(
            [
                'user_id' => auth()->id(),
                'item' => $this->item,
                'done' => $this->done,
            ]
        );
        $this->item = '';
    }
}
