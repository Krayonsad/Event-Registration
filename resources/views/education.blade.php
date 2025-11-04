@extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">Education & Research Fair</h2>
    <p class="text-center text-muted mb-5">
      Celebrating innovation in learning, EdTech, and academic excellence.
    </p>

    <div class="row g-4">
        @foreach ([
            ['Global Universities & Admissions', 'Interact with top universities and explore international education pathways.', 'admission.jpg'],
            ['Scholarships & Study Abroad Opportunities', 'Learn about funding options, fellowships, and global student exchange programs.', 'study.jpg'],
            ['Future Skills & EdTech Innovation', 'Discover how AI, VR, and digital tools are transforming learning experiences.', 'innovation.jpg'],
            ['Research Projects & Scientific Exhibitions', 'Showcase groundbreaking research and collaborate with leading scientists.', 'project.jpg'],
            ['Career Guidance & Industry Connect', 'Get expert advice to align education with real-world career opportunities.', 'career.jpg'],
            ['STEM & Innovation Pavilion', 'Experience hands-on experiments, robotics, and science-based learning modules.', 'pav.jpg']
        ] as $event)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ route('education_register', ['event' => urlencode($event[0])]) }}" class="text-decoration-none text-dark">
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
