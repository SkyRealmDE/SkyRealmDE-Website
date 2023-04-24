<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/stats.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <div class="flex items-center space-x-4 lg:space-x-6">
                        <img class="w-16 h-16 rounded-full lg:w-20 lg:h-20" src="https://visage.surgeplay.com/bust/{{$user->uuid}}" alt="">
                        <div class="font-medium text-lg leading-6 space-y-1">
                            <h3>{{ $user->name }}</h3>
                            <p class="text-orange-600">{{ $user->rank }}</p>
                        </div>
                    </div>

                    <br>
                    <div class="mt-10 pb-12 sm:pb-16">
                        <div class="relative">
                            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="max-w-8xl mx-auto">
                                    <dl class="rounded-lg bg-gray-700 shadow-lg sm:grid sm:grid-cols-3">
                                        <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-100">Coins</dt>
                                            <dd class="order-1 text-5xl font-extrabold text-orange-600">{{ $user->coins }}</dd>
                                        </div>
                                        <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-100">Onlinetime</dt>
                                            <dd class="order-1 text-5xl font-extrabold text-orange-600">{{ $user->statistics->onlineTime }}</dd>
                                        </div>
                                        <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-100">XP</dt>
                                            <dd class="order-1 text-5xl font-extrabold text-orange-600">
                                                <span class="text-[#30ff29]">{{ getLevel($user->xp) }}</span>
                                                <span class="text-[#f1c40f]"><i class="fa-solid fa-star pr-[2px]"></i>{{ $user->prestigeLevel }}</span>
                                            </dd>
                                            <dd class="order-1 text-5xl font-extrabold text-orange-600">{{ $user->xp }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-600">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-black text-white uppercase tracking-wider">Statistik</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-black text-white uppercase tracking-wider">Wert</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->statistics->asList as $entry)
                                                @if($loop->even)
                                                    <tr class="bg-gray-800">
                                                @else
                                                    <tr class="bg-gray-700">
                                                @endif
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ array_search($entry, $user->statistics->asList) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $entry }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
