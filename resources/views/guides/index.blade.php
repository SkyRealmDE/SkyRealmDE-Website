@section('twitter:image', "https://skyrealm.de/assets/guides.png" )
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/guides.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h1 class="font-sans text-4xl">Guides</h1>
                    <br>
                    @foreach($guides as $anchor => $guide)
                        <h2>
                            <a href="{{ '/guides/' . $anchor }}">{{ $guide['title'] }}</a>
                        </h2>
                        <hr><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
