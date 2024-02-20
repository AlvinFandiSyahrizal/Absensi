<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR KEANGGOTAAN</title>


    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>
<body>

    <div class="content-wrapper">
        <section class="content-header">
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <h3 class="text-center my-4">Data Anggota</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Username</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>QR</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($keanggotaans as $keanggotaan)
                                        <tr>
                                            <td>
                                                @if($keanggotaan->foto)
                                                    <img src="{{ asset('uploads/' . $keanggotaan->foto) }}" alt="Foto" width="50">
                                                @else
                                                    No Photo
                                                @endif
                                            </td>
                                            <td>{{ $keanggotaan->nama }}</td>
                                            <td>{{ $keanggotaan->tempat_lahir }}</td>
                                            <td>{{ $keanggotaan->tgl_lahir }}</td>
                                            <td>{{ $keanggotaan->username }}</td>
                                            <td>{{ $keanggotaan->jenkel }}</td>
                                            <td>{{ $keanggotaan->telepon }}</td>
                                            <td>{{ $keanggotaan->email }}</td>
                                            <td>{{ $keanggotaan->alamat }}</td>
                                            <td>{{ $keanggotaan->qr_code }}</td>

                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-primary edit-button"
                                                    data-toggle="modal" data-target="#editModal-{{ $keanggotaan->id }}"
                                                    data-foto="{{ $keanggotaan->foto }}"
                                                    data-nama="{{ $keanggotaan->nama }}"
                                                    data-tempat_lahir="{{ $keanggotaan->tempat_lahir }}"
                                                    data-tgl_lahir="{{ $keanggotaan->tgl_lahir }}"
                                                    data-username="{{ $keanggotaan->username }}"
                                                    data-jenkel="{{ $keanggotaan->jenkel }}"
                                                    data-telepon="{{ $keanggotaan->telepon }}"
                                                    data-email="{{ $keanggotaan->email }}"
                                                    data-alamat="{{ $keanggotaan->alamat }}"
                                                    data-recordid="{{ $keanggotaan->id }}">Edit
                                                </a>
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('daftar.destroy', $keanggotaan->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>

</html>
