@extends('layouts.main')

@section('title', 'RetHouse | Real Estate Management System')

@section('content')
    <section class="featured__property ">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">
                            Featured Property
                        </h2>
                        <p class="text-center text-capitalize">Discover exceptional properties with expert service.</p>
                    </div>
                </div>
            </div>
            <div class="featured__property-carousel owl-carousel owl-theme">
                @foreach ($properties as $property)
                    <div class="item">
                        <a href="{{ route('listing.show', ['id' => $property->id]) }}" class="card__link" style="text-decoration: none; color: inherit;">
                            <div class="card__image card__box">
                                <div class="card__image-header h-250">
                                    <div class="ribbon text-capitalize">featured</div>
                                    <img src="{{ !empty($property->images) ? asset('storage/' . json_decode($property->images)[0]) : 'images/default-image.jpg' }}" alt="" class="img-fluid w100 img-transition">
                                    <div class="info"> for {{ $property->purpose }}</div>
                                </div>

                                <div class="card__image-body">
                                    <span class="badge badge-primary text-capitalize mb-2">{{ strtolower($property->property_type) }}</span>
                                    <h6 class="text-capitalize">
                                        {{ $property->title }}
                                    </h6>

                                    <p class="text-capitalize">
                                        <i class="fa fa-map-marker"></i>
                                        {{ $property->address }}, {{ $property->city }}
                                    </p>
                                    <ul class="list-inline card__content">
                                        <li class="list-inline-item">
                                            <span>
                                                baths <br>
                                                <i class="fa fa-bath"></i> {{ $property->bathrooms }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>
                                                beds <br>
                                                <i class="fa fa-bed"></i> {{ $property->bedrooms }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>
                                                area <br>
                                                <i class="fa fa-map"></i> {{ $property->area }} sq ft
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card__image-footer">
                                    <figure>
                                        @if ($property->agent && $property->agent->image)
                                            <img src="{{ asset('storage/' . $property->agent->image) }}" alt="" class="img-fluid rounded-circle">
                                        @else
                                            <img src="{{ asset('images/profile-blog.jpg') }}" alt="" class="img-fluid rounded-circle">
                                        @endif
                                    </figure>
                                    <ul class="list-inline my-auto">
                                        <li class="list-inline-item">
                                            <a href="#">
                                                {{ $property->agent->name }}
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="list-inline my-auto ml-auto">
                                        <li class="list-inline-item">
                                            <h6>
                                                @if($property->purpose == 'sale')
                                                    PKR {{ number_format($property->price, 2) }}
                                                @else
                                                    PKR {{ number_format($property->price_per_month, 2) }} / month
                                                @endif
                                            </h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="home__about bg-theme-v4">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="title__leading">
                        <h2 class="text-capitalize">why choose us?</h2>
                        <p>
                            The first step in selling your property is to get a valuation from local experts. They will
                            inspect your home and take into account its unique features, the area, and market conditions
                            before providing you with the most accurate valuation.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod libero amet, laborum qui nulla
                            quae alias tempora. Placeat voluptatem eum numquam quas distinctio obcaecati quaerat,
                            repudiandae qui! Quia, omnis, doloribus! Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Quod libero amet, laborum qui nulla tempora.
                        </p>
                        <a href="{{ route('about') }}" class="btn btn-primary mt-3 text-capitalize">
                            read more <i class="fa fa-angle-right ml-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">what people say</h2>
                        <p class="text-center text-capitalize">What people say about Walls Property.</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="testimonial owl-carousel owl-theme">
                <div class="item testimonial__block">
                    <div class="testimonial__block-card bg-reviews">
                        <p>
                            Thank you, Walls Property helped me choose my dream home. We were impressed with the build quality, and they are competitively priced.
                        </p>
                    </div>
                    <div class="testimonial__block-users">
                        <div class="testimonial__block-users-img">
                            <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="testimonial__block-users-name">
                            John Doe <br>
                            <span>Owner, Digital Agency</span>
                        </div>
                    </div>
                </div>
                <div class="item testimonial__block">
                    <div class="testimonial__block-card bg-reviews">
                        <p>
                            Thank you, Walls Property helped me choose my dream home. We were impressed with the build quality, and they are competitively priced.
                        </p>
                    </div>
                    <div class="testimonial__block-users">
                        <div class="testimonial__block-users-img">
                            <img src="images/client.png" alt="" class="img-fluid">
                        </div>
                        <div class="testimonial__block-users-name">
                            John Doe <br>
                            <span>Owner, Digital Agency</span>
                        </div>
                    </div>
                </div>
                <div class="item testimonial__block">
                    <div class="testimonial__block-card bg-reviews">
                        <p>
                            Thank you, Walls Property helped me choose my dream home. We were impressed with the build quality, and they are competitively priced.
                        </p>
                    </div>
                    <div class="testimonial__block-users">
                        <div class="testimonial__block-users-img">
                            <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="testimonial__block-users-name">
                            John Doe <br>
                            <span>Owner, Digital Agency</span>
                        </div>
                    </div>
                </div>
                <div class="item testimonial__block">
                    <div class="testimonial__block-card bg-reviews">
                        <p>
                            Thank you, Walls Property helped me choose my dream home. We were impressed with the build quality, and they are competitively priced.
                        </p>
                    </div>
                    <div class="testimonial__block-users">
                        <div class="testimonial__block-users-img">
                            <img src="images/client.png" alt="" class="img-fluid">
                        </div>
                        <div class="testimonial__block-users-name">
                            John Doe <br>
                            <span>Owner, Digital Agency</span>
                        </div>
                    </div>
                </div>
                <div class="item testimonial__block">
                    <div class="testimonial__block-card bg-reviews">
                        <p>
                            Thank you, Walls Property helped me choose my dream home. We were impressed with the build quality, and they are competitively priced.
                        </p>
                    </div>
                    <div class="testimonial__block-users">
                        <div class="testimonial__block-users-img">
                            <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="testimonial__block-users-name">
                            John Doe <br>
                            <span>Owner, Digital Agency</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
