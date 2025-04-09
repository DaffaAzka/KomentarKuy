<x-layouts.app>


    <x-sidebar>

        <x-slot:name>
            {{ $user->name }}
        </x-slot:name>

        <x-slot:email>
            {{ $user->email }}
        </x-slot:email>

        <div class="grid grid-cols-1 md:grid-cols-3">

            <div class="bg-white border border-gray-200 rounded-2xl shadow p-4">

                <img src="" alt="" class="w-32 h-32 rounded object-cover">

                <h1>Hello World</h1>

            </div>

        </div>
    </x-sidebar>



</x-layouts.app>

