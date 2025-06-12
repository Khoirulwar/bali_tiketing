@extends('layouts.main')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Notifikasi</h3>
</div> 
<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Table Data Notifikasi</h4>
                </div>
                <div class="card-body">
                    <!-- Table with outer spacing -->
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Tambahkan tombol atau navigasi lain jika perlu --}}
                        </div>
                        <div class="col-md-6">
                            <button id="btnTambahNotifikasi" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahNotifikasi" style="margin-left: 50%">Tambah Data Notifikasi</button>
                        </div>
                    </div>
                    
                    <!-- Modal untuk tambah data notifikasi -->
<div class="modal fade" id="modalTambahNotifikasi" tabindex="-1" aria-labelledby="modalTambahNotifikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahNotifikasiLabel">Tambah Data Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('notifications.store') }}">
                @csrf
                <div class="modal-body">
                    <!-- Form grup untuk membuat notifikasi -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama Pengguna</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            <option value="all">Semua Pengguna</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" name="message" required></textarea>
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
                    
                    <div class="table-responsive mt-2">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengguna</th>
                                    <th>Title</th>
                                    <th>Pesan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th> <!-- Kolom Aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $index => $notification)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $notification->user->name ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $notification->title }}</td>
                                        <td>{{ $notification->message }}</td>
                                        <td>{{ $notification->created_at }}</td>
                                        <td>
                                            <!-- Tombol aksi untuk mengedit atau menghapus notifikasi -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $notification->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $notification->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEdit{{ $notification->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $notification->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalEditLabel{{ $notification->id }}">Edit Notifikasi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('notifications.update', $notification->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="user_id" class="form-label">Nama Pelanggan</label>
                                                                    <select class="form-select" id="user_id" name="user_id" required>
                                                                        @foreach($users as $user)
                                                                            <option value="{{ $user->id }}" {{ $user->id == $notification->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Judul Notifikasi</label>
                                                                    <input type="text" class="form-control" id="title" name="title" value="{{ $notification->title }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="message" class="form-label">Pesan</label>
                                                                    <textarea class="form-control" id="message" name="message" required>{{ $notification->message }}</textarea>
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
                                            <div class="modal fade" id="confirmDelete{{ $notification->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $notification->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteLabel{{ $notification->id }}">Konfirmasi Hapus Notifikasi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus notifikasi ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                            </form>
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

@endsection
