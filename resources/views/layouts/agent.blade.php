<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header class="shadow-sm">
        <div class="topbar d-none d-sm-block">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="topbar-left">
                            <div class="topbar-text">
                                {{ \Carbon\Carbon::now()->format('l, F j, Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="list-unstyled topbar-right">
                            <ul class="topbar-sosmed">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-blue-stiky.png') }}" alt="" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav99">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main_nav99">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listing') }}">Listing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('agents') }}">Agents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                        @auth
							<li class="nav-item">
								<a class="nav-link" href="{{ route('profile') }}">Profile</a>
							</li>
                            <li class="nav-item">
								<a class="nav-link" href="{{ route('dashboard.agent') }}">Dashboard</a>
							</li>
						@endauth
                    </ul>
                    <ul class="navbar-nav">
						@guest
						<li>
							<a href="{{ route('login') }}" class="btn btn-primary text-capitalize">
								<i class="fa fa-sign-in mr-1"></i> login
							</a>
						</li>
						@else
						<li>
							<a href="{{ route('logout') }}" class="btn btn-danger text-capitalize">
								<i class="fa fa-sign-in mr-1"></i> logout
							</a>
						</li>
						@endguest
					</ul>
                </div>
            </div>
        </nav>
        <div class="bg-theme-overlay">
            <section class="section__breadcrumb">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8 text-center">
                            <h2 class="text-capitalize text-white">@yield('breadcrumb_title', 'Default Title')</h2>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </header>
    
    @yield('content')

    <footer>
        <div class="bg__footer-bottom">
            <div class="container">
              <div class="row justify-content-center">
                  <div class="col-md-12 text-center">
                      <span>
                          © <?php echo date("Y"); ?> RetHouse - All Rights Reserved
                      </span>
                  </div>
              </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
