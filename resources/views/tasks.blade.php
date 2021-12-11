<x-layout>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($tasks->count())
            <x-tasks-grid :tasks="$tasks"></x-tasks-grid>
        @else
            <p class="text-center">No tasks yet. Please come back later.</p>
        @endif
    </main>
</x-layout>

