<x-layouts.app>


    <x-sidebar>

        <x-slot:name>
            {{ $user->name }}
        </x-slot:name>

        <x-slot:email>
            {{ $user->email }}
        </x-slot:email>

        <div class="grid grid-cols-1 md:grid-cols-2">

            <div class="space-y-4">

                @if (session('success'))
                    <div id="alert-3" class="flex items-center mx-4 p-4 mt-4 text-green-800 rounded-lg bg-green-50"
                        role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="flex space-x-3 border-b pb-4 border-gray-200 mt-4">
                    <img class="w-8 h-8 rounded-full"
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

                            <div class="flex items-center space-x-1 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span class="text-sm">{{ $thread->comments->count() }}
                                    Comment</span>
                            </div>

                            @if ($thread->user->id === $user->id)
                                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdown-{{ $thread->id }}"
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
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconButton">
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

                <form action="{{ route('comment.store') }}" method="post"
                    class="flex items-center mx-auto px-2 border-b border-gray-200 pb-4">
                    @csrf
                    <img class="w-8 h-8 rounded-full mr-2 hidden md:block"
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">

                    <input type="hidden" name="thread_id" value="{{ $thread->id }}">

                    <div class="relative w-full">
                        <input type="text" name="content" id="content"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-2.5"
                            placeholder="Post your reply" required />
                    </div>
                    <button type="submit"
                        class="flex items-center p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>

                @foreach ($thread->comments as $comment)
                    <a href="">
                        <div class="flex space-x-2 border-b p-4 border-gray-200 hover:bg-gray-50 transition">
                            <img class="w-8 h-8 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                            <div class="space-y-1">
                                <h3 class="font-semibold">{{ $comment->user->name }} <span
                                        class="text-sm font-normal text-gray-400">{{ '@' . $thread->user->username }}</span>
                                </h3>
                                <p class="font-normal text-gray-700">{{ $comment->content }}</p>
                                <p class="text-sm font-normal text-gray-400">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>


                                <div class="flex space-x-4 mt-2">
                                    <form action="{{ route('like') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <button type="submit" class="flex items-center space-x-1 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                fill="{{ $comment->likes()->where('user_id', $user->id)->first() ? 'currentColor' : 'none' }}"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="{{ $comment->likes()->where('user_id', $user->id)->first() ? 'text-red-500' : '' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span class="text-sm">{{ $comment->likes->count() }} Like</span>
                                        </button>
                                    </form>

                                    <a href="" class="flex items-center space-x-1 focus:outline-none">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span
                                            class="text-sm hover:underline transition">{{ $thread->comments->count() }}
                                            Comment</span> --}}
                                    </a>

                                    @if ($comment->user->id === $user->id)
                                        <button id="dropdownMenuIconButton"
                                            data-dropdown-toggle="dropdown-{{ $comment->id }}"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                            type="button">
                                            <svg class="w-2 h-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 4 15">
                                                <path
                                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="dropdown-{{ $comment->id }}"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                                            <ul class="py-2 text-sm text-gray-700"
                                                aria-labelledby="dropdownMenuIconButton">
                                                <li>
                                                    <a href="{{ route('comment.edit', ['id' => $comment->id]) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('comment.destroy', ['id' => $comment->id]) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">Remove</a>
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

            <div class="border-l border-gray-200 hidden md:block px-4 space-y-4">

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
