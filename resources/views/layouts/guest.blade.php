<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">

	<title>{{ config('app.name', 'Laravel') }}</title>
	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
	<!-- Styles -->
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
	@stack('styles')
	<!-- Scripts -->
	<script type="application/javascript" src="{{ mix('js/vendor.js') }}" defer></script>
	<script type="application/javascript" src="{{ mix('js/index.js') }}" defer></script>
	@livewireStyles
	<!-- Scripts -->
	@stack('scripts')
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
	<!-- Page Content -->
	<main>
	{{ $slot }}
	</main>
</div>
@livewireScripts
</body>
</html>
