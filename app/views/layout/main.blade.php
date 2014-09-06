<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inpost</title>

    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('font-awesome/css/font-awesome.css'); }}
    {{ HTML::style('css/heroic-features.css'); }}


    @yield('header_scripts')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    @include('layout.navigation')

    <!-- Page Content -->
    <div class="container">

        @yield('jumbotron')

        <hr>

        <div class="row">
            <div class="col-lg-12">
                @yield('content')
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}

    @yield('footer_scripts')

    <!-- created and designed by Piotr Delkowski -->

</body>

</html>
