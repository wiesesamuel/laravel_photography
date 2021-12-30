<x-layout>
    <main class="max-w-6xl mx-auto mt-6 space-y-6">
        <x-albums.grid.config-grid-element>
            <x-slot name="header">
                Import von Allen
            </x-slot>
            <x-slot name="description">
                von Alben aus dem '/resources/uploads/albums/' Ordner.
            </x-slot>

            <x-slot name="action0">
                <div>
                    <div><h3><strong>All in One</strong>:Alle Alben werden inkl config Dateien importiert bzw ggfs generiert.</h3></div>
                    <div>
                        <button
                            class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                            <a href="{{route('albums.importing', ["cmd" => 'import.all'])}}">All in One</a>
                            <i class="fas fa-chevron-right ml-2 text-sm"></i>
                        </button>
                    </div>
                </div>
            </x-slot>

{{--            <x-slot name="action2">--}}
{{--                <div>--}}
{{--                    <div><h3><strong>Config</strong>: Config dateien anwenden</h3></div>--}}
{{--                    <div>--}}
{{--                        <button--}}
{{--                            class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">--}}
{{--                            <a href="{{route('albums.importing', ["cmd" => 'import.config'])}}">Config Import</a>--}}
{{--                            <i class="fas fa-chevron-right ml-2 text-sm"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </x-slot>--}}
        </x-albums.grid.config-grid-element>

{{--        <x-albums.grid.config-grid-element>--}}
{{--            <x-slot name="header">--}}
{{--                <strong>Reset</strong>--}}
{{--            </x-slot>--}}
{{--            <x-slot name="description">--}}
{{--                von Alben aus dem '/resources/uploads/albums/' Ordner.--}}
{{--                Es werden alle Configurationsdateien und Thumbnails überschrieben!--}}
{{--            </x-slot>--}}

{{--            <x-slot name="action0">--}}
{{--                <div>--}}
{{--                    <div><h3><strong>All in One</strong>: Album neu importiereb -> Config neu generieren -> Thumbnail neu generieren</h3></div>--}}
{{--                    <div>--}}
{{--                        <button--}}
{{--                            class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">--}}
{{--                            <a href="{{route('albums.importing', ["cmd" => 'reset.all'])}}">All in One</a>--}}
{{--                            <i class="fas fa-chevron-right ml-2 text-sm"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </x-slot>--}}
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
{{--            <x-slot name="action2">--}}
{{--                <div>--}}
{{--                    <div><h3><strong>Config</strong>: Config neu generiern in '/resources/uploads/albums/.../config.json'</h3></div>--}}
{{--                    <div>--}}
{{--                        <button--}}
{{--                            class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">--}}
{{--                            <a href="{{route('albums.importing', ["cmd" => 'reset.config'])}}">Config Reset</a>--}}
{{--                            <i class="fas fa-chevron-right ml-2 text-sm"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </x-slot>--}}

{{--            <x-slot name="action3">--}}
{{--                <div>--}}
{{--                    <div><h3><strong>Thumbnails</strong>: Thumbnail neu generieren in '/public/images/albums/.../thumbnails/'</h3></div>--}}
{{--                    <div>--}}
{{--                        <button--}}
{{--                            class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">--}}
{{--                            <a href="{{route('albums.importing', ["cmd" => 'reset.thumbnail'])}}">Thumbnail Reset</a>--}}
{{--                            <i class="fas fa-chevron-right ml-2 text-sm"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </x-slot>--}}
{{--        </x-albums.grid.config-grid-element>--}}

    </main>
</x-layout>
