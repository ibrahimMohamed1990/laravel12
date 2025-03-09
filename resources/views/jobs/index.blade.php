 <x-layout> 
    <x-slot name="title">Jobs</x-slot>
    <ul>
        @foreach ($jobs as $job)
            <li>
                 {{ $job }} 
            </li>
        @endforeach
    </ul>
</x-layout>