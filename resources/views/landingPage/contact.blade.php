{{-- <footer class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="text-align:center">
                <h3 class="">Lokasi Pantai Kami</h3>
            </div>
        </div>
            <div class="row">
             <div class="col-lg-12">
                <div id="mapid" style="height: 400px; width: 100%;"></div>
            </div>   
            
        </div>
    </div>
</footer> --}}

<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Kontak Kami</h2>
            <h3 class="section-subheading">Hubungi kami untuk informasi lebih lanjut mengenai tiket, layanan, atau pertanyaan lainnya seputar Pantai Balongan Indah 2</h3>
        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->
        <div class="row">
            <div class="col-md-8">
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="text-center mb-2">
                        <button class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="col-lg-12">
                    <div id="mapid" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<script>
    // Inisialisasi peta dengan koordinat dan level zoom
    var mymap = L.map('mapid').setView([-6.357647, 108.387466], 13);

    // Tambahkan layer peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    // Tambahkan marker pada koordinat
    var marker = L.marker([-6.357647, 108.387466]).addTo(mymap);

    // Tambahkan popup pada marker dengan link ke Google Maps
    marker.bindPopup('<a href="https://www.google.com/maps?q=-6.357647,108.387466" target="_blank">Lihat di Google Maps</a>');

</script>
