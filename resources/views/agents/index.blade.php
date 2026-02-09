@extends('layouts.app')

@section('title', 'Agents')

@section('breadcrumb_title', 'Agents')

@section('content')
<section class="profile__agents">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="products__filter mb-30">
                    <div class="products__filter__group">
                        <div class="products__filter__header">
                            <h5 class="text-center text-capitalize">find agents</h5>
                        </div>
                        
                        <div class="products__filter__body">
                            <form method="GET" action="{{ route('agents') }}">
                                <div class="form-group">
                                    <label>Agent name</label>
                                    <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{ request('name') }}">
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="select_option wide" name="city">
                                        <option name="city" data-display="All City" value="" {{ request('city') == '' ? 'selected' : '' }}>All Cities</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                                {{ $city }}
                                            </option>
                                        @endforeach
                                    </select>
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
            <div class="col-lg-8">
                <div class="row no-gutters">
                    @forelse($agents as $agent)
                        <div class="col-lg-12 cards {{ $loop->first ? 'mt-0' : '' }}">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <a href="{{ route('agents.show', $agent->id) }}" class="profile__agents-avatar">
                                        @if($agent->image)
                                            <img src="{{ asset('storage/' . $agent->image) }}" alt="{{ $agent->name }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="img-fluid">
                                        @endif
                                        <div class="total__property-agent">{{ $agent->listings_count }} listings</div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-6 my-auto">
                                    <div class="profile__agents-info">
                                        <h5 class="text-capitalize">
                                            <a href="{{ route('agents.show', $agent->id) }}" target="_blank">{{ $agent->name }}</a>
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
                    @empty
                        <p>No agents found.</p>
                    @endforelse         
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
