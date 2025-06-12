@extends('layouts.main')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Konfirmasi Pembayaran</h3>
</div> 
<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Data Konfirmasi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <!-- Table with outer spacing -->
                    <a href="{{ route('tickets.index') }}" class="btn btn-primary">Transaksi Tiket</a>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Konfirmasi Pembayaran</a>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah</button>

                    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCreateLabel">Tambah Konfirmasi Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('payments.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="bank_name" class="form-label">Nama Bank</label>
                                            <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="account_number" class="form-label">Nomor Rekening</label>
                                            <input type="text" class="form-control" id="account_number" name="account_number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="account_owner" class="form-label">Nama Pemilik Rekening</label>
                                            <input type="text" class="form-control" id="account_owner" name="account_owner" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nominal" class="form-label">Nominal</label>
                                            <input type="text" class="form-control" id="nominal" name="nominal" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="transfer_date" class="form-label">Tanggal Transfer</label>
                                            <input type="date" class="form-control" id="transfer_date" name="transfer_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Bukti Transfer</label>
                                            <input type="file" class="form-control" id="image" name="image" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID TICKET</th>
                                    <th>Bank Name</th>
                                    <th>Account Number</th>
                                    <th>Account Owner</th>
                                    <th>Nominal</th>
                                    <th>Transfer Date</th>
                                    <th>Image</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $index => $payment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $payment->ticket_id }}</td>
                                        <td>{{ $payment->bank_name }}</td>
                                        <td>{{ $payment->account_number }}</td>
                                        <td>{{ $payment->account_owner }}</td>
                                        <td>Rp.{{ $payment->nominal }}</td>
                                        <td>{{ $payment->transfer_date }}</td>
                                        <td>
                                            @if($payment->image_path)
                                                <img src="{{ asset('storage/' . $payment->image_path) }}" alt="Payment Image" width="100" data-bs-toggle="modal" data-bs-target="#buktiModal{{ $payment->id }}">
                                            @else
                                                No Image
                                            @endif
                                            <!-- Modal for each image -->
                                            <div class="modal fade" id="buktiModal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="buktiModalLabel{{ $payment->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="buktiModalLabel{{ $payment->id }}">Bukti Pembayaran</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset('storage/' . $payment->image_path) }}" alt="Payment Image" class="img-fluid">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"  data-bs-target="#confirmDelete{{ $payment->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td> 
                                    </tr>

                                    <!-- Modal Konfirmasi Delete for each payment -->
                                    <div class="modal fade" id="confirmDelete{{ $payment->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $payment->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteLabel{{ $payment->id }}">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus konfirmasi pembayaran ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>   
                            <div class="modal fade" id="buktiModal{{ $confirmation->id }}" tabindex="-1" role="dialog" aria-labelledby="buktiModalLabel{{ $payment->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="buktiModalLabel{{ $confirmation->id }}">Bukti Pembayaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $confirmation->image_path) }}" alt="Payment Image" class="img-fluid">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                                 
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

@endsection
