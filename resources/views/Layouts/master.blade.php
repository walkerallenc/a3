<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Palindrome Test title')
    </title>

    <meta charset='utf-8'>
    <link href="/css/acw.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    <header>
     <h2>Palindrome Test</h2>
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