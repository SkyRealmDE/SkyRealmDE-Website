<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/jobs.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h1 class="font-sans text-4xl" style="color: {{ $job->color }}">{{ $job->title }} - Bewerbung</h1>
                    <br>
                    <p class="font-sans text-gray-100">{{ $job->description }}</p>
                    <form class="space-y-8" action="/jobs/{{ $job->id }}/applied" method="post">
                        @csrf
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <br>
                                <h1 class="font-sans text-3xl" style="color: {{ $job->color }}">Bewirb dich jetzt für diese Stelle:</h1>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="discord" class="block text-md font-black text-orange-600" style="color: {{ $job->color }}"> Discord Name </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input required type="text" name="discord" id="discord" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-100 bg-gray-700">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="mail" class="block text-md font-black text-orange-600" style="color: {{ $job->color }}"> E-Mail </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input required type="email" name="mail" id="mail" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-100 bg-gray-700">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="name" class="block text-md font-black text-orange-600" style="color: {{ $job->color }}"> Name </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input required type="text" name="name" id="name" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-100 bg-gray-700">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="about" class="block text-md font-black text-orange-600" style="color: {{ $job->color }}"> Über dich </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <textarea required id="about" name="about" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-100 bg-gray-700 rounded-md"></textarea>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-100">Schreibe ein paar Sätze über dich.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-8">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-100">Datenschutz</h3>
                                    <p class="mt-1 text-sm text-gray-100">Du musst noch unsere Datenschutzbedingungen akzeptieren.</p>
                                </div>
                                <div class="mt-4 space-y-4">
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                            <input required id="privacy" name="privacy" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 bg-gray-700 text-indigo-600 border-gray-300 rounded hover:cursor-pointer">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="privacy" class="font-medium text-gray-100 hover:cursor-pointer">Ich habe die Datenschutzerklärung gelesen und bin damit einverstanden, dass meine Daten auf den SkyRealm Servern gespeichert werden fürfen.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cf-turnstile" data-sitekey="0x4AAAAAAACATeeFHjeB6MSH"></div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Abschicken</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</x-app-layout>
