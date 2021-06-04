<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"defer></script>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet"> 

    <title>Algo</title>
</head>
<body>
    <div id="app">

        <header>
            <b-navbar toggleable type="dark" variant="dark">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <b-navbar-brand href="#" v-b-toggle.sidebar-no-header>Choose Algorithm</b-navbar-brand>

                            <md-drawer>
                            </md-drawer>
                        </div>
                    </div>
                </div>
            </b-navbar>
        </header>

        @yield('content')
    </div>
</body>
</html>