<section class="page-section bg-light" id="informasiTiket" style="background: linear-gradient(to bottom, #87CEEB, #1E90FF, #20B2AA);">
    <div class="container text-center bg-light py-3" style="border-radius: 10px">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Informasi Tiket</h2>
            <h3 class="section-subheading text-muted">Temukan berbagai pilihan tiket dan layanan terbaik kami.</h3>
        </div>
        <div class="row justify-content-md-center mb-3">
            @foreach($ticketPrices as $ticket)
                <div class="col-md-5">
                    <div class="custom-card">
                        <div class="custom-card-header bg-primary text-white">
                            <h4 class="my-0">Tiket Anak-Anak</h4>
                        </div>
                        <div class="custom-card-body">
                            <h5 class="custom-card-title">Hari Biasa (Senin-Jumat)</h5>
                            <p class="custom-card-text">Rp. {{ number_format($ticket->child_price_weekday, 0, ',', '.') }}</p>
                            <h5 class="custom-card-title">Weekend (Sabtu-Minggu)</h5>
                            <p class="custom-card-text">Rp. {{ number_format($ticket->child_price_weekend, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="custom-card">
                        <div class="custom-card-header bg-primary text-white">
                            <h4 class="my-0">Tiket Dewasa</h4>
                        </div>
                        <div class="custom-card-body">
                            <h5 class="custom-card-title">Hari Biasa (Senin-Jumat)</h5>
                            <p class="custom-card-text">Rp. {{ number_format($ticket->adult_price_weekday, 0, ',', '.') }}</p>
                            <h5 class="custom-card-title">Weekend (Sabtu-Minggu)</h5>
                            <p class="custom-card-text">Rp. {{ number_format($ticket->adult_price_weekend, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
