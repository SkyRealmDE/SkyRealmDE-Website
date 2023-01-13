<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/stats.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h1 class="font-sans">Statistiken für {{ $user->name }}</h1>

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
                                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-100">Rang</dt>
                                            <dd class="order-1 text-5xl font-extrabold text-orange-600">{{ $user->rank }}</dd>
                                        </div>
                                        <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-100">XP</dt>
                                            <dd class="order-1 text-5xl font-extrabold text-orange-600">{{ $user->xp }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
