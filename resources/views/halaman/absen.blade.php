<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cari Anggota</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <i class="fa fa-search" style="color:orange"></i> Cari Anggota
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
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
                                    <div class="float-left">
                                        <img src="{{ asset('uploads/' . $keanggotaan->foto) }}" alt="Foto" width="500">
                                    </div>
                                    <div class="float-left ml-4">
                                        <p>Nama: {{ $keanggotaan->nama }}</p>
                                        <p>No.Telepon: {{ $keanggotaan->telepon }}</p>
                                        <p>Tanggal Lahir: {{ $keanggotaan->tgl_lahir }}</p>
                                        <p>Jenis Kelamin: {{ $keanggotaan->jenkel }}</p>
                                        <p>Alamat: {{ $keanggotaan->alamat }}</p>
                                    </div>
                                    <div class="clearfix"></div> <!-- Clear float -->
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>
</html>
