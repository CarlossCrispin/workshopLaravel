<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Jekyll v4.1.1" />
    <title>@yield('title') - EscDeCódigo</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sticky-footer-navbar/" /> -->

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
</head>

<body class="d-flex flex-column h-100">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Escuela de código</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/usuarios">Usuarios <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> -->
                </ul>

            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0 mt-5">
        <div class="container-fluid mt-5">
            <div class="row mt-5">
                <div class="col-sm-12 col-md-9">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    @section('sidebar')
                    <ul class="list-group align-self-center">
                        <li class="list-group-item list-group-item-secondary active  list-group-item-action text-center">
                            <h2>Barra lateral</h2>
                        </li>
                        <a class="btn btn-block btn-outline-secondary m-0" href="/usuarios">Users <i class="material-icons float-right mr-5">list</i></a>
                        <a class="btn btn-block btn-outline-secondary m-0" href="/usuarios/4">Show<i class="material-icons float-right mr-5">description</i></a>
                        <a class="btn btn-block btn-outline-secondary m-0" href="/usuarios/5/edit">Edit<i class="material-icons float-right mr-5">edit</i></a>
                        <a class="btn btn-block btn-outline-secondary m-0" href="/saludos/crispin">Hello<i class="material-icons float-right mr-5">message</i></a>
                        <a class="btn btn-block btn-outline-secondary m-0" href="/usuarios/nuevo">New<i class="material-icons float-right mr-5">add</i></a>
                        <a class="btn btn-block btn-outline-secondary m-0" href="/">Salir <i class="material-icons float-right mr-5">clear</i></a>

                    </ul>

                    @show
                </div>
            </div>

        </div>
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted ">Carlos Crispin 2020.</span>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>