 <x-layout>
    <form method="POST" action="/jobs">
         @csrf 
        <input type="text" name="title">
        <input type="text" name="desc">
        <button type="submit">Submit</button>
    </form> 
</x-layout>