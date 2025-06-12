@extends('layouts.main')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Laporan Tiket Masuk</h3>
</div> 

<section class="section">
    <!-- CSS untuk pengaturan cetak -->
    <style>
        @media print {
            /* Menyembunyikan semua elemen */
            body * {
                visibility: hidden;
            }
            /* Menampilkan hanya area yang ingin dicetak */
            #printableArea, #printableArea * {
                visibility: visible;
            }
            /* Mengatur posisi area yang dicetak */
            #printableArea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                /* Atur margin dan padding sesuai kebutuhan */
                margin: 0;
                padding: 0;
            }
            /* Mengatur ukuran font dan tampilan tabel saat dicetak */
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 8px;
                text-align: left;
            }
            /* Menyembunyikan pagination saat dicetak */
            .mt-3 {
                display: none;
            }
            /* Menyembunyikan header dan footer saat dicetak jika ada */
            .page-heading, header, footer {
                display: none;
            }
        }
    </style>

    <!-- Tombol Print dan Filter -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-end align-items-center">
                <form action="{{ route('ticket-reports.index') }}" method="GET" class="d-flex align-items-center me-2">
                    <div class="me-2">
                        <select name="month" class="form-select" onchange="this.form.submit()">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-2">
                        <select name="year" class="form-select" onchange="this.form.submit()">
                            @foreach(range(date('Y') - 5, date('Y') + 5) as $y)
                                <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <button type="button" class="btn btn-secondary" onclick="printReport()">
                    <i class="bi bi-printer"></i> Print
                </button>
            </div>
        </div>
    </div>

    <!-- Area yang akan dicetak -->
    <div id="printableArea">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Laporan Tiket Masuk - {{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-2">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari/Tanggal</th>
                                <th>Uraian</th>
                                <th>Jumlah</th>
                                <th>Ref</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $index => $report)
                                <tr>
                                    <td>{{ $index + 1 + ($reports->currentPage() - 1) * $reports->perPage() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($report->date)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td>
                                        Tiket Dewasa: {{ $report->total_adults_weekday + $report->total_adults_weekend }} Tiket
                                        <br>
                                        Tiket Anak-anak: {{ $report->total_children_weekday + $report->total_children_weekend }} Tiket
                                    </td>
                                    <td>{{ ($report->total_adults_weekday + $report->total_adults_weekend) + ($report->total_children_weekday + $report->total_children_weekend) }} Tiket</td>
                                    <td>{{ number_format($report->total_revenue, 0, ',', '.') }}</td>
                                    <td>{{ number_format($report->total_revenue, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Kontrol pagination -->
                    <div class="mt-3">
                        {{ $reports->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fungsi JavaScript untuk mencetak -->
    <script>
        function printReport() {
            window.print();
        }
    </script>

</section>

@endsection
