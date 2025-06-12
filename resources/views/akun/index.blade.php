@extends('layouts.main')

@section('title', 'Data Akun / Admin')

@section('css')

@endsection

@section('content')

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Data Akun</h3>
    </div> 
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Table Data Akun</h4>
                    </div>
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <button id="btnTambahPelanggan" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">Tambah Data Pelanggan</button>

                        <!-- Modal untuk tambah data pelanggan -->
                        <div class="modal fade" id="modalTambahPelanggan" tabindex="-1" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahPelangganLabel">Tambah Data Pelanggan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="formTambahPelanggan" method="POST" action="{{ route('data-akun.store') }}">
                                        <div class="modal-body">
                                            <!-- Form grup untuk membuat akun -->
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama Pelanggan</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Pelanggan" required value="{{ old('name') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Pelanggan</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Pelanggan" required value="{{ old('email') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Nomor Telepon Pelanggan</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Nomor Telepon Pelanggan" required value="{{ old('phone_number') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
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
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>AKSES AKUN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $account)
                                        <tr>
                                            <td>{{ $account->name }}</td> <!-- Menampilkan nama pengguna -->
                                            <td>{{ $account->email }}</td> <!-- Menampilkan email pengguna -->
                                            <td>
                                                @foreach($account->roles as $role)
                                                    {{ $role->name }} <!-- Menampilkan nama role -->
                                                @endforeach
                                            </td>
                                            <td>
                                                <!-- Tombol aksi untuk mengedit atau menghapus data akun -->
                                                {{-- <button class="btn btn-primary">Edit</button> --}}
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                                                    Delete
                                                </button>                                                                                          
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

    <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" action="{{ route('data-akun.destroy', $account->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <!-- Bordered table end -->

@endsection

@section('script')

<script>
    @if ($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('modalTambahPelanggan'));
        myModal.show();
    @endif
</script>


@endsection