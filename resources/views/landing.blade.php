@extends('layouts.master')

@section('title', 'Home - Landing Page')

@section('content')

    <section class="hero">
        <div class="container">
            <h1 class="display-5 fw-bold">Welcome to Our Landing Page</h1>
            <p class="lead">Empowering your business with next-gen technology.</p>
            <a href="#" class="btn btn-light btn-lg mt-3 px-5 rounded-pill">Get Started</a>
        </div>
    </section>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card">
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
@endsection
