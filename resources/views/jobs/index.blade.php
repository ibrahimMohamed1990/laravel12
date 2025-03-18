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
     <style>
        .mm_pagination {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
         .mm_pagination a {
            background-color: #1c398e;
            color: white;
         }
          .mm_pagination span[aria-current="page"] span {
             background-color: gray;
               color: white;
         }
     </style>
</x-layout>