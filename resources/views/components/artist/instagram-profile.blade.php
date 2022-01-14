<div class="flex flex-wrap bg-gray-500 rounded-xl mt-5">
    <div class="w-full sm:w-1/3 md:w-2/5 lg:w-1/6 mb-4 sm:mb-1">
        <!-- Profile Picture -->
        <img
            class="h-40 w-40 block rounded-full mx-auto mt-2 mb-2"
            src="{{$profile_data["profile_pic"] ?? ''}}"
        />
    </div>
    <div class="w-full sm:w-2/3 md:w-3/5 lg:w-2/6 sm:mb-2 md:mt-4">
        <!-- Profile Info -->
        <div>
            <div class="text-left pl-4 pt-3">
                <span class="text-base text-gray-700 text-2xl mr-2">{{$profile_data["username"] ?? ''}}</span>
                <span class="text-base font-semibold text-gray-700 mr-2">
                    <a class="link" href="{{$profile_data["url"] ?? $backup_url ?? ''}}" target="_blank">
                          <button
                              class="bg-transparent hover:bg-blue-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-600 hover:border-transparent rounded"
                          >Profil ansehen</button>
                    </a>
                </span>
            </div>

            <div class="text-left pl-4 pt-3">
                    <span class="text-base font-semibold text-gray-700 mr-2">
                      <b>{{$profile_data["posts"] ?? ''}}</b> Beiträge
                    </span>
                <span class="text-base font-semibold text-gray-700 mr-2">
                      <b>{{$profile_data["follower"] ?? ''}}</b> Follower
                    </span>
                <span class="text-base font-semibold text-gray-700">
                      <b>{{$profile_data["abos"] ?? ''}}</b> abonniert
                    </span>
            </div>
        </div>
    </div>
    @if(!empty($profile_data) && isset($profile_data["full_name"]))
        <div class="w-full lg:w-1/2 mt-2 sm:mt-2">
            <!-- Profile Status -->
            <div>
                <div class="text-left pl-4 pt-3">
                    <span class="text-lg font-bold text-gray-700 mr-2">{{$profile_data["full_name"] ?? ''}}</span>
                </div>
                <div class="text-left pl-4 pt-3">
                    <span class="text-lg text-gray-500 mr-2">{{$profile_data["category_name"] ?? ''}}</span>
                </div>
                <div class="text-left pl-4 pt-3">
                    <p
                        class="text-base font-medium mr-2"
                    >{{$profile_data["biography"] ?? ''}}</p>
                    <a
                        class="text-base font-medium text-gray-700 mr-2"
                    >{{$profile_data["external_url"] ?? ''}}5</a>
                </div>
            </div>
        </div>
    @endif
</div>
