@section('twitter:image', "https://skyrealm.de/assets/jobs.png" )
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/jobs.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between bg-gray-700 px-4 py-5 border-b sm:rounded-md border-gray-600 ">
                        <h3 class="text-2xl leading-6 font-medium text-white">Bewerbungen</h3>
                        ({{ count($openJobs) }})
                    </div>

                    <br>

                    <div class="py-1 px-3 bg-gray-500 shadow overflow-hidden sm:rounded-md ">
                        <ul role="list" class="divide-y divide-gray-100 ">
                            @foreach($openJobs as $job)
                            <li class="hover:bg-gray-600 sm:rounded-md transition" style="list-style: none;">
                                <a href="jobs/{{ $job->id }}" class="block">
                                    <div class="px-2 py-4 sm:px-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <p class="text-sm font-black text-[18px] truncate" style="color: {{ $job->color }}">{{ $job->title }}</p>
                                            <div class="flex">
                                            @foreach($job->getTagsAttribute() as $tag)
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    <p class="px-6 inline-flex text-xs leading-5 font-semibold rounded-full border-orange-900 bg-orange-100 text-gray-600">{{ $tag }}</p>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mb-4">
                                            <p class="text-sm font-light text-[15px] text-gray-100 truncate">{{ $job->short_description }}</p>
                                        </div>
                                        <div class="mt-2 sm:flex sm:justify-between">
                                            <div class="sm:flex">
                                                <p class="flex items-center text-sm text-white">
                                                    <i class="fa-solid fa-user-group mr-2"></i> {{ $job->branch }}
                                                </p>
                                                <p class=" flex items-center text-sm text-white sm:ml-5">
                                                    <i class="fa-solid fa-signal-stream mr-2"></i>
                                                    Remote
                                                </p>
                                            </div>
                                            <div class=" flex items-center text-sm text-white ">
                                                <i class="fa-solid fa-calendar-days mr-2 mb-4 "></i>
                                                <p>
                                                    {{ str_replace('-', '.', explode(' ', $job->created_at)[0]) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
