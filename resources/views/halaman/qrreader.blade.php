<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cari Anggota</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .container {
            display: grid;
            grid-template-columns: auto 1fr;
            grid-gap: 20px;
            padding: 20px;
        }
        .qr-scanner {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            padding: 20px;
            margin-right: 100px; /* Adjust the right margin */
        }
        .search-form {
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <i class="fa fa-search" style="color:orange"></i>
            </h1>
        </section>
        <section class="content">
            <div class="container">
                <div class="qr-scanner">
                    <!-- QR Code Scanner akan ditampilkan di sini -->
                    <video id="preview" style="max-width: 50%;"></video>
                </div>
                <div class="search-form">
                    <!-- Form pencarian anggota akan ditampilkan di sini -->
                    <h3 class="text-center my-4">Data Anggota</h3>
                    <form action="{{ route('absen.search') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>

                    @isset($keanggotaan)
                        <div class="mt-4">
                            <!-- Tampilkan data keanggotaan yang dicari -->
                            <div>
                                <img src="{{ asset('uploads/' . $keanggotaan->foto) }}" alt="Foto" width="100%">
                            </div>
                            <div class="ml-4">
                                <p>Nama: {{ $keanggotaan->nama }}</p>
                                <p>No.Telepon: {{ $keanggotaan->telepon }}</p>
                                <p>Tanggal Lahir: {{ $keanggotaan->tgl_lahir }}</p>
                                <p>Jenis Kelamin: {{ $keanggotaan->jenkel }}</p>
                                <p>Alamat: {{ $keanggotaan->alamat }}</p>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </section>
    </div>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function(content) {
            console.log('QR code scanned:', content);
            alert('QR code scanned: ' + content);
            scanner.stop(); // Stop scanning after the first QR code is detected
        });

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });
    </script>

</body>
</html>
