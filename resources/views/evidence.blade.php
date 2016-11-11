<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Head of the file-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GameBet Demo</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:400,700,800" rel="stylesheet">


    </head>

    <body>
        <a style="float:right; margin-right:1em;" href="{{ route('logout') }}">
            <button id="button" class="blue globalRadius"> Logout </button>
        </a>
        <div id="content">
            <!-- File input submission form -->
            <form id="submitForm" method="post" enctype="multipart/form-data" autocomplete="off">
            {!! csrf_field() !!}
            <div id="content-2x" style="top: 150px;">
                <center>
                    <h4 style="color:#000;">GameBet Demo - Evidence Providing</h4>
                    <h1 style="color:#000;">Please provide evidence below to support your opinion!</h1>
                    <input id="evidence" type="file" name="files">
                    
                      <button id="button" class="blue globalRadius challenge" type="button">Submit evidence</button>
                </center>
            </div>
            </form>
        </div>
    </body>
</html>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous">
</script>

<script>
    $('.blue.challenge').click(function(e){
        e.preventDefault();
        var formdata = new FormData(document.getElementById('submitForm'));
        $.ajax({
            method:'POST',
            url: '{{ route("submit") }}',
            data: formdata,
            processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                cache:false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var r = confirm("Evidence submitted! You will be contacted shortly!");
                if(r) 
                    window.location.href = "{{ route('challengePage') }}";
            }
        });
    });

</script>
