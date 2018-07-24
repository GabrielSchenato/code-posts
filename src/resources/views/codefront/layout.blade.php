<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CodePress</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
        <!-- Styles -->
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body {
                padding-top: 54px;
            }

            @media (min-width: 992px) {
                body {
                    padding-top: 56px;
                }
            }</style>
        @yield('stylesheet')
    </head>
    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">CodePress</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        @if (Route::has('login'))
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ Auth::user()->name }}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8">

                    <h1 class="my-4">Latest Posts
                        <small>Your blog in one place...</small>
                    </h1>
                    @yield('content')
                </div>

                <!-- Sidebar Widgets Column -->
                <div class="col-md-4">

                    <!-- Search Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Search</h5>
                        <div class="card-body">

                            <div class="input-group mb-3">

                                <div class="input-group-append">

                                </div>                      
                            </div>

                            {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
                            <div class="input-group">
                                {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Want to find something?']) !!}
                                <span class="input-group-btn">
                                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="card text-white bg-secondary mb-3">
                        <h5 class="card-header">Categories</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-group">
                                        @foreach($categories as $category)
                                        <a href="{{ route('search.category', $category->slug) }}" class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $category->name }}
                                            <span class="badge badge-primary badge-pill">{{ $category->posts_count }}</span>
                                        </a>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <!-- Tags Widget -->
                    <div class="card text-white bg-primary mb-3">
                        <h5 class="card-header">Tags</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-group">
                                        @foreach($tags as $tag)
                                        <a href="{{ route('search.tag', $tag->slug) }}" class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $tag->name }}
                                            <span class="badge badge-primary badge-pill">{{ $tag->posts_count }}</span>
                                        </a>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; CodePress 2018</p>
            </div>
            <!-- /.container -->
        </footer>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
