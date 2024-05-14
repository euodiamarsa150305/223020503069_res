<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #555;
            padding-bottom: 40px;
            margin: 0;
        }

        .navbar {
            background-color: #343a40 !important;
            padding-top: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
            font-size: 24px;
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ccc;
        }

        .navbar-toggler {
            border-color: #fff;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 0 15px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 20px;
            overflow: hidden;
            height: 500px;
            width: 250px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 70%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .film-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .film-price {
            color: #007bff;
            font-size: 16px;
        }

        .film-duration,
        .film-genre,
        .card-text {
            font-size: 14px;
            color: #666;
        }

        /* Hover Effect */
        .card:hover .film-title {
            color: #007bff;
        }

        .card:hover .film-price {
            color: #28a745;
        }

        .card:hover .film-duration {
            color: #dc3545;
        }

        /* Search Form */
        .search-form {
            margin-bottom: 20px;
            max-width: 200px;
        }

        .search-input {
            border-radius: 0px;
        }

        /* Carousel */
        .carousel-item img {
            object-fit: cover;
            height: 300px;
        }

        /* Margin bottom for Carousel */
        #carouselExampleIndicators {
            margin-bottom: 50px;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-link {
            color: #007bff;
            border: 1px solid #007bff;
            margin: 0 2px;
            transition: all 0.3s;
        }

        .pagination .page-link:hover,
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #fff;
            color: #aaa;
            border-color: #ddd;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">CINEMATUKAM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('films.index') }}">Home</a>
                </li>
                <!-- Add Admin Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin') }}">Admin</a>
                </li>
            </ul>
            <!-- Search Form -->
            <form class="form-inline my-2 my-lg-0 mr-2" action="{{ route('films.search') }}" method="GET">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <!-- Genre Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Genre
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('films.searchGenre', ['genre' => 'Action']) }}">Action</a>
                    <a class="dropdown-item" href="{{ route('films.searchGenre', ['genre' => 'Comedy']) }}">Comedy</a>
                    <a class="dropdown-item" href="{{ route('films.searchGenre', ['genre' => 'Drama']) }}">Drama</a>
                    <!-- Add more genre options as needed -->
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('img/banner1.png') }}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/banner2.jpg') }}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/banner3.jpg') }}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- Film Cards -->
<div class="container">
    <div class="row justify-content-center">
        <!-- Iterate through film list -->
        @foreach ($films as $film)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <!-- Film Image -->
                    <img src="{{ asset('img/' . $film->img) }}" class="card-img-top" alt="{{ $film->judul }}">
                    <div class="card-body">
                        <div class="film-details">
                            <!-- Film Title -->
                            <div class="film-title">{{ $film->judul }}</div>
                            <!-- Film Price -->
                            <div class="film-price">Rp {{ number_format($film->harga, 0, ',', '.') }}.000</div>
                            <!-- Film Duration -->
                            <div class="film-duration">Duration: {{ $film->durasi }} minutes</div>
                            <!-- Film Genre -->
                            <div class="film-genre">Genre: {{ $film->genre }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
   <!-- Pagination -->
<div class="pagination">
    <ul class="pagination justify-content-center">
        <!-- Previous Page Button -->
        <li class="page-item {{ ($films->currentPage() == 1) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $films->url(1) }}" tabindex="-1" aria-disabled="true">Previous</a>
        </li>

        <!-- Pagination Elements -->
        @for ($i = 1; $i <= $films->lastPage(); $i++)
            <li class="page-item {{ ($films->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $films->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Page Button -->
        <li class="page-item {{ ($films->currentPage() == $films->lastPage()) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $films->url($films->currentPage() + 1) }}">Next</a>
        </li>
    </ul>
</div>

</div>

<!-- Bootstrap and jQuery Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
