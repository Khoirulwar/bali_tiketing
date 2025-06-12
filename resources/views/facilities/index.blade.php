@extends('layouts.main')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Fasilitas</h3>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Daftar Fasilitas</h4>
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalTambahFasilitas">
            Tambah Fasilitas
        </button>
    </div>    
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Fasilitas</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facilities as $facility)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/images/' . $facility->image) }}" alt="{{ $facility->name }}" style="width: 100px; height: 100px;">
                    </td>
                    <td>{{ $facility->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($facility->description, 50) }}</td>
                    <td>
                        <!-- Button Lihat -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $facility->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <!-- Button Edit -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $facility->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <!-- Form Hapus -->
                        <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Lihat Detail -->
                <div class="modal fade" id="viewModal{{ $facility->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $facility->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel{{ $facility->id }}">Detail Fasilitas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama Fasilitas:</strong> {{ $facility->name }}</p>
                                <p><strong>Deskripsi:</strong> {{ $facility->description }}</p>
                                <img src="{{ asset('storage/images/' . $facility->image) }}" alt="{{ $facility->name }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $facility->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $facility->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $facility->id }}">Edit Fasilitas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Fasilitas</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $facility->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $facility->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambahFasilitas" tabindex="-1" aria-labelledby="modalTambahFasilitasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahFasilitasLabel">Tambah Fasilitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Fasilitas</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Fasilitas" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="image" name="image" required>
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


@endsection
