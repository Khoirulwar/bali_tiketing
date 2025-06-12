<div class="row">
    <div class="col">
        <p>ID Tiket: {{ $ticket->id }}</p>
        <p>Ticket Number: {{ $ticket->ticket_number }}</p>
        <p>Nama: {{ $ticket->user->name ?? 'Tidak Diketahui' }}</p>
    </div>
    <div class="col">
        <p>Tanggal Kunjungan: {{ $ticket->visit_date }}</p>
        <p>Status:  {{ $ticket->status }} </p>
    </div>
    <div>
        {!! QrCode::size(250)->generate($ticket->ticket_number) !!}
    </div>
</div>

<br>

<!-- Bukti Pembayaran -->
<h4>Detail Pembayaran</h4>
@if($paymentConfirmations->isEmpty())
    <p>Tidak ada bukti pembayaran.</p>
@else
    @foreach($paymentConfirmations as $confirmation)
        <div>
            <div class="row">
                <div class="col">
                    <p>ID Pembayaran: {{ $confirmation->id }}</p>
                    <p>Nama Bank: {{ $confirmation->bank_name }}</p>
                    <p>Nomor Akun: {{ $confirmation->account_number }}</p>
                </div>
                <div class="col">
                    <p>Nama Akun: {{ $confirmation->account_owner }}</p>
                    <p>Nominal Transfer: {{ $confirmation->nominal }}</p>
                    <p>Tanggal Transfer: {{ $confirmation->transfer_date }}</p>
                </div>
                <div class="row">
                    <p>Bukti Pembayaran:</p>
                    @if($confirmation->image_path)
                        <img src="{{ asset('storage/' . $confirmation->image_path) }}" alt="Payment Image" width="100" data-bs-toggle="modal" data-bs-target="#buktiModal{{ $confirmation->id }}">
                    @else
                        No Image
                    @endif
                </div>
            </div>

            <!-- Modal for each image -->
            <div class="modal fade" id="buktiModal{{ $confirmation->id }}" tabindex="-1" aria-labelledby="buktiModalLabel{{ $confirmation->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
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
        </div>
    @endforeach
@endif
