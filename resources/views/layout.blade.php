<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
     @vite('resources/css/app.css')
    <title> {{$title ?? 'JobListing'}}  </title>
</head>
<body class="bg-grey-100">
     <x-header /> 
    <main class="container mx-auto mt-10">
        
        {{-- alert messages+ --}}
        @if(session()->has('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
         @if(session()->has('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        {{ $slot }}
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.min.js" integrity="sha512-Atu8sttM7mNNMon28+GHxLdz4Xo2APm1WVHwiLW9gW4bmHpHc/E2IbXrj98SmefTmbqbUTOztKl5PDPiu0LD/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
</body>
</html>