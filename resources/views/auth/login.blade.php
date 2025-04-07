<x-layouts.app>

    <div class="h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-sm bg-white rounded-xl shadow-lg p-6 space-y-6">
            <div class="text-center space-y-3">
                <h2 class="text-2xl font-bold text-gray-900">Welcome Back 👋</h2>
                <p class="text-gray-500 text-sm">Sign in to continue to KomentarKuy</p>
            </div>

            <form class="space-y-4" action="{{ route('login') }}" method="POST">
                <!-- Email Input -->

                @error('error')
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                    role="alert">
                    <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
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
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Email address</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="name@example.com" required>
                </div>

                <!-- Password Input -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="••••••••" required>
                </div>

                <!-- Remember Me Checkbox -->
                {{-- <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                        </div>
                        <label for="remember" class="ms-2 text-sm text-gray-600">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-blue-700 hover:underline">Forgot password?</a>
                </div> --}}

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                    Sign in
                </button>
            </form>

            <!-- Sign Up Link -->
            <p class="text-sm text-center text-gray-500">
                Don't have an account?
                <a href="{{ route('auth.register') }}" class="text-blue-700 hover:text-blue-800 font-medium">Get
                    started</a>
            </p>
        </div>
    </div>

</x-layouts.app>
