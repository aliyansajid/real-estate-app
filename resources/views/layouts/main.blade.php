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
    <header class="jumbotron bg-theme-v5">
		<div class="bg-overlay"></div>
		<nav class="navbar navbar-hover navbar-expand-lg navbar-soft navbar-transparent">
			<div class="container">
				<a class="navbar-brand" href="homepage-v1.html">
					<img src="images/logo-blue.png" alt="" />
					<img src="images/logo-blue-stiky.png" alt="" />
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
					<div class="top-search navigation-shadow">
						<div class="container">
						<div class="input-group">
							<form action="#">
								<div class="row no-gutters mt-3">
									<div class="col">
										<input
											class="form-control border-secondary border-right-0 rounded-0"
											type="search"
											value=""
											placeholder="Search "
											id="example-search-input4"
										/>
									</div>
									<div class="col-auto">
										<a class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" href="search-result.html">
											<i class="fa fa-search"></i>
										</a>
									</div>
								</div>
							</form>
						</div>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<div class="wrap__intro d-flex align-items-md-center">
			<div class="container">
				<div class="row align-items-center justify-content-start flex-wrap">
					<div class="col-lg-12 mx-auto">
						<div class="wrap__intro-heading" data-aos="fade-up">
							<h1 class="text-capitalize">Find your dream house</h1>
							<p>
								Your Property, Our Priority and From as low as $10 per day with limited time offer discounts
							</p>

							<div class="bg__overlay-black p-4">
								<div class="search__property">
									<div class="position-relative">
										<ul class="nav nav-tabs nav-tabs-02 mb-3 justify-content-start" id="pills-tab" role="tablist">
											<li class="nav-item mr-1">
												<a class="nav-link active" id="buy-tab" data-toggle="pill" href="#buy" role="tab" aria-controls="buy" aria-selected="true" onclick="setStatus('sale')">Buy</a>
											</li>
											<li class="nav-item mr-1">
												<a class="nav-link" id="rent-tab" data-toggle="pill" href="#rent" role="tab" aria-controls="rent" aria-selected="false" onclick="setStatus('rent')">Rent</a>
											</li>
										</ul>
										<div class="tab-content" id="pills-tabContent">
											<div class="tab-pane fade active show" id="buy" role="tabpanel" aria-labelledby="buy-tab">
												<div class="search__container">
													<form action="/listing" method="GET">
														<div class="row input-group no-gutters">
															<div class="col-lg-2">
																<select class="select_option form-control" name="type">
																	<option data-display="Property Type" value="">Property Type</option>
																	<option value="house">House</option>
																	<option value="apartment">Apartment</option>
																	<option value="commercial">Commercial</option>
																	<option value="villa">Villa</option>
																	<option value="land">Land</option>
																	<option value="others">Others</option>
																</select>
															</div>

															<div class="col-lg-2">
																<select class="select_option form-control" name="area">
																	<option data-display="Area" value="">Area</option>
																	<option value="544.5">2 Marla</option>
																	<option value="816.75">3 Marla</option>
																	<option value="1361.25">5 Marla</option>
																	<option value="2178">8 Marla</option>
																	<option value="2722.5">10 Marla</option>
																	<option value="4083.75">15 Marla</option>
																	<option value="5445">20 Marla</option>
																	<option value="8167.5">30 Marla</option>
																	<option value="10890">40 Marla</option>
																	<option value="13612.5">50 Marla</option>
																</select>
															</div>

															<div class="col-lg-2">
																<select class="select_option form-control" name="bedrooms">
																	<option data-display="Bedrooms" value="">Bedrooms</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																	<option value="8">8</option>
																	<option value="9">9</option>
																</select>
															</div>

															<div class="col-lg-2">
																<select class="select_option form-control" name="bathrooms">
																	<option data-display="Bathrooms" value="">Bathrooms</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																</select>
															</div>

															<div class="col-lg-2">
																<select class="select_option form-control" name="location">
																	<option data-display="Location" value="">Location</option>
																	@foreach ($cities as $city)
																		<option value="{{ $city->city }}">{{ $city->city }}</option>
																	@endforeach
																</select>
															</div>

															<input type="hidden" name="status" id="status" value="sale">

															<div class="col-lg-2 input-group-append">
																<button class="btn btn-primary btn-block" type="submit">
																	<i class="fa fa-search"></i>
																	<span class="ml-1 text-uppercase">search</span>
																</button>
															</div>
														</div>
													</form>
												</div>
											</div>

											<div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
												<div class="search__container">
													<form action="/listing" method="GET">
														<div class="row input-group no-gutters">
															<div class="col-lg-2">
																<select class="select_option form-control" name="type">
																	<option data-display="Property Type" value="">Property Type</option>
																	<option value="house">House</option>
																	<option value="apartment">Apartment</option>
																	<option value="commercial">Commercial</option>
																	<option value="villa">Villa</option>
																	<option value="land">Land</option>
																	<option value="others">Others</option>
																</select>
															</div>

															<div class="col-lg-2">
																<select class="select_option form-control" name="area">
																	<option data-display="Area" value="">Area</option>
																	<option value="544.5">2 Marla</option>
																	<option value="816.75">3 Marla</option>
																	<option value="1361.25">5 Marla</option>
																	<option value="2178">8 Marla</option>
																	<option value="2722.5">10 Marla</option>
																	<option value="4083.75">15 Marla</option>
																	<option value="5445">20 Marla</option>
																	<option value="8167.5">30 Marla</option>
																	<option value="10890">40 Marla</option>
																	<option value="13612.5">50 Marla</option>
																</select>
															</div>

															<div class="col-lg-2">
																<select class="select_option form-control" name="bedrooms">
																	<option data-display="Bedrooms" value="">Bedrooms</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																	<option value="8">8</option>
																	<option value="9">9</option>
																</select>
															</div>

															<div class="col-lg-2">
																<select class="select_option form-control" name="bathrooms">
																	<option data-display="Bathrooms" value="">Bathrooms</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																</select>
															</div>

															<div class="col-lg-2">
																<select class="select_option form-control" name="location">
																	<option data-display="Location" value="">Location</option>
																	@foreach ($cities as $city)
																		<option value="{{ $city->city }}">{{ $city->city }}</option>
																	@endforeach
																</select>
															</div>

															<input type="hidden" name="status" id="status" value="rent">

															<div class="col-lg-2 input-group-append">
																<button class="btn btn-primary btn-block" type="submit">
																	<i class="fa fa-search"></i>
																	<span class="ml-1 text-uppercase">search</span>
																</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </header>

    @yield('content')

    <section class="cta-v1 py-5">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-9">
					<h2 class="text-uppercase text-white">Looking To Sell Or Rent Your Property?</h2>
					<p class="text-capitalize text-white">
						We Will Assist You In The Best And Comfortable Property Services For You
					</p>
				</div>
				<div class="col-lg-3">
					<a href="{{ route('contact') }}" class="btn btn-light text-uppercase">
						request a quote <i class="fa fa-angle-right ml-3 arrow-btn"></i>
					</a>
				</div>
			</div>
		</div>
    </section>

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
	<script>
		let status = 'sale';
		function setStatus(newStatus) {
			status = newStatus;
			document.getElementById('status').value = status;
		}
	</script>
</body>
</html>
