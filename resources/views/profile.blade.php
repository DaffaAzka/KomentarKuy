<x-layouts.app>


    <x-sidebar>

        <x-slot:name>
            {{ $user->name }}
        </x-slot:name>

        <x-slot:email>
            {{ $user->email }}
        </x-slot:email>

        <x-slot:profile_picture>
            {{ $user->profile_picture }}
        </x-slot:profile_picture>

        <div class="bg-white h-full border-x border-gray-200 ">
            <div class="flex flex-col items-center justify-center py-10 space-y-4">


                <div class="">
                    <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                        <img src="{{ asset('storage/images/' . $profile->profile_picture )}}" alt="Profile Picture"
                            class="rounded-full w-full h-full object-cover">
                    </div>

                    <div class="flex flex-col items-center">

                        <h1 class="mt-4 text-xl font-semibold">{{ $profile->name }}</h1>
                        <p class="text-gray-500">{{ $profile->username }}</p>
                    </div>
                </div>

                <div class="flex justify-center gap-4 md:gap-8">

                    <div class="text-center">
                        <h2 class="font-semibold text-2xl">{{ $profile->threads->count() }}</h2>
                        <p class="text-gray-500">Threads</p>
                    </div>

                    <div class="text-center">
                        <h2 class="font-semibold text-2xl">{{ $profile->likes->count() }}</h2>
                        <p class="text-gray-500">Likes</p>
                    </div>

                    <div class="text-center">
                        <h2 class="font-semibold text-2xl">{{ $profile->comments->count() }}</h2>
                        <p class="text-gray-500">Comments</p>
                    </div>

                </div>

                @if ($profile->username = $user->username)
                    <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit Profile</button>
                @endif

                {{-- <h3>Threads List</h3> --}}


                @foreach ($profile->threads as $thread)
                    <a href="{{ route('thread.show', ['id' => $thread->id]) }}">
                        <div class="flex space-x-2 border-b p-4 border-gray-200 hover:bg-gray-50 transition w-full">
                            <img class="w-8 h-8 rounded-full object-cover"
                                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                            <div class="space-y-1">
                                <h3 class="font-semibold">{{ $thread->user->name }} <span
                                        class="text-sm font-normal text-gray-400">{{ '@' . $thread->user->username }}</span>
                                </h3>
                                <p class="font-normal text-gray-700">{{ $thread->content }}</p>
                                <p class="text-sm font-normal text-gray-400">{{ $thread->created_at->diffForHumans() }}
                                </p>

                                <div class="flex space-x-4 mt-2">
                                    <form action="{{ route('like') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                                        <button type="submit" class="flex items-center space-x-1 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                fill="{{ $thread->likes()->where('user_id', $user->id)->first() ? 'currentColor' : 'none' }}"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="{{ $thread->likes()->where('user_id', $user->id)->first() ? 'text-red-500' : '' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span class="text-sm">{{ $thread->likes->count() }} Like</span>
                                        </button>
                                    </form>

                                    <a href="{{ route('thread.show', ['id' => $thread->id]) }}"
                                        class="flex items-center space-x-1 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span
                                            class="text-sm hover:underline transition">{{ $thread->comments->count() }}
                                            Comment</span>
                                    </a>

                                    @if ($thread->user->id === $user->id)
                                        <button id="dropdownMenuIconButton"
                                            data-dropdown-toggle="dropdown-{{ $thread->id }}"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                            type="button">
                                            <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 4 15">
                                                <path
                                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="dropdown-{{ $thread->id }}"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                                            <ul class="py-2 text-sm text-gray-700"
                                                aria-labelledby="dropdownMenuIconButton">
                                                <li>
                                                    <a href="{{ route('thread.edit', ['id' => $thread->id]) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('thread.destroy', ['id' => $thread->id]) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif


                                </div>

                            </div>
                        </div>
                    </a>
                @endforeach



            </div>

        </div>

        <div wire:ignore.self id="edit-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Profile
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="edit-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <form class="p-4 md:p-5 max-h-[calc(100vh-15rem)] overflow-y-auto" method="post"
                        enctype="multipart/form-data" action="{{ route('profile.update') }}">

                        @csrf
                        @if (session()->has('success'))
                            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
                                role="alert">
                                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">Success!</span> {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        @error('error')
                            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                                role="alert">
                                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">Something wrong!</span> {{ $message }}
                                </div>
                            </div>
                        @enderror

                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Profile
                                    Image</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                    aria-describedby="image" id="image" type="file" name="image">
                                @error('image')
                                    <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label for="username"
                                    class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                <input type="text" name="username" id="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Type Username" required value="{{ $profile->username }}">
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Type Name" required value="{{ $profile->name }}">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center px-4 py-2 bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </x-sidebar>
</x-layouts.app>
