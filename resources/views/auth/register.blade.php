<x-layout>
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Register    </h2>

    <div class="max-w-lg mx-auto">
        <form method="POST" action="{{route('register.store')}}" class="p-8 bg-white shadow-md rounded">
            @csrf
            <x-inputs.text id="name" name="name" label="Name" :required="true" />
            <x-inputs.text id="email" name="email" label="Email" :required="true" />
            <x-inputs.text id="password" type="password" name="password" label="Password" :required="true" />
            <x-inputs.text id="password_confirmation" type="password" name="password_confirmation" label="Confirm Password" :required="true" />

            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Register
            </button>   
            <p class="text-center">
                Already have an account? <a href="{{route('login')}}" class="text-blue-500">Login</a>
            </p>
        </form>
    </div>
</x-layout>