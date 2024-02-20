<!DOCTYPE html>
<html>
<head>
    <title>Generate Barcode</title>
    <style>
        .barcode-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .barcode {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Generate Barcode</h2>

    <form method="post" action="{{ route('barcode.generateBarcode') }}">
        @csrf
        <label for="barcode_text">Barcode Text:</label>
        <input type="text" name="barcode_text" required>
        <button type="submit">Generate Barcode</button>
    </form>

    <div class="barcode-container">
        @if(isset($barcode))
            <label>Barcode:</label>
            <div class="barcode">{!! $barcode !!}</div>
        @endif
    </div>
</body>
</html>
