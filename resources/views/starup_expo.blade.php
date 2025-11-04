@extends('layouts.master')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-4">Startup & Entrepreneurship Expo</h2>
        <p class="text-center text-muted mb-5">
            Pitch, network, and grow with investors and accelerators worldwide.
        </p>

        <div class="row g-4">
            @foreach ([['Showcase and visibility', 'Present your products and services to a large and potential customers.', 'showcase.jpg'], ['Fundraising and investment', 'Get direct opportunities to pitch to investors and generate leads for potential deals.', 'investment.jpg'], ['Networking', 'Connect with other entrepreneurs and potential partners to form collaborations and expand your network.', 'networking.jpg'], ['Feedback and validation', 'Receive immediate, real-time feedback on your offerings to help validate your idea and make necessary improvements.', 'feedback.jpg'], ['Brand building', 'Build your brand\'s image and gain exposure through the event\'s media partners and publications.', 'brand.jpg'], ['Launch new products', 'Use the event as a platform to launch new products and generate excitement and buzz.', 'lunch.jpg']] as $event)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('starups_register', ['event' => urlencode($event[0])]) }}"
                        class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 card-hover">
                            <div class="card-img-container" style="height:200px; overflow:hidden;">
                                <img src="{{ asset('images/' . $event[2]) }}" class="card-img-top" alt="{{ $event[0] }}"
                                    style="object-fit:cover; height:100%; width:100%;">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="fw-bold mt-2">{{ $event[0] }}</h5>
                                <p class="text-muted">{{ $event[1] }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
