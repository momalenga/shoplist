<div class="p-12">
    <x-jet-input wire:model="item" placeholder="Add Item" />
    <x-jet-button wire:click='saveTodo'>Save</x-jet-button>

    @forelse ($todos as $todo)
        <div class="grid grid-cols-4 gap-x-4">
            <div class="col-span-2">
                {{ $todo->item }}
            </div>
            <div class="">
                {{ Carbon\Carbon::parse($todo->created_at)->diffForHumans() }}
            </div>
            <div class="">
                {{ $todo->done }}
            </div>
        </div>
    @empty
    @endforelse
</div>
