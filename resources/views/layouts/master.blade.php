<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Electro - HTML Ecommerce Template</title>
		
        @include('partials.css_files')

    </head>
	<body>
        @include('partials.header')
        @include('partials.navigation')

        @yield('content')

		@include('partials.newsletter')
        @include('partials.footer')        

		@include('partials.js_files')
	</body>
</html>
