<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Daftar Film</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #555;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        h1, h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .modal-title {
            color: #343a40;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .modal-body input[type="text"],
        .modal-body input[type="number"],
        .modal-body input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .modal-body button[type="submit"] {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .modal-body button[type="submit"]:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel - Daftar Film</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h2>Daftar Film</h2>
        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahFilmModal">Tambah Film</button>

        <!-- Modal Tambah Film -->
        <div class="modal fade" id="tambahFilmModal" tabindex="-1" role="dialog" aria-labelledby="tambahFilmModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahFilmModalLabel">Tambah Film Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
<!-- Form tambah film -->
<form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" required>
    </div>
    <div>
        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" required>
    </div>
    <div>
        <label for="durasi">Durasi:</label>
        <input type="number" name="durasi" id="durasi" required>
    </div>
    <div>
        <label for="genre">Genre:</label>
        <input type="text" name="genre" id="genre" required>
    </div>
    <div>
        <label for="gambar">Gambar:</label>
        <input type="file" name="img" id="gambar" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Harga</th>
                    <th>Durasi</th>
                    <th>Genre</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                    <tr>
                        <td>{{ $film->judul }}</td>
                        <td>{{ $film->harga }}</td>
                        <td>{{ $film->durasi }}</td>
                        <td>{{ $film->genre }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editFilmModal{{ $film->id }}">Edit</button>
                            <form action="{{ route('admin.destroy', $film->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus film ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Film -->
                    <div class="modal fade" id="editFilmModal{{ $film->id }}" tabindex="-1" role="dialog" aria-labelledby="editFilmModal{{ $film->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editFilmModal{{ $film->id }}Label">Edit Film</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.update', $film->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label for="judul">Judul:</label>
                                            <input type="text" name="judul" id="judul" value="{{ $film->judul }}" required>
                                        </div>
                                        <div>
                                            <label for="harga">Harga:</label>
                                            <input type="number" name="harga" id="harga" value="{{ $film->harga }}" required>
                                        </div>
                                        <div>
                                            <label for="durasi">Durasi:</label>
                                            <input type="number" name="durasi" id="durasi" value="{{ $film->durasi }}" required>
                                        </div>
                                        <div>
                                            <label for="genre">Genre:</label>
                                            <input type="text" name="genre" id="genre" value="{{ $film->genre }}" required>
                                        </div>
                                        <div>
                                            <label for="gambar">Gambar:</label>
                                            <input type="file" name="gambar" id="gambar">
                                            <img src="{{ asset('img/' . $film->gambar) }}" alt="{{ $film->judul }}" style="max-width: 100px;">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
