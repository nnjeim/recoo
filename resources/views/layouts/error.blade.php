<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">

    <title>{{ (isset($title) ? $title . ' | ' : '') . config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Favicons -->
    <link rel="manifest" href="/site.webmanifest" crossorigin="use-credentials">

    @livewireStyles

    <!-- Scripts -->
    <script type="application/javascript" src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<!-- container -->
<div class="flex items-center justify-center min-h-screen bg-gray-100">
	<!-- Page Content -->
	<main>
		{{ $slot }}
	</main>
</div>
@livewireScripts
</body>
</html>
