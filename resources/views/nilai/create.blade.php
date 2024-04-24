<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Tambah Nilai Baru</h1>
    <form action="{{ route('nilai.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nim">Mahasiswa</label>
            <select name="nim" id="nim" class="form-control">
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs['nim'] }}">{{ '['. $mhs['nim'] .'] '.$mhs['nama']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kode_mk">Matakuliah</label>
            <select name="kode_mk" id="kode_mk" class="form-control">
                @foreach ($matakuliah as $mk)
                    <option value="{{ $mk['kode_mk'] }}">{{ '[' . $mk['kode_mk'] . '] ' . $mk['nama_mk'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nilai">Nilai</label>
            <input type="number" class="form-control" id="nilai" name="nilai" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
