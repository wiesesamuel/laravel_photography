<x-layout>
    @php
        $prices = json_decode(file_get_contents(config_path('prices.json')), true);
        if ($prices == null) {
            dd("Error in " . config_path('prices.json'), file_get_contents(config_path('prices.json')), "Visit https://jsonformatter.curiousconcept.com/ and fix your JSON");
        }
        ksort($prices);
    @endphp
    <style>
        .pricing-plan:hover .pricing-amount {
            background-color: #4c51bf;
            color: #fff;
        }


    </style>
    <div class="pricing-table-2 bg-gray-800 py-6 md:py-12">
        <div class="container mx-auto px-4">

            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl md:text-4xl font-medium text-white mb-4 md:mb-6">{{$prices["title"] ?? ''}}</h1>
                <p class="text-gray-500 xl:mx-12">{!! $prices["description"] ?? '' !!}</p>
            </div>

            <div class="pricing-plans lg:flex lg:-mx-4 mt-6 md:mt-12">

                @foreach($prices as $key => $value)
                    @if (is_int($key))
                        <div class="pricing-plan-wrap lg:w-1/3 my-4 md:my-6">
                            <div
                                class="pricing-plan border-t-4 border-solid border-white bg-white text-center max-w-sm mx-auto hover:border-indigo-600 transition-colors duration-300">
                                <div class="p-6 md:py-8">
                                    <h4 class="font-medium leading-tight text-2xl mb-2">{{$value["title"] ?? ''}}</h4>
                                    <p class="text-gray-600">{{ ($value["subtitle"] ?? '') }}</p>
                                </div>
                                <div class="pricing-amount bg-indigo-100 p-6 transition-colors duration-300">
                                    <div class=""><span
                                            class="text-4xl font-semibold">{{$value["price"] ?? ''}}</span>{{"/" . $value["pricesFor"] ?? ''}}
                                    </div>
                                </div>
                                <div class="p-6">
                                    <ul class="leading-loose">
                                        @foreach(preg_split("/\r\n|\n|\r/", ($value["bulletlist"] ?? '')) as $li)
                                            <li>{{$li}}</li>
                                        @endforeach
                                    </ul>
                                    <div class="mt-6 py-4">
                                        <button
                                            class="bg-indigo-600 text-xl text-white py-2 px-6 rounded hover:bg-indigo-700 transition-colors duration-300">
                                            Get Started
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
