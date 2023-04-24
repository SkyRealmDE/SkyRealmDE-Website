@section('twitter:image', "https://skyrealm.de/assets/stats.png" )
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/stats.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h1 class="font-sans">Statistiken ~ Top 12</h1>

                    <br>

                    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($topUsers as $user)
                            <li class="col-span-1 flex flex-col text-center bg-gray-700 rounded-lg shadow divide-y divide-gray-200">
                                <div class="flex-1 flex flex-col p-8">
                                    <img class="w-32 h-32 flex-shrink-0 mx-auto rounded-full" src="https://visage.surgeplay.com/bust/{{$user->formattedUUID}}" alt="">
                                    <h3 class="mt-6 text-white text-sm font-medium">{{ $user->name }}</h3>
                                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                                        <dt class="sr-only">Rang</dt>
                                        <dd class="mt-3">
                                            <span class="px-2 py-1 text-white text-xs font-medium rounded-full" style="background-color: {{ $user->color }}">{{ $user->rank }}</span>
                                        </dd>
                                        <dd class="mt-3">
                                            <span class="px-2 py-1 text-white text-xs font-extrabold rounded-full"><span class="text-[#30ff29]">{{ getLevel($user->xp) }}</span> <span class="text-[#f1c40f]"><i class="fa-solid fa-star pr-[2px]"></i>{{ $user->prestigeLevel }}</span></span>
                                        </dd>
                                        <dd class="mt-3">
                                            <span class="px-2 py-1 text-white text-xs font-medium rounded-full">{{ $user->coins }} Coins</span>
                                        </dd>
                                        <dd class="mt-3">
                                            <span class="px-2 py-1 text-white text-xs font-medium rounded-full">{{ $user->statistics->onlineTime }} Onlinezeit</span>
                                        </dd>
                                    </dl>
                                </div>
                                <div>
                                    <div class="-mt-px flex divide-x divide-gray-200">
                                        <div class="w-0 flex-1 flex">
                                            <a href="https://de.namemc.com/profile/{{$user->formattedUUID}}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-white font-medium border border-transparent rounded-bl-lg hover:text-gray-100">
                                                <i class="fa-solid fa-signature"></i>
                                                <span class="ml-3">NameMC</span>
                                            </a>
                                        </div>
                                        <div class="-ml-px w-0 flex-1 flex">
                                            <a href="/stats/{{$user->formattedUUID}}" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-white font-medium border border-transparent rounded-br-lg hover:text-gray-100">
                                                <i class="fa-duotone fa-chart-simple"></i>
                                                <span class="ml-3">Stats</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
