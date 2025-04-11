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

        <div class="grid grid-cols-1 md:grid-cols-2">

            <div class="space-y-4">

                <div class="">
                    <h3 class="text-2xl font-semibold">Edit Thread</h3>

                    {{-- Form untuk mengedit Thread --}}
                    <form action="{{ route('thread.edit') }}" method="post"
                        class="flex items-center mx-auto px-2 pt-2 pb-4 border-b border-gray-200">
                        @csrf
                        <img class="w-8 h-8 rounded-full mr-2 hidden md:block"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">

                        <div class="relative w-full">
                            <input type="text" name="content" id="content"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-2.5"
                                placeholder="What's happening?" value="{{ $thread->content }}" required />
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
                </div>

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
                                    <form action="" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="flex items-center space-x-1 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span class="text-sm">{{ $comment->likes->count() }} Like</span>
                                        </button>
                                    </form>
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
