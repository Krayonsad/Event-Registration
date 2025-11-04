@extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">Business & Leadership Forum</h2>
    <p class="text-center text-muted mb-5">
        Empowering industry leaders and entrepreneurs for tomorrow’s success.
    </p>

    <div class="row g-4">
        @foreach ([ 
            ['Leadership Strategies', 'Discover modern approaches to inspire teams and drive organizational success.', 'leadership.jpg'], 
            ['Entrepreneurship Growth', 'Learn how to scale your startup and sustain long-term business expansion.', 'entrepreneurship.jpg'], 
            ['Corporate Innovation', 'Explore how enterprises are embracing innovation to stay competitive.', 'corporate.jpg'], 
            ['Women in Leadership', 'Celebrate and empower women shaping the future of global business.', 'women.jpg'], 
            ['Sustainable Business Models', 'Understand how sustainability drives profitability and purpose.', 'sustainablebuniss.jpg'], 
            ['Digital Transformation in Business', 'See how technology is redefining leadership and operations.', 'digital.jpg'] 
        ] as $event)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('business_register', ['event' => urlencode($event[0])]) }}" class="text-decoration-none text-dark">
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
