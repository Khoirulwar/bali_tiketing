<section class="page-section" id="fasilitas">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Fasilitas</h2>
            <h3 class="section-subheading text-muted">Fasilitas yang kami tawarkan untuk kenyamanan Anda.</h3>
        </div>
        <!-- Carousel -->
        <div id="facilitiesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($facilities as $index => $facility)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/images/' . $facility->image) }}" class="d-block w-100" alt="{{ $facility->name }}">
                        <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)); border-radius:10px;">
                            <h5>{{ $facility->name }}</h5>
                            <p>{{ $facility->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#facilitiesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#facilitiesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
