@extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">Green Future Expo</h2>
    <p class="text-center text-muted mb-5">
       Building a sustainable tomorrow with renewable energy solutions.
    </p>

    <div class="row g-4">
        @foreach ([
            ['Renewable Energy Innovations', 'Explore the latest breakthroughs in solar, wind, and bioenergy technologies.', 'energy.jpg'],
            ['Sustainable Mobility & Transport', 'Discover how electric vehicles and green logistics are shaping clean transport.', 'transport.jpg'],
            ['Circular Economy & Waste Management', 'Learn how industries are reusing resources to minimize waste and pollution.', 'waste.jpg'],
            ['Green Buildings & Smart Infrastructure', 'See how eco-friendly construction is creating smarter, sustainable cities.', 'greenbuild.jpg'],
            ['Climate Action & Carbon Neutrality', 'Understand how governments and businesses are working toward net-zero goals.', 'action.jpg'],
            ['Eco-Tech & Environmental Startups', 'Meet innovators building technology for a cleaner, greener planet.', 'echo.jpg']
        ] as $event)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('green', ['event' => urlencode($event[0])]) }}" class="text-decoration-none text-dark">
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
