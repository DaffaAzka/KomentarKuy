<x-layouts.app>


    <x-sidebar>

        <x-slot:name>
            {{ $user->name }}
        </x-slot:name>

        <x-slot:email>
            {{ $user->email }}
        </x-slot:email>

        <div class="">

            <div class="px-4 space-y-4">

                <div class="border border-gray-200 rounded-xl p-4 space-y-1.5 mt-4">
                    <h2 class="text-xl font-semibold">Thanks for using our application.</h2>
                    <p class="text-sm font-light text-gray-400">We hope you enjoy your experience. If you have any
                        feedback, please let us know.</p>
                </div>

                <div class="border border-gray-200 rounded-xl p-4 space-y-4">

                    <h2 class="text-xl font-semibold border-b border-gray-200 pb-4">Trending Topics</h2>

                    @foreach ($trendings as $word => $count)
                        <div class="">
                            <p class="text-xs font-light text-gray-400">Trending #{{ $loop->iteration }}</p>
                            <h3 class="text-lg font-medium">
                                <a href="{{ route('dashboard', ['word' => $word]) }}"
                                    class="hover:underline transition">{{ $word }}</a>
                            </h3>
                            <p class="text-xs font-light text-gray-400">{{ $count }} Threads</p>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </x-sidebar>

</x-layouts.app>
