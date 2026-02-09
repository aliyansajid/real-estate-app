@extends('layouts.admin')

@section('content')
<section>
    <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>User Detail</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Name:</th>
                            <td>{{ $selectedUser->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $selectedUser->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $selectedUser->phone }}</td>
                        </tr>
                        <tr>
                            <th>City:</th>
                            <td>{{ $selectedUser->city }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $selectedUser->created_at->format('d M, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
