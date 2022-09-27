<?php

namespace Tests\Feature;

use App\Http\Livewire\TodoComponent;
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
            ->set('item', 'Ice cream')
            ->set('done', false)
            ->call('saveTodo');

        // submit item and checked.
        $this->assertDatabaseHas('todos', ['item' => 'Ice cream']);
    }
}
