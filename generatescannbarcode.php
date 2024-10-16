<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Barcode Scanner</title>
    <script>
        var barcode = '';
        var interval;
        
        document.addEventListener('keydown', function(evt) {
            if (interval) {
                clearInterval(interval);
            }
            if (evt.code == 'Enter') {
                if (barcode) {
                    handleBarcode(barcode);
                    barcode = '';
                }
                return;
            }
            if (evt.key != 'Shift') {
                barcode += evt.key;
                interval = setInterval(() => barcode = '', 20);
            }
        });

        function handleBarcode(scannedBarcode) {
            document.querySelector('#last-barcode').innerHTML = scannedBarcode;
        }
    </script>
</head>
<body>
    <h1>Simple Barcode Scanner</h1>
    <strong>Last scanned barcode:</strong>
    <div id="last-barcode"></div>
</body>
</html>
