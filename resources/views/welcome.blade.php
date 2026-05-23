@extends('layouts.front')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center d-flex align-items-center min-vh-100">
        <div class="container hero-content">
            <div class="row justify-content-center">
                <div class="col-lg-8 animate-fade-up">
                    <div class="badge badge-premium mb-4 d-inline-block">Premium Car Rental</div>
                    <h1 class="hero-title">Experience the Ultimate Driving Journey</h1>
                    <p class="text-muted fs-5 mb-5 mx-auto" style="max-width: 600px;">
                        Rent luxury and sports cars for your special occasions. Easy booking, premium service, and unforgettable experiences.
                    </p>
                    
                    <form action="{{ url('/') }}" method="GET" class="d-flex justify-content-center mb-5">
                        <div class="input-group" style="max-width: 500px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-radius: 50px; overflow: hidden;">
                            <input type="text" name="search" class="form-control form-control-glass border-0" placeholder="Search for your dream car..." value="{{ request('search') }}" style="border-radius: 50px 0 0 50px; padding-left: 25px;">
                            <button class="btn btn-premium" type="submit" style="border-radius: 0 50px 50px 0;">
                                <i class="fas fa-search me-2"></i> Find
                            </button>
                        </div>
                    </form>

                    <div class="d-flex gap-3 justify-content-center">
                        <a href="#cars-section" class="btn btn-premium">View Fleet</a>
                        <a href="#about-section" class="btn btn-outline-premium">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cars Section -->
    <section id="cars-section" class="py-5" style="background-color: var(--primary-bg);">
        <div class="container py-5">
            <div class="text-center mb-5 animate-fade-up">
                <h2 class="font-bold text-dark mb-3" style="font-size: 2.5rem;">Our Premium Fleet</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Choose from our exclusive collection of luxury vehicles tailored for your highest expectations.</p>
            </div>

            <div class="row g-4">
                @forelse($cars as $car)
                    <div class="col-md-6 col-lg-4 animate-fade-up delay-{{ $loop->iteration % 3 * 100 }}">
                        <div class="glass-card h-100">
                            <div class="card-img-wrapper">
                                @if($car->getFirstMediaUrl('cars'))
                                    <img src="{{ $car->getFirstMediaUrl('cars') }}" alt="{{ $car->name }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1503376760302-8a22b7d42294?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Default Car">
                                @endif
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary rounded-pill shadow" style="background: var(--accent-color) !important; color: #000 !important; font-weight: 700;">
                                        Rp {{ number_format($car->price_per_day, 0, ',', '.') }} / day
                                    </span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="card-title text-dark font-bold mb-0">{{ $car->name }}</h4>
                                    <span class="text-muted small">{{ $car->year }}</span>
                                </div>
                                <p class="text-muted mb-3"><i class="fas fa-tag me-2" style="color: var(--accent-color)"></i>{{ $car->brand }}</p>
                                
                                <div class="row text-center mb-4">
                                    <div class="col-6 border-end border-light">
                                        <div class="text-muted small">Transmission</div>
                                        <div class="text-dark fw-bold"><i class="fas fa-cogs me-1 text-muted"></i> Auto</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted small">Seats</div>
                                        <div class="text-dark fw-bold"><i class="fas fa-user-friends me-1 text-muted"></i> 4+</div>
                                    </div>
                                </div>

                                <a href="{{ route('car.show', $car->id) }}" class="btn btn-outline-premium w-100">View Details & Book</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <i class="fas fa-car-crash fa-3x mb-3 opacity-50"></i>
                        <h4>No cars available at the moment.</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about-section" class="py-5" style="background-color: var(--secondary-bg);">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 animate-fade-up">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="About Us" class="img-fluid rounded-4 shadow-lg" style="border: 1px solid var(--glass-border);">
                        <div class="position-absolute bottom-0 end-0 bg-white p-4 rounded-4 shadow-lg m-4 translate-middle-y" style="background: var(--glass-bg) !important; backdrop-filter: blur(10px); border: 1px solid var(--glass-border);">
                            <h3 class="text-dark font-bold mb-0">10+</h3>
                            <p class="text-muted mb-0">Years Experience</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-fade-up delay-100">
                    <div class="badge badge-premium mb-3">About Us</div>
                    <h2 class="font-bold text-dark mb-4" style="font-size: 2.5rem;">Why Choose ITBSCarRental?</h2>
                    <p class="text-muted mb-4 fs-5">We provide more than just a car rental. We deliver an experience of luxury, comfort, and uncompromising safety.</p>
                    
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3" style="background: rgba(124, 58, 237, 0.1) !important;">
                                <i class="fas fa-shield-alt fa-lg" style="color: var(--accent-color)"></i>
                            </div>
                            <div>
                                <h5 class="text-dark mb-1">Fully Insured</h5>
                                <p class="text-muted mb-0 small">All our vehicles come with premium comprehensive insurance.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3" style="background: rgba(124, 58, 237, 0.1) !important;">
                                <i class="fas fa-headset fa-lg" style="color: var(--accent-color)"></i>
                            </div>
                            <div>
                                <h5 class="text-dark mb-1">24/7 Support</h5>
                                <p class="text-muted mb-0 small">Our dedicated team is always ready to assist you anywhere.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3" style="background: rgba(124, 58, 237, 0.1) !important;">
                                <i class="fas fa-gem fa-lg" style="color: var(--accent-color)"></i>
                            </div>
                            <div>
                                <h5 class="text-dark mb-1">Pristine Condition</h5>
                                <p class="text-muted mb-0 small">Every car is meticulously maintained and cleaned before delivery.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact-section" class="py-5" style="background-color: var(--primary-bg); position: relative;">
        <!-- decorative blur -->
        <div style="position: absolute; bottom: 0; left: 0; width: 500px; height: 500px; background: radial-gradient(circle, rgba(124,58,237,0.05) 0%, transparent 70%); z-index: 0;"></div>
        
        <div class="container py-5 position-relative" style="z-index: 1;">
            <div class="text-center mb-5 animate-fade-up">
                <h2 class="font-bold text-dark mb-3" style="font-size: 2.5rem;">Get in Touch</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Have questions or need a custom arrangement? Send us a message and our team will get back to you shortly.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 animate-fade-up delay-100">
                    <div class="glass-card p-4 p-md-5">
                        
                        @if(session('success'))
                            <div class="alert alert-success bg-success bg-opacity-10 border-success text-success mb-4" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-muted mb-2">Your Name</label>
                                        <input type="text" class="form-control form-control-glass @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="John Doe">
                                        @error('name') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-muted mb-2">Your Email</label>
                                        <input type="email" class="form-control form-control-glass @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="john@example.com">
                                        @error('email') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="text-muted mb-2">Message</label>
                                        <textarea class="form-control form-control-glass @error('message') is-invalid @enderror" name="message" rows="5" required placeholder="How can we help you?">{{ old('message') }}</textarea>
                                        @error('message') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-premium px-5 py-3 w-100">
                                        <i class="fas fa-paper-plane me-2"></i> Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
