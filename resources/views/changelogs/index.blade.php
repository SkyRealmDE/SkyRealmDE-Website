@section('twitter:image', "https://skyrealm.de/assets/changelogs.png" )
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/changelogs.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h1 class="font-sans text-4xl">Changelogs</h1>
                    <br>

                    @foreach($changelogs as $changelog)
                        <h1 id="{{ $changelog['anchor'] }}">
                            <a href="{{ '#' . $changelog['anchor'] }}">{{ $changelog['title'] }}</a>
                        </h1>
                        <small>{{ $changelog['date'] }}</small>
                        <br>
                        <div>{!! $changelog['content'] !!}</div>
                        <br>
                        <hr>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
