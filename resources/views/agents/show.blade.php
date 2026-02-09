@extends('layouts.app')

@section('title', 'Agent Detail')

@section('breadcrumb_title', $agent->name) 

@section('content')
<section class="profile__agents">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row no-gutters">
                    <div class="col-lg-12 cards mt-0">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <a href="#" class="profile__agents-avatar">
                                    @if($agent->image)
                                        <img src="{{ asset('storage/' . $agent->image) }}" alt="{{ $agent->name }}" class="img-fluid">
                                    @else
                                        <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="img-fluid">
                                    @endif
                                    <div class="total__property-agent">{{ $agent->listings_count }} listing{{ $agent->listings_count > 1 ? 's' : '' }}</div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-6 my-auto">
                                <div class="profile__agents-info">
                                    <h5 class="text-capitalize">
                                        <a href="#" target="_blank">{{ $agent->name }}</a>
                                    </h5>
                                    <p class="text-capitalize mb-1">property agent</p>

                                    <ul class="list-unstyled mt-2">
                                        <li>
                                            <a href="tel:+92{{ $agent->phone}}" class="text-capitalize">
                                                <span><i class="fa fa-phone"></i> mobile :</span>
                                                {{ $agent->phone ?? 'N/A' }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:{{ $agent->email }}">
                                                <span><i class="fa fa-envelope"></i>Email :</span>
                                                {{ $agent->email }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span><i class="fa fa-building"></i>City :</span>
                                                {{ $agent->city }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single__detail-features tabs__custom">
                    <h5 class="text-capitalize detail-heading">Agent details</h5>
                    <ul class="nav nav-pills myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active pills-tab-one" data-toggle="pill" href="#pills-tab-one" role="tab" aria-controls="pills-tab-one" aria-selected="true">
                                Description
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pills-tab-two" data-toggle="pill" href="#pills-tab-two" role="tab" aria-controls="pills-tab-two" aria-selected="false">
                                Listing
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pills-tab-one" role="tabpanel" aria-labelledby="pills-tab-one">
                            <div class="single__detail-desc">
                                <h5 class="text-capitalize detail-heading">Hi, nice to meet you</h5>
                                <div class="show__more">
                                    <p>{{ $agent->description }}</p>
                                    <a href="javascript:void(0)" class="show__more-button">read more</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-pane fade" id="pills-tab-two" role="tabpanel" aria-labelledby="pills-tab-two">
                            @forelse($agent->listings as $listing)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card__image card__box-v1">
                                        <div class="row no-gutters">
                                            <div class="col-md-4 col-lg-3 col-xl-4">
                                                <div class="card__image__header h-250">
                                                    <a href="{{ route('listings.show', ['id' => $listing->id]) }}">
                                                        <img src="{{ !empty($listing->images) ? asset('storage/' . json_decode($listing->images)[0]) : 'images/default-image.jpg' }}" alt="" class="img-fluid w100 img-transition">
                                                        <div class="info"> for {{ $listing->purpose }}</div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                <div class="card__image__body">
                                                    <span class="badge badge-primary text-capitalize mb-2">{{ strtolower($listing->property_type) }}</span>
                                                    <h6>
                                                        <a href="{{ route('listings.show', ['id' => $listing->id]) }}">{{ $listing->title }}</a>
                                                    </h6>
                                                    <div class="card__image__body-desc">
                                                        <p class="text-capitalize">
                                                            <i class="fa fa-map-marker"></i>
                                                            {{ $listing->address }}, {{ $listing->city }}
                                                        </p>
                                                    </div>
                                                    <ul class="list-inline card__content">
                                                        <li class="list-inline-item">
                                                            <span>
                                                                Beds <br/>
                                                                <i class="fa fa-bed"></i> 
                                                                {{ $listing->bedrooms }}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                Baths <br/>
                                                                <i class="fa fa-bath"></i>
                                                                {{ $listing->bathrooms }}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                Area <br/>
                                                                <i class="fa fa-map"></i>
                                                                {{ $listing->area }} sq ft
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                <div class="card__image__footer">
                                                    <ul class="list-inline my-auto ml-auto price">
                                                        <li class="list-inline-item">
                                                            @if($listing->purpose == 'sale')
                                                                <h6 class="price" data-price="{{ $listing->price }}">PKR&nbsp;</h6>
                                                            @else
                                                                <h6 class="price" data-price="{{ $listing->price_per_month }}">PKR&nbsp; / mo</h6>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <p class="mt-4">No listings available for this agent.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky-top">
                    <div class="products__filter mb-30">
                        <div class="products__filter__group">
                            <div class="products__filter__header">
                                <h5 class="text-center text-capitalize">Contact</h5>
                            </div>
                            <div class="products__filter__body">
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                                @endif

                                <form action="{{ route('agents.send', $agent->id) }}" method="POST">
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
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formatPrice = (price) => {
            if (price >= 10000000) {
                return (price / 10000000).toFixed(2) + ' Crore';
            } else if (price >= 100000) {
                return (price / 100000).toFixed(2) + ' Lac';
            } else {
                return price.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }
        };

        document.querySelectorAll(".price").forEach(priceElement => {
            const rawPrice = parseFloat(priceElement.getAttribute("data-price"));
            if (!isNaN(rawPrice)) {
                const isRental = priceElement.innerHTML.includes("/ mo");
                const formattedPrice = formatPrice(rawPrice);
                if (isRental) {
                    priceElement.innerHTML = `PKR ${formattedPrice} / mo`;
                } else {
                    priceElement.innerHTML = `PKR ${formattedPrice}`;
                }
            }
        });
    });
</script>

@endsection
