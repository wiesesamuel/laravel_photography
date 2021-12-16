@props(['task'])

<article
    {{$attributes->merge(['class' =>"transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"])}}
>
    <div class="py-6 px-5 lg:flex" style="flex-direction: column">
        <div class="flex-1 lg:mr-8">
            {{--TODO--}}
            <img src="/images/illustration-1.png" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                <div class="space-x-2">
                    <a>{{$task->taskStateValue()}} </a>
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/tasks/{{$task->id}}">{{$task->title}}</a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                                        Published <time>{{$task->created_at->diffForHumans()}}</time>
                                    </span>
                </div>
            </header>

            <div class="text-sm mt-2">
                <p>
                    {{$task->content}}
                </p>
            </div>

        </div>
    </div>
</article>

