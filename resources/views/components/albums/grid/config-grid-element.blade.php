<div class="flex flex-col px-6 py-8 bg-white shadow-lg">
    <h1 class="mb-8 font-extrabold text-gray-800 leading-6">        {{$header ?? ''}}
        <br/>        {{$description ?? ''}}
    </h1>
    <ul class="flex flex-col space-y-4 text-gray-900">
        <div class="bg-red-100 border-l-4 border-red-300 rounded-md w-full px-6 py-4 cursor-pointer">{!! $action0 ?? '' !!}</div>
        <div class="bg-yellow-100 border-l-4 border-yellow-300 rounded-md w-full px-6 py-4 cursor-pointer">{!! $action1 ?? '' !!}</div>
        <div class="bg-purple-100 border-l-4 border-purple-300 rounded-md w-full px-6 py-4 cursor-pointer">{!! $action2 ?? '' !!}</div>
        <div class="bg-green-100 border-l-4 border-green-300 rounded-md w-full px-6 py-4 cursor-pointer">{!! $action3 ?? '' !!}</div>
    </ul>
</div>

