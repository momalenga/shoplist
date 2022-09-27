<?php

namespace Tests\Feature;

use App\Http\Livewire\TodoComponent;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_auth_can_view_dashboard()
    {
        $this->get(route('dashboard'))->assertRedirect();

        $this->login();
        $this->get(route('dashboard'))->assertStatus(200);
    }

    public function test_a_user_can_create_a_todo()
    {
        // Login
        $this->login();

        // Got to the right Livewire component
        Livewire::test(TodoComponent::class)
            ->set('todo.item', 'Ice cream')
            ->set('todo.done', false)
            ->call('saveTodo');

        // submit item and checked.
        $this->assertDatabaseHas('todos', ['item' => 'Ice cream']);
    }

    public function test_a_user_can_edit_a_todo()
    {
        // Login
        $this->login();
        $todo = Todo::factory()->create(['item' => 'goldfish']);

        // Confirm the info is in db
        $this->assertEquals('goldfish', Todo::first()->item);
        $this->assertNotEquals('Ice cream', Todo::first()->item);

        // Got to the right Livewire component
        Livewire::test(TodoComponent::class)
            ->call('editTodo', $todo)
            ->set('todo.item', 'Ice cream')
            ->call('saveTodo');

        // submit item and checked.
        $this->assertEquals('Ice cream', Todo::first()->item);
    }

    // Uncomment this test for deleting the DB
    // public function test_a_user_can_delete_a_todo()
    // {
    //     // Login
    //     $this->login();
    //     $todo = Todo::factory()->create(['item' => 'goldfish']);

    //     // Confirm DB has at least one value
    //     $this->assertEquals(1, Todo::count());

    //     // Got to the right Livewire component
    //     Livewire::test(TodoComponent::class)
    //         ->call('deleteTodo', $todo);

    //     // submit item and checked.
    //     $this->assertEquals(0, Todo::count());
    // }
}
