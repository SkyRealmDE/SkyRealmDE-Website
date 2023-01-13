<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/stats.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h1 class="font-sans">Fehler</h1>

                    <br>

                    <p>Es existiert kein User mit der uuid {{ $uuid }} in unserem System</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
