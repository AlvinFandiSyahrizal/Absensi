<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Keanggotaan</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .frame {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            max-width: 1000px;
            margin: 0 auto;
        }

        #preview {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .qrcode-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .qrcode {
            margin-top: 10px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
</head>
<body>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <i class="fa fa-plus" style="color:green"></i>  Daftar Anggota
            </h1>
        </section>
        <section class="content">
            <div class="frame">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Pas Foto</label>
                                <input type="file" accept="image/*" name="gambar" id="gambar" onchange="previewImage()">
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mt-2">
                                                <img id="preview" class="img-fluid rounded" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Anggota</label>
                                    <input type="text" class="form-control" name="nama" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" required placeholder="Kota">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border"></div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="username" id="username" required placeholder="Username">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-success btn-md" onclick="generateQRCode()">Generate QR Code</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="qrcode-container">
                                        <label>QR Code:</label>
                                        <canvas id="qrcode" class="qrcode"></canvas>
                                        <img id="qrcode-preview" alt="QR Code Preview" style="display: none; margin-top: 10px;">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <br/>
                                            <input type="radio" name="jenkel" value="Laki-Laki" required> Laki-Laki
                                            <br/>
                                            <input type="radio" name="jenkel" value="Perempuan" required> Perempuan
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input id="uintTextBox" class="form-control" name="telepon" required placeholder="08*******">
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control" name="email" required placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="alamat" required></textarea>
                                        </div>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    </div>
                                </form>
                                <a href="{{ route('daftar.index') }}" class="btn btn-danger btn-md">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
    <script>
        function previewImage() {
            var input = document.getElementById('gambar');
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function generateQRCode() {
            var username = document.getElementById('username').value;
            var qrCodeContainer = document.getElementById('qrcode');
            var qrCodePreview = document.getElementById('qrcode-preview');

            // Clear previous QR code
            qrCodeContainer.innerHTML = '';

            if (username.trim() !== '') {
                // Generate QR code if username is not empty
                var qr = new QRious({
                    element: qrCodeContainer,
                    value: username,
                    size: 300,
                    background: 'white',
                    foreground: 'black'
                });

                // Create an image from the QR code
                qrCodePreview.src = qr.toDataURL(); // Use toDataURL to convert QR code to image format
                qrCodePreview.style.display = 'block';
            } else {
                // Display a message if username is empty
                qrCodeContainer.innerHTML = 'Username cannot be empty.';
                qrCodePreview.style.display = 'none';
            }
        }
    </script>
</html>
