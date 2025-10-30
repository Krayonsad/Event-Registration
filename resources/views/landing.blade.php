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

            <div class="row g-4 justify-content-center">

                <!-- Card 1 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 card-hover">
                        <div class="card-img-container">
                            <img src="{{ asset('images/event1.jpg') }}" class="card-img-top" alt="Event 1">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Tech Innovation Summit</h5>
                            <p class="text-muted">Explore the future of technology with experts worldwide.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 card-hover">
                        <div class="card-img-container">
                            <img src="{{ asset('images/event2.jpg') }}" class="card-img-top" alt="Event 2">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Startup Connect</h5>
                            <p class="text-muted">Join entrepreneurs and investors for collaboration.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 card-hover">
                        <div class="card-img-container">
                            <img src="{{ asset('images/event3.jpg') }}" class="card-img-top" alt="Event 3">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Energy Forum</h5>
                            <p class="text-muted">Discuss the sustainable solutions for a greener planet.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 card-hover">
                        <div class="card-img-container">
                            <img src="{{ asset('images/event4.jpg') }}" class="card-img-top" alt="Event 4">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="fw-bold">AI & Data Conference</h5>
                            <p class="text-muted">Experience the latest innovations in AI and data science.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 card-hover">
                        <div class="card-img-container">
                            <img src="{{ asset('images/event5.jpg') }}" class="card-img-top" alt="Event 5">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Green Future Expo</h5>
                            <p class="text-muted">Promoting sustainability and environmental innovation.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
