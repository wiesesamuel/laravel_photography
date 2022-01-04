{{--@props(['artist'])--}}

@php
    $html = file_get_contents('https://instagram.com/apple/');
    preg_match('/_sharedData = ({.*);<\/script>/', $html, $matches);
    $profile_data = json_decode($matches[1])->entry_data->ProfilePage[0]->graphql->user;
    dd($profile_data);
@endphp

<x-layout>

<div class="flex flex-wrap bg-blue-500">
    <div class="w-full sm:w-1/3 md:w-2/5 lg:w-1/6 mb-4 bg-gray-500 sm:mb-1">
        <!-- Profile Picture -->
        <img
            class="h-40 w-40 block rounded-full mx-auto mt-2 mb-2"
            src="{{$profile_data["profile_pic_url_hd"] ?? ''}}"
        />
    </div>
    <div class="w-full sm:w-2/3 md:w-3/5 lg:w-2/6 bg-gray-500 sm:mb-2 md:mt-4">
        <!-- Profile Info -->
        <div>
            <div class="text-left pl-4 pt-3">
                <span class="text-base text-gray-700 text-2xl mr-2">{{$profile_data["username"] ?? ''}}</span>
                <span class="text-base font-semibold text-gray-700 mr-2">
                          <button
                              class="bg-transparent hover:bg-blue-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-600 hover:border-transparent rounded"
                          >View Profile</button>
                    </span>
            </div>

            <div class="text-left pl-4 pt-3">
                    <span class="text-base font-semibold text-gray-700 mr-2">
                      <b>{{$profile_data["edge_owner_to_timeline_media"]["count"] ?? ''}}</b> Beiträge
                    </span>
                <span class="text-base font-semibold text-gray-700 mr-2">
                      <b>{{$profile_data["edge_followed_by"]["count"] ?? ''}}</b> Follower
                    </span>
                <span class="text-base font-semibold text-gray-700">
                      <b>{{$profile_data["edge_follow"]["count"] ?? ''}}</b> abonniert
                    </span>
            </div>

        </div></div>
    <div class="w-full lg:w-1/2 bg-gray-400 mt-2 sm:mt-2">
        <!-- Profile Status -->
        <div>
            <div class="text-left pl-4 pt-3">
                <span class="text-lg font-bold text-gray-700 mr-2">Sonali Hirave</span>
            </div>
            <div class="text-left pl-4 pt-3">
                <p
                    class="text-base font-medium text-blue-700 mr-2"
                >#graphicsdesigner #traveller #reader #blogger #digitalmarketer</p>
                <p
                    class="text-base font-medium text-gray-700 mr-2"
                >https://www.behance.net/hiravesona7855</p>
            </div>
        </div>
    </div>
</div>

</x-layout>
