<x-layout>
    <main class="max-w-6xl mx-auto mt-6 space-y-6">
        <div class="md:flex md:-mx-4 mt-4 md:mt-10">

            <div class="xl:w-10/12 xl:mx-auto px-4">

                <div class="xl:w-3/4 mb-4">
                    <h1 class="text-3xl text-medium mb-4">{{$msg ? 'Meldung: ' . (is_array($msg) ? implode('<br>', $msg) : $msg) : ''}}</h1>
                </div>

                <div class="md:w-2/3 md:px-4">
                    <div class="contact-form">
                        <div class="sm:flex sm:flex-wrap -mx-3">
                            <div class="sm:w-1/2 px-3 mb-6">
                                <p>
                                    Alle Dateien aus /images/public importieren welche kein Lockdateien haben.
                                    Dabei werden Lock Dateien in die Ordner geschrieben, damit Sie nicht doppelt
                                    importiert werden.
                                </p>
                            </div>
                            <div class="sm:w-1/2 px-3 mb-6">
                                <button class="btn btn-blue">
                                </button>
                                <button
                                    class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                                    <a href="{{route('albums.importing', ["cmd" => 'importUnlocked'])}}">Import</a>
                                    <i class="fas fa-chevron-right ml-2 text-sm"></i>
                                </button>
                            </div>
                            <div class="sm:w-1/2 px-3 mb-6">
                                Alle vorhandenen Alben löschen und neu importieren. <strong>VERBUGT</strong>
                            </div>
                            <div class="sm:w-1/2 px-3 mb-6">
                                <button class="btn btn-blue">
                                </button>
                                <button
                                    class="border-2 border-indigo-600 rounded px-6 py-2 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                                    <a href="{{route('albums.importing', ["cmd" => 'reloadAll'])}}">Reimport</a>
                                    <i class="fas fa-chevron-right ml-2 text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="md:w-1/3 md:px-4 mt-10 md:mt-0">
                <div class="bg-indigo-100 rounded py-4 px-6">
                    <h5 class="text-xl font-medium mb-3">Help</h5>
                    <p class="text-gray-700 mb-4">Du weißt nicht was du tust? Dann lass es! Schreib lieber mir: <a
                            href="mailto:"
                            class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">email</a>
                        or call us at <a href="tel:"
                                         class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">+1
                            231 456 1231</a></p>
                </div>
            </div>

        </div>

        <div class="flex grid-cols-2">
            <div>

                <div>

                </div>

                <div>
                </div>
                <div>

                </div>
            </div>
    </main>
</x-layout>
