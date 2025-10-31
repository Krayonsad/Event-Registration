@extends('layouts.master')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-4">Tech & Innovation Summit</h2>
        <p class="text-center text-muted mb-5">
            Dive deeper into sessions on AI, robotics, quantum computing, and future innovations.
        </p>

        <div class="row g-4">
            @foreach ([['AI & Machine Learning', 'Deep insights into artificial intelligence.', 'ai.jpg'], ['Robotics Revolution', 'The rise of automation and robotics.', 'robotics.jpg'], ['Quantum Computing', 'The next frontier of computation.', 'quantum.jpg'], ['Sustainable Tech', 'Innovations for a greener planet.', 'sustainable.jpg'], ['Blockchain & Web3', 'Explore decentralized technologies.', 'blockchain.jpg'], ['AR/VR & Metaverse', 'Immersive experiences and virtual realities.', 'metaverse.jpg']] as $event)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('register_form', ['event' => urlencode($event[0])]) }}"
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
