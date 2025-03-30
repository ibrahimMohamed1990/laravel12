<x-layout>
     <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3"> 
        @forelse ($jobs as $job)
           <x-job-card :job="$job" />
        @empty
            <p>No jobs found</p>
        @endforelse
     </div>

     <div class="mm_pagination">
        {{$jobs->links()}}
     </div>

</x-layout>