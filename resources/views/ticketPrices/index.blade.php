@extends('layouts.main')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Harga Tiket</h3>
</div>

<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tabel Harga Tiket</h4>
                </div>
                <div class="card-body">
                    <button id="btnTambahTicketPrice" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahTicketPrice">Tambah Harga Tiket</button>

                    <!-- Modal Tambah Data -->
                    <div class="modal fade" id="modalTambahTicketPrice" tabindex="-1" aria-labelledby="modalTambahTicketPriceLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahTicketPriceLabel">Tambah Harga Tiket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('ticket-prices.store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="adult_price_weekday" class="form-label">Harga Dewasa (Weekday)</label>
                                            <input type="number" class="form-control" id="adult_price_weekday" name="adult_price_weekday" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="child_price_weekday" class="form-label">Harga Anak-anak (Weekday)</label>
                                            <input type="number" class="form-control" id="child_price_weekday" name="child_price_weekday" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="adult_price_weekend" class="form-label">Harga Dewasa (Weekend)</label>
                                            <input type="number" class="form-control" id="adult_price_weekend" name="adult_price_weekend" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="child_price_weekend" class="form-label">Harga Anak-anak (Weekend)</label>
                                            <input type="number" class="form-control" id="child_price_weekend" name="child_price_weekend" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Harga Tiket -->
                    <div class="table-responsive mt-3">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>Harga Dewasa (Weekday)</th>
                                    <th>Harga Anak-anak (Weekday)</th>
                                    <th>Harga Dewasa (Weekend)</th>
                                    <th>Harga Anak-anak (Weekend)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ticketPrices as $index => $ticketPrice)
                                    <tr>
                                        <td>{{ $ticketPrice->adult_price_weekday }}</td>
                                        <td>{{ $ticketPrice->child_price_weekday }}</td>
                                        <td>{{ $ticketPrice->adult_price_weekend }}</td>
                                        <td>{{ $ticketPrice->child_price_weekend }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditTicketPrice{{ $ticketPrice->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteTicketPrice{{ $ticketPrice->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            <!-- Modal Edit Data -->
                                            <div class="modal fade" id="modalEditTicketPrice{{ $ticketPrice->id }}" tabindex="-1" aria-labelledby="modalEditTicketPriceLabel{{ $ticketPrice->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalEditTicketPriceLabel{{ $ticketPrice->id }}">Edit Harga Tiket</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('ticket-prices.update', $ticketPrice->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="adult_price_weekday" class="form-label">Harga Dewasa (Weekday)</label>
                                                                    <input type="number" class="form-control" id="adult_price_weekday" name="adult_price_weekday" value="{{ $ticketPrice->adult_price_weekday }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="child_price_weekday" class="form-label">Harga Anak-anak (Weekday)</label>
                                                                    <input type="number" class="form-control" id="child_price_weekday" name="child_price_weekday" value="{{ $ticketPrice->child_price_weekday }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="adult_price_weekend" class="form-label">Harga Dewasa (Weekend)</label>
                                                                    <input type="number" class="form-control" id="adult_price_weekend" name="adult_price_weekend" value="{{ $ticketPrice->adult_price_weekend }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="child_price_weekend" class="form-label">Harga Anak-anak (Weekend)</label>
                                                                    <input type="number" class="form-control" id="child_price_weekend" name="child_price_weekend" value="{{ $ticketPrice->child_price_weekend }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus Data -->
                                            <div class="modal fade" id="confirmDeleteTicketPrice{{ $ticketPrice->id }}" tabindex="-1" aria-labelledby="confirmDeleteTicketPriceLabel{{ $ticketPrice->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteTicketPriceLabel{{ $ticketPrice->id }}">Konfirmasi Hapus Harga Tiket</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('ticket-prices.destroy', $ticketPrice->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
