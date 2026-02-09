@extends('layouts.agent')

@section('title', 'Agent Dashboard')
@section('breadcrumb_title', 'Dashboard')

@section('content')
    <section>
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <a href="{{ route('agent.listings.create') }}" class="btn btn-primary text-capitalize">
                        <i class="fa fa-plus mr-1"></i> Add New Listing
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Property Name</th>
                                    <th>Bedroom</th>
                                    <th>Bathroom</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listings as $listing)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $listing->title }}</td>
                                        <td>{{ $listing->bedrooms }}</td>
                                        <td>{{ $listing->bathrooms }}</td>
                                        <td>{{ $listing->address }},&nbsp;{{ $listing->city }}</td>
                                        <td>PKR {{ $listing->purpose == 'sale' ? number_format($listing->price) : number_format($listing->price_per_month) }}</td>
                                        <td style="width: 120px;">
                                            <a href="{{ route('agent.listings.show', $listing->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('agent.listings.edit', $listing->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{route('agent.listings.delete', $listing->id)}}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
