    <x-layout>
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Login    </h2>

    <div class="max-w-lg mx-auto">
        <form method="POST" action="{{route('login.auth')}}" class="p-8 bg-white shadow-md rounded">
            @csrf
            <x-inputs.text id="email" name="email" label="Email" :required="true" />
            <x-inputs.text id="password" name="password" label="Password" :required="true" />

            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Login
            </button>   
            <p class="text-center">
                Don't have an account? <a href="{{route('register')}}" class="text-blue-500">Register</a>
            </p>
        </form>
    </div>
</x-layout>