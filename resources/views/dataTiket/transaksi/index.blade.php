@extends('layouts.main')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Transaksi</h3>
</div> 

<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Data Transaksi Tiket</h4>
                </div>
                <div class="card-body">
                    <!-- Table with outer spacing -->
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Transaksi Tiket</a>
                            <a href="{{ route('payments.index') }}" class="btn btn-primary">Konfirmasi Pembayaran</a> --}}
                        </div>
                        <div class="col-md-6">
                            <button id="btnTambahPelanggan" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan" style="margin-left: 50%">Tambah Data Transaksi</button>
                        </div>
                    </div>
                    
                    <!-- Modal untuk tambah data pelanggan -->
                    <div class="modal fade" id="modalTambahPelanggan" tabindex="-1" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahPelangganLabel">Tambah Data Pelanggan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('tickets.store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Form grup untuk membuat transaksi -->
                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">Nama Pelanggan</label>
                                            <select class="form-select" id="user_id" name="user_id" required>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="visit_date" class="form-label">Tanggal Kunjungan</label>
                                            <input type="date" class="form-control" id="visit_date" name="visit_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="adult_ticket_count" class="form-label">Jumlah Tiket Dewasa</label>
                                            <input type="number" class="form-control" id="adult_ticket_count" name="adult_ticket_count" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="child_ticket_count" class="form-label">Jumlah Tiket Anak-Anak</label>
                                            <input type="number" class="form-control" id="child_ticket_count" name="child_ticket_count">
                                        </div>
                                        <div class="mb-3">
                                            <label for="promo_code" class="form-label">Kode Promo</label>
                                            <input type="text" class="form-control" id="promo_code" name="promo_code">
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_price" class="form-label">Total Harga</label>
                                            <input type="number" class="form-control" id="total_price" name="total_price" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="belum bayar">Belum Bayar</option>
                                                <option value="aktif">Aktif</option>
                                                <option value="nonaktif">Nonaktif</option>
                                            </select>
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
                    
                    <div class="table-responsive mt-2" >
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Tiket</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Total Tiket</th>
                                    {{-- <th>Jumlah Tiket Dewasa</th>
                                    <th>Jumlah Tiket Anak-Anak</th>
                                    <th>Kode Promo</th> --}}
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->ticket_number }}</td>
                                        <td>{{ $data->user->name ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->visit_date)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                        <td>{{ $data->total_tickets }}</td>
                                        {{-- <td>{{ $data->adult_ticket_count }}</td>
                                        <td>{{ $data->child_ticket_count ?? '-' }}</td>
                                        <td>{{ $data->promo_code ?? '-' }}</td> --}}
                                        <td>{{ $data->total_price }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ticketDetailModal{{ $data->id }}"><i class="bi bi-eye"></i></button>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $data->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $data->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEdit{{ $data->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $data->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalEditLabel{{ $data->id }}">Edit Data Transaksi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('tickets.update', $data->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select class="form-select" id="status" name="status" required>
                                                                        <option value="belum bayar" {{ $data->status == 'belum bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                                                        <option value="aktif" {{ $data->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                                        <option value="nonaktif" {{ $data->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                                                    </select>
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

                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="confirmDelete{{ $data->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $data->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteLabel{{ $data->id }}">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('tickets.destroy', $data->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <p>Anda yakin ingin menghapus data ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Detail Tiket -->
<!-- Modal Detail Transaksi dan Pembayaran -->
<div class="modal fade" id="ticketDetailModal{{ $data->id }}" tabindex="-1" aria-labelledby="ticketDetailLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketDetailLabel{{ $data->id }}">Detail Transaksi dan Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detail Transaksi -->
                <h6>Detail Transaksi</h6>
                <ul class="list-unstyled">
                    <li><strong>Nomor Tiket:</strong> {{ $data->ticket_number }}</li>
                    <li><strong>Nama Pelanggan:</strong> {{ $data->user->name ?? 'Tidak Diketahui' }}</li>
                    <li><strong>Tanggal Kunjungan:</strong> {{ \Carbon\Carbon::parse($data->visit_date)->locale('id')->translatedFormat('l, d F Y') }}</li>
                    <li><strong>Jumlah Tiket Dewasa:</strong> {{ $data->adult_ticket_count }}</li>
                    <li><strong>Jumlah Tiket Anak-Anak:</strong> {{ $data->child_ticket_count }}</li>
                    <li><strong>Kode Promo:</strong> {{ $data->promo_code ?? "-"}}</li>
                    <li><strong>Total Harga:</strong> {{ $data->total_price }}</li>
                </ul>

                <hr>

                <!-- Detail Pembayaran -->
                <h6>Detail Pembayaran</h6>
                <ul class="list-unstyled">
                    <li><strong>Status Pembayaran:</strong> {{ $data->payment_status  ?? "-"}}</li>
                    <li><strong>Metode Pembayaran:</strong> {{ $data->payment_method  ?? "-"}}</li>
                    <li><strong>Nomor Referensi:</strong> {{ $data->reference_number  ?? "-"}}</li>
                    <li><strong>Tanggal Pembayaran:</strong> {{ \Carbon\Carbon::parse($data->payment_date )->locale('id')->translatedFormat('l, d F Y') }}</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
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
<!-- Bordered table end -->

<!-- Modal untuk detail -->
{{-- <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nomor Tiket:</strong> <span id="detailTicketNumber"></span></p>
                <p><strong>Nama Pengguna:</strong> <span id="detailUserName"></span></p>
                <p><strong>Tanggal Kunjungan:</strong> <span id="detailVisitDate"></span></p>
                <p><strong>Jumlah Tiket Dewasa:</strong> <span id="detailAdultTicketCount"></span></p>
                <p><strong>Jumlah Tiket Anak-Anak:</strong> <span id="detailChildTicketCount"></span></p>
                <p><strong>Kode Promo:</strong> <span id="detailPromoCode"></span></p>
                <p><strong>Total Harga:</strong> <span id="detailTotalPrice"></span></p>
                <p><strong>Status:</strong> <span id="detailStatus"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> --}}


<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const detailModal = document.getElementById('detailModal');
    //     detailModal.addEventListener('show.bs.modal', function (event) {
    //         const button = event.relatedTarget;
    //         const ticketId = button.getAttribute('data-id');

    //         fetch(`/api/tickets/${ticketId}`)
    //             .then(response => response.json())
    //             .then(data => {
    //                 document.getElementById('detailTicketNumber').textContent = data.id;
    //                 document.getElementById('detailUserName').textContent = data.user.name;
    //                 document.getElementById('detailVisitDate').textContent = data.visit_date;
    //                 document.getElementById('detailAdultTicketCount').textContent = data.adult_ticket_count;
    //                 document.getElementById('detailChildTicketCount').textContent = data.child_ticket_count || '-';
    //                 document.getElementById('detailPromoCode').textContent = data.promo_code || '-';
    //                 document.getElementById('detailTotalPrice').textContent = data.total_price;
    //                 document.getElementById('detailStatus').textContent = data.status;
    //             });
    //     });
    // });
</script>



@endsection
