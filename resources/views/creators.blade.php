<x-layouts.app>


    <x-sidebar>

        <x-slot:name>
            {{ $user->name }}
        </x-slot:name>

        <x-slot:email>
            {{ $user->email }}
        </x-slot:email>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            @for ($i = 0; $i < 6; $i++)
                <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-4 flex justify-center">

                    <div class="space-y-8">
                        <img src="{{ asset('storage/amba.jpeg') }}" alt=""
                            class="rounded-full object-cover shadow">

                        <div class="">
                            <h1 class="text-center text-2xl font-medium">Daffa Islami Azka</h1>
                            <h3 class="text-center text-xl font-normal text-gray-300">Web Developer</h3>

                        </div>
                    </div>

                </div>
            @endfor

        </div>
    </x-sidebar>



</x-layouts.app>
