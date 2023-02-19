<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/jobs.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h1 class="font-sans text-4xl text-green-400">Danke für deine Bewerbung als {{ $title }}</h1>
                    <p class="font-sans text-md text-gray-100">
                        Wir haben dir eine Eingangsbestätigung per E-Mail zugesendet. Dort findest du alle Infos zu deiner Bewerbung und wirst über den Status deiner Bewerbung in Kenntnis gesetzt.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
