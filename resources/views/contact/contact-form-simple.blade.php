<x-layout>
    <style>
        .input:focus {
            box-shadow: 0 0 0 0.2rem rgba(88, 99, 248, 0.15);
        }

    </style>

    <div class="contact-2 py-6">
        <div class="container px-4 mx-auto">

            <div class="text-center md:max-w-2xl md:mx-auto px-2 md:pb-4">
                <h1 class="text-3xl md:text-4xl font-medium my-2 text-white">Schreib mir</h1>
                <div class="contact-form mt-6 md:mt-12">
                    <form action="{{ route('contact') }}" method="POST">
                        @csrf
                        <x-honey/>
                        <div class=" mb-4 rounded-lg lg:rounded-l-lg">
                        <textarea name="message" id="message" cols="30" rows="5" placeholder="Deine Nachricht an mich"
                                  class="border-t-6 border-b-6 border-solid border-white rounded py-2 px-3 placeholder-gray-250 text-white placeholder-opacity-100 w-full input transition-colors  border-t-4 border-b-4 border-solid border-white bg-white  border-blue-700 hover:border-blue-600  focus:border-blue-600 active:border-blue-500 transtion-300"
                                  style="background-color: rgb(31, 41, 55)" required
                        >{{str_replace('\n', '&#13;&#10', request('msg')) ?? ''}}</textarea>
                        </div>

                        <div class="mb-4 flex">
                            <div class="flex-grow">
                                <input type="text" placeholder="Deine E-mail oder Telefonnummer"
                                       class="border-t-6 border-b-6 border-solid border-white rounded py-2 px-3 placeholder-gray-250 text-white placeholder-opacity-100 w-full input transition-colors  border-t-4 border-b-4 border-solid border-white bg-white  border-blue-700  hover:border-blue-600 focus:border-blue-600 active:border-blue-500 transtion-300"
                                       style="background-color: rgb(31, 41, 55)" required

                                ></textarea>
                            </div>

                            <button
                                class="bg-blue-700 hover:bg-blue-500 text-white border-2 border-solid border-blue-600 rounded py-2 px-4 flex-shrink-0 ml-4 transition-colors duration-300"
                                type="submit">
                                <strong>
                                    Abschicken
                                </strong>
                            </button>
                        </div>
                    </form>


                </div>
            </div>

            {{--            <div class="md:flex md:-mx-4 text-center mt-6 md:mt-12 pt-6 border-t-2 border-solid">--}}
            {{--                <div class="md:px-4 md:w-1/3">--}}
            {{--                    <address>--}}
            {{--                        <div class="font-bold mb-2">West Chicago, IL</div>--}}
            {{--                        <span>--}}
            {{--            44 Shirley Ave.<br>--}}
            {{--            West Chicago, IL 60185--}}
            {{--          </span>--}}
            {{--                    </address>--}}
            {{--                </div>--}}
            {{--                <div class="md:px-4 md:w-1/3 mt-8 md:mt-0">--}}
            {{--                    <address>--}}
            {{--                        <div class="font-bold mb-2">Orlando, FL</div>--}}
            {{--                        <span>--}}
            {{--            514 S. Magnolia St.<br>--}}
            {{--            Orlando, FL 32806--}}
            {{--          </span>--}}
            {{--                    </address>--}}
            {{--                </div>--}}
            {{--                <div class="md:px-4 md:w-1/3 mt-8 md:mt-0">--}}
            {{--                    <address>--}}
            {{--                        <div class="font-bold mb-2">West Chicago, IL</div>--}}
            {{--                        <span>--}}
            {{--            4 Goldfield Rd.<br>--}}
            {{--            Honolulu, HI 96815--}}
            {{--          </span>--}}
            {{--                    </address>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        </div>
    </div>
</x-layout>
