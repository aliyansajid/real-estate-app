@extends('layouts.app')

@section('title', 'About Us')

@section('breadcrumb_title', 'About Us')

@section('content')
    <section class="home__about bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title__leading">
                        <h6 class="text-uppercase text-primary mb-3">trusted By thousands</h6>
                        <h2 class="text-capitalize">Your Gateway to Exceptional Properties</h2>
                        <p>
                            Discover a diverse range of properties to buy or rent, tailored to fit your lifestyle and budget. Our platform connects you with verified listings, ensuring a seamless experience whether you're searching for your dream home or the perfect rental.
                        </p>
                        <p>
                            From cozy apartments to luxurious estates, we bring you closer to your ideal property. Explore trusted listings, connect with reliable agents, and make confident decisions with our user-friendly real estate directory.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__image">
                        <div class="about__image-top">
                            <div class="about__image-top-hover">
                                <img src="images/gallery.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="about__image-bottom">
                            <div class="about__image-bottom-hover">
                                <img src="images/gallery3.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="projects__partner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">Our Other Successful Projects</h2>
                        <p class="text-center">
                            Explore our extensive portfolio of successful projects, built in collaboration with trusted brand partners. With decades of experience since 1985, we have earned the trust of countless clients in delivering outstanding real estate solutions.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="projects__partner-logo">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><img src="images/partner-logo6.png" alt="" class="img-fluid"></li>
                            <li class="list-inline-item"><img src="images/partner-logo7.png" alt="" class="img-fluid"></li>
                            <li class="list-inline-item"><img src="images/partner-logo8.png" alt="" class="img-fluid"></li>
                            <li class="list-inline-item"><img src="images/partner-logo1.png" alt="" class="img-fluid"></li>
                            <li class="list-inline-item"><img src="images/partner-logo5.png" alt="" class="img-fluid"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">our Team</h2>
                        <p class="text-center">Meet the top-performing agents of the month, excelling in property listings and client satisfaction.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($agents as $agent)
                    <div class="col-md-4">
                        <div class="wrap-agent">
                            <div class="team-member">
                                <div class="team-img">
                                    <img alt="team member" class="img-fluid w-100" src="{{ asset('storage/' . $agent->image) }}">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <h5>Hi There !</h5>
                                        <p>I am Senior Agent Property</p>
                                        <a class="btn btn-primary" href="{{ url('agents/' . $agent->id) }}">Agent Profile</a>
                                    </div>
                                    <ul class="list-inline s-link mb-0">
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team-title">
                                    <h6>{{ $agent->name }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
