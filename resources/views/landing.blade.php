@extends('layouts.master')

@section('title', 'Home - Landing Page')

@section('content')

<!-- Hero Section -->
<section class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Welcome to Our Landing Page</h1>
        <p class="lead mb-4">Empowering your business with next-gen technology.</p>
        <a href="#" class="btn btn-light btn-lg rounded-pill px-5 shadow">Get Started</a>
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
