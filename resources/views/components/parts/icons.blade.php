@props(['name'])

@if ($name === 'arrow-down')
    <svg
        {{ $attributes(['class' => "transform -rotate-90 "]) }}
        width="22"
        height="22"
        viewBox="0 0 22 22">
        <g fill="none" fill-rule=evenodd">
            <path stroke="#000" stroke-opacity=".012" stroke-width=".5"
                  d="M21 1v20.16H.84V1z"></path>
            <path fill="#222"
                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
        </g>
    </svg>
@endif
@if ($name === 'arrow-left')
    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
        <g fill="none" fill-rule="evenodd">
            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
            </path>
            <path class="fill-current"
                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
            </path>
        </g>
    </svg>
@endif
@if ($name === 'facebook')
    <svg
        fill="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        class="w-6 h-6 text-blue-300"
        viewBox="0 0 24 24"
    >
        <path
            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"
        ></path>
    </svg>
@endif
@if ($name === 'instagram')
    <svg
        fill="none"
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        class="w-6 h-6 text-pink-400"
        viewBox="0 0 24 24"
    >
        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
        <path
            d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"
        ></path>
    </svg>
@endif
@if ($name === 'twitter')
    <svg
        fill="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        class="w-6 h-6 text-blue-600"
        viewBox="0 0 24 24"
    >
        <path
            d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"
        ></path>
    </svg>
@endif
