<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('artist.update') }}" method="POST">
                        @csrf
                        <button><a type="submit">Update Artist Website Data (nur Instgram Daten aktualisieren)</a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div><h3><strong>All in One</strong></h3></div>
                    <div>
                        Import von allen Alben aus dem '/resources/uploads/albums/' Ordner.
                    </div>
                    <div>
                        <div>Scant nach Album Files</div>
                        <div>Reimportiert Config Files. Generiert Config Files falls noch nicht vorhanden.</div>
                        <div>Reimportiert Thumbnail Files. Generiert Thumbnail Files falls noch nicht vorhanden.</div>
                        <div>
                            <button
                                class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                                <a href="{{route('albums.importing', ["cmd" => 'import.all'])}}">All in One</a>
                                <i class="fas fa-chevron-right ml-2 text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-albums.grid.config-grid-element>
        <x-slot name="header">
            <strong>Reset</strong>
        </x-slot>
        <x-slot name="description">
            von Alben aus dem '/resources/uploads/albums/' Ordner.
            Es werden alle Configurationsdateien und Thumbnails überschrieben!
        </x-slot>

        <x-slot name="action0">
            <div>
                <div><h3><strong>All in One</strong>: Album neu importieren -> Config neu generieren -> Thumbnail neu
                        generieren</h3></div>
                <div>
                    <button
                        class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                        <a href="{{route('albums.importing', ["cmd" => 'reset.all'])}}">All in One</a>
                        <i class="fas fa-chevron-right ml-2 text-sm"></i>
                    </button>
                </div>
            </div>
        </x-slot>
        {{--            <x-slot name="action1">--}}
        {{--                <div>--}}
        {{--                    <div><h3><strong>Alben</strong>Datenbankinstanzen werden gelöscht und neu importiert. GGFS OBEN AUF IMPORT ALL IN ONE AUSFÜHREN!</h3></div>--}}
        {{--                    <div>--}}
        {{--                        <button--}}
        {{--                            class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">--}}
        {{--                            <a href="{{route('albums.importing', ["cmd" => 'reset.alben'])}}">Alben</a>--}}
        {{--                            <i class="fas fa-chevron-right ml-2 text-sm"></i>--}}
        {{--                        </button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </x-slot>--}}
        <x-slot name="action2">
            <div>
                <div><h3><strong>Config</strong>: Config neu generiern in '/resources/uploads/albums/.../config.json'
                    </h3></div>
                <div>
                    <button
                        class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                        <a href="{{route('albums.importing', ["cmd" => 'reset.config'])}}">Config Reset</a>
                        <i class="fas fa-chevron-right ml-2 text-sm"></i>
                    </button>
                </div>
            </div>
        </x-slot>

        <x-slot name="action3">
            <div>
                <div><h3><strong>Thumbnails</strong>: Thumbnail neu generieren in
                        '/public/images/albums/.../thumbnails/'</h3></div>
                <div>
                    <button
                        class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                        <a href="{{route('albums.importing', ["cmd" => 'reset.thumbnail'])}}">Thumbnail Reset</a>
                        <i class="fas fa-chevron-right ml-2 text-sm"></i>
                    </button>
                </div>
            </div>
        </x-slot>
    </x-albums.grid.config-grid-element>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button><a href="/users"> Usermanagment </a></button>
                </div>
            </div>
        </div>
    </div>

</x-layout>
