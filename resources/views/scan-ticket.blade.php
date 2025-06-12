<!DOCTYPE html>
<html>
<head>
    <title>Scan Ticket</title>
</head>
<body>
    <form id="scanForm" method="POST" action="/scan-ticket">
        @csrf
        <input type="text" name="ticket_number" id="ticket_number" autofocus autocomplete="off">
    </form>

    <script>
        const input = document.getElementById('ticket_number');
        input.addEventListener('input', function () {
            if (input.value.length >= 6) { // atur sesuai panjang barcode
                document.getElementById('scanForm').submit();
            }
        });
    </script>
</body>
</html>
