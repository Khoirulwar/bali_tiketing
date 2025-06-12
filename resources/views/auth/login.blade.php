<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/auth/loginAdmin.css">
        <link rel="icon" type="image/png" href="img/landing/logoBali2.png">

</head>
<body>
    {{-- <section class="background-login">
                    
        
    </section> --}}
    {{-- <div class="container mt-5" style="display: flex; justify-content:center; "> --}}
    <div class="background-login">
        <div class="row align-items-center">
            <div class="col">
                <div class="form-box " data-aos="fade-up">
                {{-- style="margin-top: 10%;margin-left:15%;margin-right:15%" --}}
                    <div class="form-value">
                        @if(session('success'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="max-width: 350px;">
                                <b>Success!</b> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="max-width: 350px;">
                                <b>Oops!</b> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('actionlogin') }}" method="post">
                            @csrf
                            <h2>Login</h2>
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input type="email" name="email" required="" >
                                <label for="">Email</label>
                            </div>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input type="password" name="password" required="">
                                <label for="">Password</label>
                            </div>
                            {{-- <div class="forget">
                                <label for=""><input type="checkbox">Ingat Saya | <a href="#">Lupa Password</a></label>
                            
                            </div> --}}
                            <button type="submit" >Masuk</button>
                            {{-- <div class="register">
                                <p>Belum Mempunyai Akun? <a href="/registrasi">Daftar</a></p>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="img/landing/logoBali2.png" alt="" style="width: 100%">
            </div>
        </div>
    </div>
    
<script>
    // Otomatis menghilangkan alert setelah 5 detik
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(function() {
                alert.remove(); // Menghapus alert dari DOM setelah animasi fade selesai
            }, 100); // Sesuaikan dengan durasi animasi CSS (misal: 1000ms = 1 detik)
        }
    }, 2000); // Waktu dalam milidetik (5000 = 5 detik)
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>