<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mata Kuliah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        table {
            width: 80%;
            margin-top: 20px;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="d-flex">
                    <img src="{{ $instansi->image }}" alt='' class='' width='200'>
                </div>
            </div>
            <div>
                <h5 class="" style="margin-top: 130px; width:350px; text-align: right;">Jadwal Mata Kuliah Jurusan {{ $jurusan->name }}</h5>
            </div>        
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Semester</th>
                        <th>Hari</th>
                        <th>Waktu</th>
                    </tr>
            </thead>
            <tbody>
                @foreach ($matkuls as $matkul)
                    <tr>
                        <td>{{ $matkul->nama_matkuls }}</td>
                        <td>{{ $matkul->semesters->name }}</td>
                        <td>{{ $matkul->hari }}</td>
                        <td>{{ $matkul->mulai }} WIB - {{ $matkul->selesai }} WIB</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
