<x-layouts.app>


    <x-sidebar>

        <x-slot:name>
            {{ $user->name }}
        </x-slot:name>

        <x-slot:email>
            {{ $user->email }}
        </x-slot:email>

        <div class="bg-white h-full border-x border-gray-200 ">
            <div class="flex flex-col items-center justify-center py-10 space-y-4">


                <div class="">
                    <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                        <img src="{{ $user->profile_picture }}" alt="Profile Picture"
                            class="rounded-full w-full h-full object-cover">
                    </div>

                    <div class="flex flex-col items-center">

                        <h1 class="mt-4 text-xl font-semibold">{{ $user->name }}</h1>
                        <p class="text-gray-500">{{ $user->username }}</p>
                    </div>
                </div>

                <div class="flex justify-center gap-4 md:gap-8">

                    <div class="text-center">
                        <h2 class="font-semibold text-2xl">{{ $user->threads->count() }}</h2>
                        <p class="text-gray-500">Threads</p>
                    </div>

                    <div class="text-center">
                        <h2 class="font-semibold text-2xl">{{ $user->likes->count() }}</h2>
                        <p class="text-gray-500">Likes</p>
                    </div>

                    <div class="text-center">
                        <h2 class="font-semibold text-2xl">{{ $user->comments->count() }}</h2>
                        <p class="text-gray-500">Comments</p>
                    </div>

                </div>

                @if ($profile->username = $user->username)
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit Profile</button>
                @endif

                {{-- <h3>Threads List</h3> --}}


                @foreach ($user->threads as $thread)
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
    </x-sidebar>
</x-layouts.app>
