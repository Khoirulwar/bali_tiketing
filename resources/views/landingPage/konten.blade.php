<section class="page-section" id="konten" style="background: linear-gradient(to bottom, #87CEEB, #1E90FF, #20B2AA);">
    <div class="container bg-light py-5" style="border-radius: 10px">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Konten</h2>
            <h3 class="section-subheading text-muted">Event dan Berita terbaru yang disediakan oleh kami</h3>
        </div>
        <div class="row">
            @foreach ($contents as $content)
    <div class="col-lg-4 col-sm-6 mb-4">
        <!-- Konten item -->
        <div class="konten-item">
            <a class="konten-link" data-bs-toggle="modal" href="#kontenModal{{ $content->id }}">
                <div class="konten-hover">
                    <div class="konten-hover-content">
                        <button class="btn" type="button" style="color:white; border: 1px solid white; padding: 10px 20px; background: rgba(0, 0, 0, 0.5);">
                            Detail
                        </button>                                        
                    </div>
                </div>
                <img class="img-fluid" src="{{ asset('storage/images/contents_images/' . basename($content->image)) }}" alt="..." style="border-radius: 10px;">
            </a>
            <div class="konten-caption">
                <div class="konten-caption-heading">{{ $content->title }}</div>
                <div class="konten-caption-subheading text-muted">{{ Str::limit($content->content, 50) }}</div>
            </div>
        </div>
    </div>
@endforeach

        </div>
    </div>
    @foreach ($contents as $content)
    <div class="modal fade" id="kontenModal{{ $content->id }}" tabindex="-1" aria-labelledby="kontenModalLabel{{ $content->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kontenModalLabel{{ $content->id }}">{{ $content->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" src="{{ asset('storage/images/contents_images/' . basename($content->image)) }}" alt="..." style="border-radius: 10px;">
                    <p>{{ $content->content }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

</section>
