@extends('layouts.app')

@section('title', 'Listings')

@section('breadcrumb_title', 'Listings')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="sticky-top">
                    <div class="products__filter mb-30">
                        <div class="products__filter__group">
                            <div class="products__filter__header">
                                <h5 class="text-center text-capitalize">property filter</h5>
                            </div>
                            <div class="products__filter__body">
                            <form method="GET" action="{{ route('listing') }}">
                                    <div class="form-group">
                                        <select class="wide select_option" name="status">
                                            <option data-display="Property Status" value="">Property Status</option>
                                            <option value="sale">Sale</option>
                                            <option value="rent">Rent</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="wide select_option" name="type">
                                            <option data-display="Property Type" value="">Property Type</option>
                                            <option value="House">House</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Commercial">Commercial</option>
                                            <option value="Villa">Villa</option>
                                            <option value="Land">Land</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="wide select_option" name="bedrooms">
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
                                    <div class="form-group">
                                        <select class="wide select_option" name="bathrooms">
                                            <option data-display="Bathrooms" value="">Bathrooms</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-3">Price range</label>
                                        <div class="filter__price">
                                            <input class="price-range" type="text" name="price_range" placeholder="e.g., 1000-5000" value="{{ request('price_range') }}" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary text-capitalize btn-block"> 
                                            <i class="fa fa-search"></i>
                                            <span class="ml-1 text-uppercase">search</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs__custom-v2">
                        <ul class="nav nav-pills myTab" role="tablist">
                                <li class="list-inline-item mr-auto">
                                    <span class="title-text">Sort by</span>
                                    <div class="btn-group">
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Based Properties
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'newest_first']) }}">Newest First</a>
                                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'oldest_first']) }}">Oldest First</a>
                                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'low_high']) }}">Low to High Price</a>
                                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'high_low']) }}">High to Low Price</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active pills-tab-one" data-toggle="pill" href="#pills-tab-one" role="tab" aria-controls="pills-tab-one" aria-selected="true">
                                        <span class="fa fa-th-list"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pills-tab-two" data-toggle="pill" href="#pills-tab-two" role="tab" aria-controls="pills-tab-two" aria-selected="false">
                                        <span class="fa fa-th-large"></span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="pills-tab-one" role="tabpanel" aria-labelledby="pills-tab-one">
                                    <div class="row">
                                        @foreach ($listings as $property)
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="{{ route('listing.show', $property->id) }}">
                                                                    <img src="{{ !empty($property->images) ? asset('storage/' . json_decode($property->images)[0]) : 'images/default-image.jpg' }}" alt="" class="img-fluid w100 img-transition">
                                                                    <div class="info"> for {{ $property->purpose }}</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">
                                                                <span class="badge badge-primary text-capitalize mb-2">{{ strtolower($property->property_type) }}</span>
                                                                <h6><a href="{{ route('listing.show', $property->id) }}">{{ $property->title }}</a></h6>
                                                                <div class="card__image__body-desc">
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        {{ $property->address }}, {{ $property->city }}
                                                                    </p>
                                                                </div>
                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            beds <br>
                                                                            <i class="fa fa-bed"></i> {{ $property->bedrooms }}
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            baths <br>
                                                                            <i class="fa fa-bath"></i> {{ $property->bathrooms }}
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
                                                        </div>
                                                        <div class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    @if ($property->agent && $property->agent->image)
                                                                        <img src="{{ asset('storage/' . $property->agent->image) }}" alt="" class="img-fluid rounded-circle">
                                                                    @else
                                                                        <img src="{{ asset('images/profile-blog.jpg') }}" alt="" class="img-fluid rounded-circle">
                                                                    @endif
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="#">{{ $property->agent->name }}</a>
                                                                    </li>
                                                                </ul>
                                                                <ul class="list-inline my-auto ml-auto price">
                                                                    <li class="list-inline-item">
                                                                        @if($property->purpose == 'sale')
                                                                            <h6 class="sale-price" data-price="{{ $property->price }}">PKR {{ number_format($property->price, 2) }}</h6>
                                                                        @else
                                                                            <h6 class="rental-price" data-price="{{ $property->price_per_month }}">PKR {{ number_format($property->price_per_month, 2) }} / mo</h6>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-tab-two" role="tabpanel" aria-labelledby="pills-tab-two">
                                    <div class="row">
                                        @foreach ($listings as $property)
                                            <div class="col-md-6 col-lg-6">
                                                <div class="card__image card__box-v1">
                                                    <div class="card__image-header h-250 img-space">
                                                        <img src="{{ !empty($property->images) ? asset('storage/' . json_decode($property->images)[0]) : 'images/default-image.jpg' }}" alt="" class="img-fluid w100 img-transition">
                                                        <div class="info"> for {{ $property->purpose }}</div>
                                                    </div>
                                                    <div class="card__image-body">
                                                        <span class="badge badge-primary text-capitalize mb-2">{{ strtolower($property->property_type) }}</span>
                                                        <h6 class="text-capitalize"><a href="{{ route('listing.show', $property->id) }}">{{ $property->title }}</a></h6>
                                                        <p class="text-capitalize">
                                                            <i class="fa fa-map-marker"></i>
                                                            {{ $property->address }}, {{ $property->city }}
                                                        </p>
                                                        <ul class="list-inline card__content">
                                                            <li class="list-inline-item">
                                                                <span>
                                                                    beds <br/>
                                                                    <i class="fa fa-bed"></i> {{ $property->bedrooms }}
                                                                </span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span>
                                                                    baths <br/>
                                                                    <i class="fa fa-bath"></i> {{ $property->bathrooms }}
                                                                </span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span>
                                                                    area <br/>
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
                                                                <a href="#">{{ $property->agent->name }}</a>
                                                            </li>
                                                        </ul>
                                                        <ul class="list-inline my-auto ml-auto price">
                                                            <li class="list-inline-item">
                                                                @if($property->purpose == 'sale')
                                                                    <h6 class="sale-price" data-price="{{ $property->price }}">PKR {{ number_format($property->price, 2) }}</h6>
                                                                @else
                                                                    <h6 class="rental-price" data-price="{{ $property->price_per_month }}">PKR {{ number_format($property->price_per_month, 2) }} / mo</h6>
                                                                @endif
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
