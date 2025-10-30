@extends('layouts.master')

@section('title', 'Home - Landing Page')

@section('content')
<style>
.carousel-img {
    height: 441px;            /* Same height for all slides */
    object-fit: cover;        /* Ensures image covers the area without stretching */
}

.carousel-caption {
    
    top: 78%;
    transform: translateY(-50%);
    
   padding-left: 317px;
    border-radius: 15px;
    max-width: 780px;
    text-align: center;
}

.carousel-caption h2 {
    font-size: 2.5rem;
    font-weight: 700;
}

.carousel-caption p {
    font-size: 1.2rem;
    margin-bottom: 15px;
}

.carousel-caption .btn {
    font-size: 1rem;
}
</style>
<!-- Hero Section -->
<!-- <section class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Welcome to Our Landing Page</h1>
        <p class="lead mb-4">Empowering your business with next-gen technology.</p>
        <a href="#" class="btn btn-light btn-lg rounded-pill px-5 shadow">Get Started</a>
    </div>
</section> -->

<!-- Hero Section with Carousel -->
<section class="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="{{ asset('images/event1.jpg') }}" class="d-block w-100 carousel-img" alt="Event 1">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h2 class="fw-bold">Annual Tech Summit 2025</h2>
                    <p class="lead">Join industry leaders and innovators for a day of networking and insights.</p>
                    <!-- <a href="#" class="btn btn-primary rounded-pill px-4 mt-2">Register Now</a> -->
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="{{ asset('images/event2.jpg') }}" class="d-block w-100 carousel-img" alt="Event 2">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h2 class="fw-bold">Startup Pitch Day</h2>
                    <p class="lead">Present your ideas and connect with potential investors.</p>
                    <!-- <a href="#" class="btn btn-primary rounded-pill px-4 mt-2">Learn More</a> -->
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="{{ asset('images/event3.jpg') }}" class="d-block w-100 carousel-img" alt="Event 3">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h2 class="fw-bold">Workshops & Training</h2>
                    <p class="lead">Hands-on workshops for skill development and learning.</p>
                    <!-- <a href="#" class="btn btn-primary rounded-pill px-4 mt-2">Explore</a> -->
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="carousel-item">
                <img src="{{ asset('images/event4.jpg') }}" class="d-block w-100 carousel-img" alt="Event 4">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h2 class="fw-bold">Networking Evening</h2>
                    <p class="lead">Connect with professionals across industries and domains.</p>
                    <!-- <a href="#" class="btn btn-primary rounded-pill px-4 mt-2">Join Now</a> -->
                </div>
            </div>

            <!-- Slide 5 -->
            <div class="carousel-item">
                <img src="{{ asset('images/event5.jpg') }}" class="d-block w-100 carousel-img" alt="Event 5">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h2 class="fw-bold">Product Launch</h2>
                    <p class="lead">Be the first to witness groundbreaking product innovations.</p>
                    <!-- <a href="#" class="btn btn-primary rounded-pill px-4 mt-2">See Details</a> -->
                </div>
            </div>

            <!-- Slide 6 -->
            <div class="carousel-item">
                <img src="{{ asset('images/event6.jpg') }}" class="d-block w-100 carousel-img" alt="Event 6">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h2 class="fw-bold">Tech Awards Night</h2>
                    <p class="lead">Celebrate excellence and innovation in technology and startups.</p>
                    <!-- <a href="#" class="btn btn-primary rounded-pill px-4 mt-2">Celebrate</a> -->
                </div>
            </div>

        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="5"></button>
        </div>
    </div>
</section>



<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">What We Offer</h2>
            <p class="text-muted">Explore our services and get started quickly</p>
        </div>
        <div class="row g-4 justify-content-center">
            
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 hover-scale">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-person-plus-fill fs-1 text-primary"></i>
                        </div>
                        <h5 class="card-title fw-bold">Register Now</h5>
                        <p class="card-text text-muted">Get started with our services in a few simple steps.</p>
                        <a href="#" class="btn btn-primary rounded-pill px-4">Register</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 hover-scale">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-gear-fill fs-1 text-success"></i>
                        </div>
                        <h5 class="card-title fw-bold">Our Features</h5>
                        <p class="card-text text-muted">Learn more about what we offer.</p>
                        <a href="#" class="btn btn-success rounded-pill px-4">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 hover-scale">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-envelope-fill fs-1 text-danger"></i>
                        </div>
                        <h5 class="card-title fw-bold">Contact Us</h5>
                        <p class="card-text text-muted">Get in touch with our support team.</p>
                        <a href="#" class="btn btn-danger rounded-pill px-4">Contact</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Optional Custom Styles -->
<style>
.hover-scale:hover {
    transform: translateY(-8px);
    transition: all 0.3s ease-in-out;
}
</style>

@endsection
