<x-layouts.app>

    <div class="h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-sm bg-white rounded-xl shadow-lg p-6 space-y-6">
            <div class="text-center space-y-2">
                <h2 class="text-2xl font-bold text-gray-900">Join KomentarKuy</h2>
                <p class="text-gray-500 text-sm">Start your journey with us</p>
            </div>

            <form class="space-y-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="name@example.com" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="••••••••" required>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                    <input type="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="••••••••" required>
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all">
                    Create Account
                </button>
            </form>

            <p class="text-sm text-center text-gray-500">
                Already registered?
                <a href="{{ route('auth.login') }}" class="text-blue-700 hover:text-blue-800 font-medium">Sign in
                    here</a>
            </p>
        </div>
    </div>

</x-layouts.app>
