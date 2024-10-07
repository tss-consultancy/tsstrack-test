<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.includes')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div class="row">
        <div class="col-md-2">
        @include('layouts.sidebar')
        </div>
        <div class="col-md-10">
        @include('layouts.navbar')
        @yield('content')
        </div>
    </div>
   
   
    @include('layouts.scripts')
    
</body>
</html>