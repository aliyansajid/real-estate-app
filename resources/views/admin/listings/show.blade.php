@extends('layouts.admin')

@section('title', 'Property Details')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $listing->title }}</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs" id="propertyTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="features-tab" data-toggle="tab" href="#features" role="tab" aria-controls="features" aria-selected="false">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="propertyTabsContent">
                                    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <ul class="list-unstyled">
                                                    <li class="mb-1"><strong>Description:</strong> {{ $listing->description }}</li>
                                                    <li class="mb-1"><strong>Area:</strong> {{ $listing->area }} sq ft</li>
                                                    <li class="mb-1"><strong>Bedrooms:</strong> {{ $listing->bedrooms }}</li>
                                                    <li class="mb-1"><strong>Bathrooms:</strong> {{ $listing->bathrooms }}</li>

                                                    @if($listing->garage == 'yes')
                                                        <li class="mb-1"><strong>Garage:</strong> {{ $listing->garage_count }} garage(s), {{ $listing->garage_size }} sq.ft</li>
                                                    @elseif($listing->garage == 'no')
                                                        <li class="mb-1"><strong>Garage:</strong> No garage</li>
                                                    @endif

                                                    <li class="mb-1"><strong>Year Built:</strong> {{ $listing->year_built }}</li>

                                                    @if($listing->purpose == 'sale')
                                                        <li class="mb-1"><strong>Price:</strong> ${{ number_format($listing->price) }}</li>
                                                    @elseif($listing->purpose == 'rent')
                                                        <li class="mb-1"><strong>Rent:</strong> ${{ number_format($listing->price_per_month) }}</li>
                                                    @else
                                                        <li class="mb-1"><strong>Price:</strong> Not specified</li>
                                                    @endif

                                                    <li class="mb-1"><strong>Address:</strong> {{ $listing->address }}, {{ $listing->city }}, {{ $listing->state }}, {{ $listing->zip_code }}</li>
                                                    <li class="mb-1"><strong>Property Type:</strong> {{ $listing->property_type }}</li>
                                                    <li class="mb-1"><strong>Video Link:</strong> <a href="{{ $listing->video_link }}" target="_blank">Watch Video</a></li>
                                                    <li class="mb-1"><strong>Location Link:</strong> <a href="{{ $listing->location_link }}" target="_blank">View Location</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
                                        @if($listing->features)
                                            <ul class="list-unstyled mt-3">
                                                @php
                                                    $features = json_decode($listing->features, true);
                                                @endphp

                                                @foreach($features as $feature => $value)
                                                    @php
                                                        $formattedFeature = ucwords(str_replace('_', ' ', $feature)); 
                                                    @endphp

                                                    @if (is_numeric($value)) <!-- If the feature value is a number -->
                                                        <li class="mb-1"><strong>{{ $formattedFeature }}:</strong> {{ $value }}</li>
                                                    @elseif ($value) <!-- If the feature is checked (boolean) -->
                                                        <li class="mb-1">{{ $formattedFeature }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No features available</p>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                        @if($listing->images)
                                            <div class="row mt-3">
                                                @foreach(json_decode($listing->images) as $index => $image)
                                                    <div class="col-md-4 mb-3">
                                                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid" alt="Property Image">
                                                    </div>
                                                    @if(($index + 1) % 3 == 0)
                                                        </div><div class="row">
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            <p>No images available</p>
                                        @endif
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
@endsection
