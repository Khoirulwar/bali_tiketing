@extends('layouts.main')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Detail Konten</h3>
</div> 
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <!-- Bordered table start -->
            <section class="section">
                <a href="{{ route('contents.index') }}" class="btn btn-secondary"> < Kembali</a>
                <div class="container mt-2">
                    <h2>{{ $contents->title }}</h2>
                    <p><strong>Created at:</strong> {{ $contents->created_at->format('d M Y') }}</p>
                    {{-- <img class="img-fluid w-100" src="{{asset ('assets/compiled/jpg/banana.jpg') }}" alt="Card image cap"> --}}
                    <img src="{{ ($contents->image) }}" alt="{{ $contents->title }}" class="img-fluid w-50 mb-3">
                    <p>{{ $contents->content }}</p>
                
                </div>
            </section>
        </div>
    </div>
</div>


@endsection

@section('script')

@endsection

