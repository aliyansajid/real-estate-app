@extends('layouts.app')

@section('title', 'Listing Detail')

@section('breadcrumb_title', 'Listing Detail')

@section('content')
<section class="single__Detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="slider__image__detail-large owl-carousel owl-theme">
                    @if($listing->images)
                        @foreach(json_decode($listing->images) as $image)
                            <div class="item">
                                <div class="slider__image__detail-large-one">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $listing->title }}" class="img-fluid w-100 img-transition">
                                </div>
                            </div>
                            @endforeach
                    @endif
                </div>

                <div class="slider__image__detail-thumb owl-carousel owl-theme">
                    @if($listing->images)
                        @foreach(json_decode($listing->images) as $image)
                            <div class="item">
                                <div class="slider__image__detail-thumb-one">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $listing->title }}" class="img-fluid w-100 img-transition">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-9 col-lg-9">
                        <div class="single__detail-title mt-4">
                            <h3 class="text-capitalize">{{ $listing->title }}</h3>
                            <p>{{ $listing->address }}, {{ $listing->city }}, {{ $listing->state }} {{ $listing->zip_code }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="single__detail-price mt-4">
                            @if($listing->purpose == 'sale')
                                <h3 class="sale-price text-capitalize text-gray" data-price="{{ $listing->price }}"></h3>
                            @else
                                <h3 class="rental-price text-gray" data-price="{{ $listing->price_per_month }}"></h3>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single__detail-desc">
                            <h6 class="text-capitalize detail-heading">description</h6>
                            <div class="show__more">
                                <p>{{ $listing->description }}</p>
                                <a href="javascript:void(0)" class="show__more-button ">read more</a>
                            </div>
                        </div>

                        <div class="single__detail-features">
                            <h6 class="text-capitalize detail-heading">property details</h6>
                            <div class="property__detail-info">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <ul class="property__detail-info-list list-unstyled">
                                            <li><b>Property ID:</b> {{ $listing->id }}</li>
                                            <li><b>Price:</b>
                                                @if($listing->purpose == 'sale')
                                                    <span class="sale-price text-capitalize text-gray" 
                                                        data-price="{{ $listing->price }}">
                                                    </span>
                                                @else
                                                    <span class="rental-price text-gray"
                                                        data-price="{{ $listing->price_per_month }}">
                                                    </span>
                                                @endif</li>
                                            <li><b>Property Size:</b> {{ $listing->area }} Sq Ft</li>
                                            <li><b>Bedrooms:</b> {{ $listing->bedrooms }}</li>
                                            <li><b>Bathrooms:</b> {{ $listing->bathrooms }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <ul class="property__detail-info-list list-unstyled">
                                            <li><b>No of Garage:</b> 1</li>
                                            <li><b>Year Built:</b> {{ $listing->year_built }}</li>
                                            <li><b>Property Type:</b> {{ $listing->property_type }}</li>
                                            <li><b>Property Status:</b> For {{ $listing->purpose }}</li>
                                            <li><b>Address:</b> {{ $listing->address }}, {{ $listing->city }}, {{ $listing->state }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="single__detail-features">
                            <h6 class="text-capitalize detail-heading">Features</h6>
                            <ul class="list-unstyled icon-checkbox">
                                @if ($listing->features)
                                    @php
                                        $features = json_decode($listing->features, true);
                                    @endphp

                                    @foreach ($features as $feature => $value)
                                        @php
                                            $formattedFeature = ucwords(str_replace('_', ' ', $feature)); 
                                        @endphp

                                        @if (is_numeric($value))
                                            <li>{{ $formattedFeature }}: {{ $value }}</li>
                                        @elseif ($value)
                                            <li>{{ $formattedFeature }}</li>
                                        @endif
                                    @endforeach
                                @else
                                    <li>No features available</li>
                                @endif
                            </ul>
                        </div>

                        @if ($listing->video_link)
                            @php
                                $urlParts = parse_url($listing->video_link);
                                $videoId = basename($urlParts['path']);
                                $queryString = isset($urlParts['query']) ? '?' . $urlParts['query'] : '';
                                $embedUrl = "https://www.youtube.com/embed/{$videoId}{$queryString}";
                            @endphp

                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">Property Video</h6>
                                <div class="single__detail-features-video">
                                    <figure class="mb-0">
                                        <div class="home__video-area text-center">
                                            <iframe 
                                                src="{{ $embedUrl }}" 
                                                class="img-fluid"
                                                allowfullscreen
                                                frameborder="0"
                                                style="width: 100%; height: 400px;">
                                            </iframe>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        @endif

                        <div class="single__detail-features">
                            <h6 class="text-capitalize detail-heading">location</h6>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-map-location-tab" data-toggle="pill"
                                        href="#pills-map-location" role="tab" aria-controls="pills-map-location"
                                        aria-selected="true">
                                        <i class="fa fa-map-marker"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-map-location" role="tabpanel"
                                    aria-labelledby="pills-map-location-tab">
                                    <div id="map-canvas">
                                        <iframe class="h600 w100"
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3317.623645722736!2d72.78408067402263!3d33.74454683391782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfa6bc26bfa2db%3A0x2344c019578abeac!2sCOMSATS%20University%20Islamabad%2C%20Wah%20Campus!5e0!3m2!1sen!2s!4v1735028664951!5m2!1sen!2s"
                                            style="border:0;" allowfullscreen="" aria-hidden="false"
                                            tabindex="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky-top">
                    <div class="profile__agent mb-30">
                        <div class="profile__agent__group">
                            <div class="profile__agent__header">
                                <div class="profile__agent__header-avatar">
                                    <figure>
                                        <img src="{{ asset('storage/' . $listing->agent->image) }}" alt="" class="img-fluid">
                                    </figure>

                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <h5 class="text-capitalize">{{ $listing->agent->name }}</h5>
                                        </li>
                                        <li>
                                            <a href="tel:{{ $listing->agent->phone }}">
                                                <i class="fa fa-phone-square mr-1"></i>
                                                {{ $listing->agent->phone }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:{{ $listing->agent->email }}">
                                                <i class="fa fa-envelope mr-1"></i>
                                                {{ $listing->agent->email }}
                                            </a>
                                        </li>

                                        <li> 
                                            <a href="{{ route('agents.show', ['id' => $listing->agent->id]) }}" class="text-primary">
                                                View My Listing
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="profile__agent__body">
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                                @endif

                                <form action="{{ route('agents.send', $listing->agent->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Your message</label>
                                        <textarea name="message" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary text-capitalize btn-block">
                                            submit <i class="fa fa-paper-plane ml-1"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="similiar__item">
                    <h6 class="text-capitalize detail-heading">
                        Similar Properties
                    </h6>
                    <div class="similiar__property-carousel owl-carousel owl-theme">
                        @foreach ($similarProperties as $property)
                        <div class="item">
                            <div class="card__image">
                                <div class="card__image-header h-250">
                                    @if($property->is_featured)
                                        <div class="ribbon text-capitalize">featured</div>
                                    @endif
                                    <img src="{{ asset('images/'.$property->image) }}" alt="{{ $property->title }}" class="img-fluid w100 img-transition">
                                    <div class="info">{{ $property->purpose }}</div>
                                </div>
                                <div class="card__image-body">
                                    <span class="badge badge-primary text-capitalize mb-2">{{ $property->property_type }}</span>
                                    <h6 class="text-capitalize">
                                        <a href="{{ route('listings.show', $property->id) }}">{{ $property->title }}</a>
                                    </h6>

                                    <p class="text-capitalize">
                                        <i class="fa fa-map-marker"></i>
                                        {{ $property->city }}, {{ $property->state }}
                                    </p>
                                    <ul class="list-inline card__content">
                                        <li class="list-inline-item">
                                            <span>
                                                Baths <br>
                                                <i class="fa fa-bath"></i> {{ $property->bathrooms }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>
                                                Beds <br>
                                                <i class="fa fa-bed"></i> {{ $property->bedrooms }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>
                                                Area <br>
                                                <i class="fa fa-map"></i> {{ $property->area }} sq ft
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card__image-footer">
                                    <figure>
                                        <img src="{{ asset('images/'.$property->agent->image) }}" alt="{{ $property->agent->name }}" class="img-fluid rounded-circle">
                                    </figure>
                                    <ul class="list-inline my-auto">
                                        <li class="list-inline-item">
                                            <a href="#">
                                                {{ $property->agent->name }} <br>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="list-inline my-auto ml-auto">
                                        <li class="list-inline-item">
                                            <h6 class="text-primary">${{ number_format($property->price, 2) }}</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function formatPrice(price) {
        if (price >= 10000000) {
            return (price / 10000000).toFixed(2) + ' Crore';
        } else if (price >= 100000) {
            return (price / 100000).toFixed(2) + ' Lakh';
        } else {
            return price.toLocaleString();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const salePrices = document.querySelectorAll('.sale-price');
        salePrices.forEach(function(priceElement) {
            const price = parseFloat(priceElement.dataset.price);
            priceElement.textContent = 'PKR ' + formatPrice(price);
        });

        const rentalPrices = document.querySelectorAll('.rental-price');
        rentalPrices.forEach(function(priceElement) {
            const price = parseFloat(priceElement.dataset.price);
            priceElement.textContent = 'PKR ' + formatPrice(price) + ' / mo';
        });
    });
</script>

@endsection