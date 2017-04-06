<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Scrabble default title')
    </title>

    <meta charset='utf-8'>
    <link href="/css/foobooks.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    <header>
        <img src='/images/scrabbleimage.jpg' style='width:200px' alt='ScrabbleImage'>
    </header>

    <section>
        @yield('content')
    </section>

    <footer>
        &copy; {{ date('Y') }}
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>