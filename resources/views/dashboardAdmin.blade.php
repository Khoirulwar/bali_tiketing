@extends('layouts.main')

@section('title', 'Dashboard / Admin')

@section('css')
    <!-- Tambahkan CSS khusus jika diperlukan -->
    <style>
        /* CSS khusus jika diperlukan */
    </style>
@endsection

@section('content')

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Dashboard Admin</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <!-- Kolom Kiri (Form Pencarian) -->
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Search Data</h5>
                                <form action="{{ route('dashboard.search') }}" method="GET" id="search-form">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Masukkan Nomor Tiket"
                                            name="search" id="search-input">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </form>

                                <!-- Hasil Pencarian -->
                                @if (isset($tickets))
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Hasil Pencarian</h5>
                                                    <hr>
                                                    @if ($tickets->isEmpty())
                                                        <p>Tiket tidak ditemukan atau belum aktif!</p>
                                                    @else
                                                        <div class="row">
                                                            @foreach ($tickets as $ticket)
                                                                <div class="col-md-12">
                                                                    <div class="card mb-3">
                                                                        <div class="card-body">
                                                                            <div class="row mb-3">
                                                                                <div class="card">
                                                                                    <div class="card-body bg-light"
                                                                                        style="border-radius:20px; border : 3px green solid">
                                                                                        <div
                                                                                            class="d-flex justify-content-between">
                                                                                            <div class="col">
                                                                                                <p class="card-text">Nomor
                                                                                                    Tiket :
                                                                                                    {{ $ticket->ticket_number }}
                                                                                                </p>
                                                                                                <p class="card-text">Nama :
                                                                                                    {{ $ticket->user->name ?? 'Tidak Diketahui' }}
                                                                                                </p>
                                                                                                <p class="card-text">Status
                                                                                                    : {{ $ticket->status }}
                                                                                                </p>
                                                                                                <p class="card-text">QRCode
                                                                                                    :
                                                                                                    {!! QrCode::size(150)->generate($ticket->ticket_number) !!}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="col text-end">
                                                                                                <p class="card-text">Tanggal
                                                                                                    Kunjungan :
                                                                                                    {{ $ticket->visit_date }}
                                                                                                </p>
                                                                                                <p class="card-text">Jumlah
                                                                                                    Tiket :
                                                                                                    {{ $ticket->ticket_count }}
                                                                                                </p>
                                                                                                <p class="card-text">Total
                                                                                                    Bayar :
                                                                                                    {{ $ticket->total_price }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-2">
                                                                                            <div
                                                                                                class="col-md-12 text-center">
                                                                                                <!-- Hanya tampilkan tombol jika tiket belum nonaktif -->
                                                                                                {{-- @if ($ticket->status !== 'nonaktif')
                                                                                        <form method="POST" action="{{ route('dashboard.tickets.update-status', $ticket->id) }}">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <input type="hidden" name="status" value="nonaktif">
                                                                                            <button type="submit" class="btn btn-warning">
                                                                                                Validasi Tiket
                                                                                            </button>
                                                                                        </form> --}}
                                                                                                @if ($ticket->status !== 'nonaktif' && $ticket->status !== 'belum bayar')
                                                                                                    <form
                                                                                                        id="autoSubmitForm"
                                                                                                        method="POST"
                                                                                                        action="{{ route('dashboard.tickets.update-status', $ticket->id) }}">
                                                                                                        @csrf
                                                                                                        @method('PUT')
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="status"
                                                                                                            value="nonaktif">
                                                                                                        <button
                                                                                                            type="submit"
                                                                                                            class="btn btn-warning">
                                                                                                            Validasi Tiket
                                                                                                        </button>
                                                                                                    </form>

                                                                                                    <script>
                                                                                                        // Auto-submit form ketika halaman selesai dimuat
                                                                                                        window.addEventListener('DOMContentLoaded', function() {
                                                                                                            document.getElementById('autoSubmitForm').submit();
                                                                                                        });
                                                                                                    </script>
                                                                                                @else
                                                                                                    @if ($ticket->status === 'belum bayar')
                                                                                                        <p
                                                                                                            class="text-warning">
                                                                                                            Belum melakukan
                                                                                                            pembayaran</p>
                                                                                                            <form method="POST" action="{{ route('dashboard.tickets.update-status', $ticket->id) }}">
                                                                                                                @csrf
                                                                                                                @method('PUT')
                                                                                                                <input type="hidden" name="status" value="nonaktif">
                                                                                                                <button type="submit" class="btn btn-warning">
                                                                                                                    Validasi Tiket
                                                                                                                </button>
                                                                                                            </form>
                                                                                                    @else
                                                                                                        <p
                                                                                                            class="text-success">
                                                                                                            Tiket sudah
                                                                                                            divalidasi</p>
                                                                                                    @endif
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan (Statistik) -->
                    <div class="col-12 col-lg-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistics</h5>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon purple mb-2 me-3">
                                                <i class="iconly-boldShow"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-semibold">Pengunjung Website</h6>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon blue mb-2 me-3">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-semibold">Penjualan Tiket Dewasa</h6>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon green mb-2 me-3">
                                                <i class="iconly-boldAdd-User"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-semibold">Penjualan Tiket Anak-anak</h6>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /row -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Chart -->
            </div>
        </section>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.focus();
            }

            // Jika ada parameter pencarian dalam URL, pastikan input pencarian sudah terisi
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('search')) {
                searchInput.value = urlParams.get('search');
            }
        });
    </script>
@endsection
