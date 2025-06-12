<!DOCTYPE html>
<html>
<head>
    <title>QR Ticket</title>
</head>
<body>
    <h2>Ticket Number: {{ $ticket_number }}</h2>
    
    <div>
        {!! QrCode::size(250)->generate($ticket_number) !!}
    </div>
    
    <br>
    <button onclick="window.print()">🖨️ Cetak Tiket</button>
</body>
</html>
