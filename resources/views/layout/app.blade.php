<html>
   <head>
      <title>@yield('title')</title>
      {{-- include all css files and meta tags --}}
      @yield('header')
    </head>
    <body>
		<div id="wrapper">
			{{-- side bar navgation --}}
			@yield('sidebar')
		    <!-- Page Content -->
		    <div id="page-wrapper">
		        <div class="container-fluid">
		            <div class="row">
		                <div class="col-lg-12">
		                    <h1 class="page-header">@yield('pagetitle')</h1>
		                </div>
		            </div>
		            <!-- ... Your content goes here ... -->
		            @yield('content')
		        </div>
		    </div>

		</div>
		{{-- include all js files --}}
		@yield('footer')
	</body>
</html>
