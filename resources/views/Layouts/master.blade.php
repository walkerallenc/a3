<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Foobooks default title')
    </title>

    <meta charset='utf-8'>
    <link href="/css/foobooks.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    <header>
        <img src='/images/scrabbleimage.jpg' style='width:300px' alt='Scrabble Image'>
    </header>

    <section>
        @yield('scrabblewordcontent')
    </section>

    <section>
        @yield('radiobuttonscontent')
    </section>

    <section>
        @yield('includebingocontent')
    </section>

    <section>
        @yield('contentacw')
    </section>

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