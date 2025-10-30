@extends('layouts.master')

@section('title', 'Home - Landing Page')

@section('content')
<!-- Hero Section with Carousel -->
<section class="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">

            @for ($i = 1; $i <= 6; $i++)
                <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                    <div class="position-relative">
                        <img src="{{ asset('images/event' . $i . '.jpg') }}" class="d-block w-100 event-image" alt="Event {{ $i }}">
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                            <h1 class="fw-bold display-4 text-uppercase text-light text-shadow">Our Events</h1>
                            <div class="underline mt-3"></div>
                        </div>
                    </div>
                </div>
            @endfor

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <div class="carousel-indicators">
            @for ($i = 0; $i < 6; $i++)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></button>
            @endfor
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
                        <h4 class="card-title">Register Now</h4>
                        <p class="card-text">Get started with our services in a few simple steps.</p>
                        <a href="#" class="btn btn-primary">Register</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">Our Features</h4>
                        <p class="card-text">Learn more about what we offer.</p>
                        <a href="#" class="btn btn-secondary">Learn More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">Contact Us</h4>
                        <p class="card-text">Get in touch with our support team.</p>
                        <a href="#" class="btn btn-secondary">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
