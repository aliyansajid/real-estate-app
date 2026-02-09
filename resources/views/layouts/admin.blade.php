<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg-color: #2f353b;
            --primary-color: #3498db;
            --hover-bg-color: #3c444f;
            --text-color: #ecf0f1;
            --active-bg-color: #1abc9c;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg-color);
            color: var(--text-color);
            padding: 20px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .sidebar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 2px solid var(--primary-color);
        }

        .sidebar h3 {
            font-size: 18px;
            margin: 0 0 20px;
            color: var(--text-color);
        }

        .sidebar .menu {
            flex-grow: 1;
        }

        .sidebar .menu-item {
            padding: 10px 0;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-bottom: 10px;
            font-size: 16px;
            color: var(--text-color);
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .sidebar .menu-item:hover {
            background-color: var(--hover-bg-color);
        }

        .sidebar .menu-item.active {
            background-color: var(--active-bg-color);
        }

        .sidebar .menu-item a {
            text-decoration: none;
            color: inherit;
            width: 100%;
            padding-left: 10px;
            display: flex;
            align-items: center;
        }

        .sidebar .menu-item a i {
            margin-right: 15px;
        }

        .sidebar .logout-btn {
            background-color: transparent;
            color: var(--text-color);
            border: none;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .sidebar .logout-btn:hover {
            background-color: var(--hover-bg-color);
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            flex-grow: 1;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="user-info d-flex align-items-center">
            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/profile-blog.jpg') }}" alt="User Image">
            <h3 style="margin-left: 1rem;">{{ $user->name }}</h3>
        </div>
        <div class="menu">
            <div class="menu-item active">
                <a href="{{ route('admin') }}">
                    <i class="fa fa-users"></i> Users
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('admin.listings') }}">
                    <i class="fa fa-list"></i> Listings
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('admin.profile') }}">
                    <i class="fa fa-user"></i> Profile
                </a>
            </div>
        </div>
        <a href="{{ route('admin.logout') }}" class="btn btn-danger text-capitalize">
            <i class="fa fa-sign-in mr-1"></i> logout
        </a>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
