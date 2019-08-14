<html lang="pt-br">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>ListenX - musics</title>
   <link href="{{ URL::to('assets/css/font-awesome.min.css') }}" rel="stylesheet">
   <link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ URL::to('assets/css/styles.min.css') }}" rel="stylesheet">
</head>
<body class="pushwrap" cz-shortcut-listen="true">
   <div class="container-full">

      @yield('content')

   </div>
   <script src="{{ URL::to('assets/js/jquery.min.js') }}"></script>
   <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
   <script src="{{ URL::to('assets/js/wavesurfer.min.js') }}"></script>
   <script src="{{ URL::to('assets/js/main.js') }}"></script>
</body>
</html>
