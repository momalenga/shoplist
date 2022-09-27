<div class="p-12">
    <div class="flex items-start py-4">

        <div class="w-3/4">
            <x-jet-input wire:model="todo.item" placeholder="Add Item" class="w-full px-5 py-1 border rounded-none" />
            <x-jet-input-error for="todo.item" class="mt-2" />
        </div>
        <x-jet-button class="!rounded-none" wire:click='saveTodo'>Save</x-jet-button>
    </div>

    @forelse ($todos as $todo)
        <div class="grid grid-cols-5 gap-x-4">
            <div class="col-span-2  {{ $todo->done ? 'line-through' : '' }}">
                {{ $todo->item }}
            </div>
            <div class="">
                {{ Carbon\Carbon::parse($todo->created_at)->diffForHumans() }}
            </div>
            <div class="">
                <input type="checkbox" name="terms" id="terms" wire:click='toggleTodo({{ $todo->id }})' />
            </div>
            <div class="">
                <x-jet-secondary-button wire:click='editTodo({{ $todo }})'>Edit</x-jet-secondary-button>
            </div>
        </div>
    @empty
    @endforelse
</div>
