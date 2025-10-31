@extends('layouts.master')

@section('content')
    <div class="container py-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">

                    <h3 class="text-center fw-bold mb-2">{{ $event ?? 'Event Registration' }}</h3>
                    <p class="text-center text-muted mb-1">
                        Thank you for your interest to visit <strong>{{ $event ?? 'the Event' }}</strong>.
                    </p>
                    <p class="text-center text-danger fw-semibold mb-4">
                        IMPORTANT: CHILDREN BELOW 15 YEARS STRICTLY NOT ALLOWED WITHIN THE HALLS
                    </p>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('tech.postForm') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="event_name" value="{{ $event ?? '' }}">

                        <h5 class="fw-bold border-bottom pb-2 mb-3">Personal Details</h5>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name*</label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control"
                                    required placeholder="e.g. John Doe">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email*</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    required placeholder="example@gmail.com">
                            </div>
                        </div>

                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label">Country Code*</label>
                                <select name="contact_country_code" class="form-select select2" required>
                                    <option value="">Select Country Code</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['code'] }}"
                                            {{ $country['code'] == '+91' ? 'selected' : '' }}>
                                            {{ $country['name'] }} ({{ $country['code'] }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mobile Number*</label>
                                <input type="text" name="contact_number" value="{{ old('contact_number') }}"
                                    class="form-control" required placeholder="Enter correct mobile number">
                            </div>
                        </div>

                        <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Company Details</h5>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Company Name*</label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}"
                                    class="form-control" required placeholder="e.g. TechNova Pvt. Ltd.">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation" value="{{ old('designation') }}"
                                    class="form-control" placeholder="e.g. Software Engineer">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Industry</label>
                                <input type="text" name="industry" value="{{ old('industry') }}" class="form-control"
                                    placeholder="e.g. Information Technology">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Address*</label>
                                <textarea name="address_line" rows="2" class="form-control" required
                                    placeholder="e.g. 123 Business Park, Sector 21, Noida">{{ old('address_line') }}</textarea>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">City*</label>
                                <input type="text" name="city" value="{{ old('city') }}" class="form-control"
                                    required placeholder="Enter City">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">State*</label>
                                <input type="text" name="state" value="{{ old('state') }}" class="form-control"
                                    required placeholder="Enter State">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Zipcode*</label>
                                <input type="text" name="zipcode" value="{{ old('zipcode') }}" class="form-control"
                                    required placeholder="Enter Zipcode">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country*</label>
                                <select name="country" class="form-select select2" required>
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['name'] }}"
                                            {{ $country['name'] == 'India' ? 'selected' : '' }}>
                                            {{ $country['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Message</label>
                                <textarea name="message" rows="2" class="form-control" placeholder="Enter Any Message....">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill fw-semibold">
                                Submit Registration
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
