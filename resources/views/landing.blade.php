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
                            <img src="{{ asset('images/event' . $i . '.jpg') }}" class="d-block w-100 event-image"
                                alt="Event {{ $i }}">
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
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                        class="{{ $i == 0 ? 'active' : '' }}"></button>
                @endfor
            </div>
        </div>
    </section>

    <!-- Features Section -->
   <section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase position-relative d-inline-block pb-2">
                Our Featured Events
            </h2>
            <div class="underline-2 mx-auto mt-1 mb-3"></div>
            <p class="text-muted fs-5 px-3">
                Discover our exciting upcoming events designed to connect, innovate, and inspire.
            </p>
        </div>

        <!-- Carousel wrapper -->
     <div class="event-carousel-wrapper">
    <div class="event-carousel d-flex gap-2">

        @for ($i = 1; $i <= 5; $i++)
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 flex-shrink-0 card-hover">
                <div class="card-img-container position-relative">
                    <img src="{{ asset('images/event'.$i.'.jpg') }}" class="card-img-top" alt="Event {{$i}}">
                    <!-- Hover overlay -->
                    <div class="card-overlay d-flex flex-column justify-content-center align-items-center text-center p-2">
                        <h5 class="fw-bold text-white">Event Title {{$i}}</h5>
                        <p class="text-white">Short description for event {{$i}} goes here.</p>
                    </div>
                </div>
            </div>
        @endfor

    </div>
</div>



</section>
@endsection