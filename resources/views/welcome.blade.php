<x-layouts.app>


    <div class="h-screen bg-gray-50 flex items-center justify-center px-4">
        <div class="max-w-4xl text-center space-y-8">
            <div class="space-y-6">
                <h1
                    class="text-4xl md:text-6xl font-extrabold text-black">
                    Welcome To KomentarKuy
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mx-auto md:max-w-xl">
                    Revolutionize your feedback system with real-time collaborative commenting platform.
                </p>
            </div>

            <a href="{{ route('auth.register') }}"
                class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg transition-all duration-300">
                Get Started
                <svg aria-hidden="true" class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>


</x-layouts.app>
