@if ($tasks->count())
    <div class="lg:grid lg:grid-cols-6">
        @foreach($tasks as $task)
            <x-task-card
                :task="$task"
                class="{{$loop->iteration < 4 ? 'col-span-3' : 'col-span-2'}}"
            />
        @endforeach
    </div>
@endif
