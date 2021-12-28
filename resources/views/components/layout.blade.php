<!doctype html>

<title>Wiese</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

{{--<body style="font-family: Open Sans, sans-serif">--}}
<body>
@include('components.navigation-bar')

<x-ToolBar/>
<section class="px-6 py-8" style="  min-height: 82vh;">
    {{$slot}}
</section>
</body>
@include('components.footer')
