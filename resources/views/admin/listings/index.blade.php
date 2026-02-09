@extends('layouts.admin')

@section('title', 'Listing')

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
                                            <a href="{{ route('admin.listings.show', $listing->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.listings.edit', $listing->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{route('admin.listings.delete', $listing->id)}}" method="POST" style="display:inline;">
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
