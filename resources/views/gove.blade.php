@extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">Government & Public Innovation</h2>
    <p class="text-center text-muted mb-5">
        Driving change through Digital India, Smart Cities, and policy  innovation.
                                    
    </p>

    <div class="row g-4">
        @foreach ([ 
            ['Digital Governance', 'Explore how digital tools are transforming government operations and transparency.', 'gove.jpg'], 
            ['Smart Cities & Urban Innovation', 'Discover initiatives driving sustainable and tech-enabled urban living.', 'smart.jpg'], 
            ['Policy & Regulatory Reforms', 'Learn how new policies are fostering innovation and inclusive growth.', 'policy.jpg'], 
            ['Public–Private Partnerships (PPP)', 'Understand how collaboration between sectors accelerates development.', 'public.jpg'], 
            ['E-Governance & Citizen Services', 'Examine how technology enhances accessibility and efficiency in public services.', 'citizen.jpg'], 
            ['Data-Driven Decision Making', 'See how governments use data analytics for evidence-based policy design.', 'data.jpg'] 
        ] as $event)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('gove_register', ['event' => urlencode($event[0])]) }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 card-hover">
                        <div class="card-img-container" style="height:200px; overflow:hidden;">
                            <img src="{{ asset('images/' . $event[2]) }}" class="card-img-top" alt="{{ $event[0] }}" style="object-fit:cover; height:100%; width:100%;">
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
