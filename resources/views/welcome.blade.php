<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>

    <body>
            <button id="b1"> Login as User 1 </button>
        <br>
            <button id="b2"> Login as User 2 </button>
        <br>
        <a href="{{ route('logout') }}">
            <button> Logout </button>
        </a>

        @if(Auth::check())
            Logged in as {{Auth::user()->name}}
        @endif

    </body>
</html>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous">
</script>

<script>
    $('#b1').click(function(){
        $.ajax({
            method:'POST',
            url: '{{ route("login") }}',
            data:{id:1},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                location.reload();
            }
        });
    });

    $('#b2').click(function(){
        $.ajax({
            method:'POST',
            url: '{{ route("login") }}',
            data:{id:2},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                location.reload();
            }
        });
    });
</script>
