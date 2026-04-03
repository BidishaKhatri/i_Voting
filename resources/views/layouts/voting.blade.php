<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>i-Voting System</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--automatically generates a unique CSRF token for the user session.-->

</head>

<body>

    <div class="top-banner">

        <div class="banner-left">
            <img src="{{ asset('css/images/logo.jpg') }}" class="logo">
            <h1>VoteNepal</h1>
        </div>

        <div class="banner-right">
            <h2>Secure Online Voting for Nepal</h2>
            <p>Vote from Anywhere, Anytime!</p>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container mt-4">

        @yield('content')

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page-specific scripts -->
    @yield('scripts')

</body>

</html>
