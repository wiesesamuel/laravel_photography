<form method="POST" action="{{$attributes['actionRoute'] ?? '#'}}">
    @csrf

    <div class="contact-1 py-4 md:py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="xl:flex -mx-4">
                <div class="xl:w-10/12 xl:mx-auto px-4">

                    <div class="xl:w-3/4 mb-4">
                        {{$header ?? ''}}
                    </div>

                    <div class="md:flex md:-mx-4 mt-4 md:mt-10">
                        <div class="{{(isset($note)) ? 'md:w-2/3' : ''}} md:px-4">
                            <div class="contact-form">

                                <div class="sm:flex sm:flex-wrap -mx-3">
                                    {{$form ?? ''}}
                                </div>

                                <div class="text-right mt-4 md:mt-12">
                                    <button
                                        class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                                        {{$attributes['sendText'] ?? 'Send'}}
                                        <i class="fas fa-chevron-right ml-2 text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if (isset($note))
                            <div class="md:w-1/3 md:px-4 mt-10 md:mt-0">
                                <div class="bg-indigo-100 rounded py-4 px-6">
                                    {{$note ?? ''}}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
