<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VotePad2</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 210mm;
            height: 297mm;
            padding: 5mm;
            box-sizing: border-box;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(5, 1fr);
            grid-gap: 10mm;
        }

        .qr-code {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1px 40px 0 40px;
            border: 2px solid;
        }

        .qr-code h6 {
            margin: 2px 0;
        }

        .qr-code p {
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div class="page">
        @foreach ($jurys as $item)
            @if ($item->type == 'public')
                @for ($i = 0; $i < $item->nombrePublic; $i++)
                    <div class="qr-code">
                        <h6 class="dark:text-white">{{ strtoupper($item->event_nom) }}</h6>
                        <p class="dark:text-white">TYPE : {{ strtoupper($item->type) }}</p>
                        <div id="qrcode-{{ $item->id }}-{{ $i }}"></div>
                        <h5>{{ strtoupper($item->coupon) }}</h5>
                    </div>
                @endfor
            @else
                @if ($item->is_use != 1 && $item->numPrive != 0)
                    <div class="qr-code">
                        <h6 class="dark:text-white">{{ strtoupper($item->event_nom) }}</h6>
                        <p class="dark:text-white">TYPE : {{ strtoupper($item->type) }}</p>
                        <div id="qrcode-{{ $item->id }}"></div>
                        <h5>{{ strtoupper($item->coupon) }}</h5>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
</body>
<script>
    function qrcode() {
        @foreach ($jurys as $item)
            @if ($item->type == 'public')
                @for ($i = 0; $i < $item->nombrePublic; $i++)
                    var qrcode = new QRCode(document.getElementById(
                        'qrcode-{{ $item->id }}-{{ $i }}'), {
                        text: '{{ $item->coupon }}',
                        width: 130,
                        height: 130,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                @endfor
            @else
                @if ($item->is_use != 1 && $item->numPrive != 0)
                    var qrcode = new QRCode(document.getElementById('qrcode-{{ $item->id }}'), {
                        text: '{{ $item->coupon }}',
                        width: 130,
                        height: 130,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                @endif
            @endif
        @endforeach
    }
    qrcode();
</script>

</html>
