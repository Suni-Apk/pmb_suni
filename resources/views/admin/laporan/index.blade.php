@extends('layouts.master')

@section('title', 'Daftar Pendaftar')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="ca  rd mb-4 w-100">
                @foreach ($tahunAjaran as $angkatan)
                    <div class="card mb-4">
                        <h5 class="mt-4 text-center">Data Mahasiswa Angkatan {{ $angkatan->year }}</h5>
                        <form action="{{ route('admin.laporan.exportMahasiswaLaporan', $angkatan->id) }}" method="GET"
                            class="d-flex align-items-center justify-content-center mt-4">
                            @csrf
                            <button type="submit" class="btn btn-primary text-center w-30">Unduh Data</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-12">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h6>Traffic Pengguna Pertahun</h6>
                            <p class="text-sm">
                                <i class="fa fa-arrow-up text-success me-1"></i>
                                Grafik perkembangan jumlah pengguna pertahun
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h6>Daftar Pendaftar</h6>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.laporan.exportPendaftar') }}" method="GET">
                            <input type="hidden" name="angkatan_id" value="#">
                            <button class="btn btn-success ms-2 d-flex align-items-center">
                                <i class='bx bxs-file-export me-1'></i> Export
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama /
                                        Nomor Telepon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender /
                                        Role</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                        Biodata</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                        Dokumen</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                        Administrasi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                        Pra-Kuliah</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Bergabung pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswa as $index => $item)
                                    <tr>
                                        <td>
                                            <style>
                                                .wa-hover:hover {
                                                    color: #434c5a !important;
                                                    transition: .2s ease;
                                                }
                                            </style>
                                            <p class="text-xs font-weight-bold text-dark mb-0">{{ $item->name }}</p>
                                            <a class="text-secondary text-xs d-block wa-hover"
                                                href="https://api.whatsapp.com/send?phone={{ $item->phone }}&text=Hai!%20Kami%20dari%20{{ App\Models\General::first()->name }}">{{ $item->phone }}</a>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->gender }}</p>
                                            <p class="text-xs text-uppercase text-secondary mb-0">{{ $item->role }}</p>
                                        </td>
                                        {{-- status biodata --}}
                                        <td class="text-secondary text-xs font-weight-bold">
                                            @if ($item->biodata)
                                                <span class="badge rounded-pill bg-gradient-success">Lengkap <i
                                                        class="fas fa-plus ms-1"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-gradient-danger">Tidak Ada <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        {{-- status dokumen --}}
                                        <td class="text-secondary text-xs font-weight-bold">
                                            @if ($item->document)
                                                <span class="badge rounded-pill bg-gradient-success">Lengkap <i
                                                        class="fas fa-plus ms-1"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-gradient-danger">Tidak Ada <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        {{-- status administrasi --}}
                                        <td class="text-secondary text-xs font-weight-bold">
                                            @if ($item->biodata)
                                                <span class="badge rounded-pill bg-gradient-success">Lunas <i
                                                        class="fas fa-plus ms-1"></i></span>
                                            @else
                                                <span class="badge rounded-pill bg-gradient-danger">Belum dibayar <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        {{-- status pra-kuliah / daftar ulang --}}
                                        <td class="text-secondary text-xs font-weight-bold">
                                            @if ($item->biodata)
                                                @if ($item->biodata->address)
                                                    {{-- kalau udah selesai --}}
                                                    <span class="badge rounded-pill bg-gradient-success">Lunas <i
                                                            class="fas fa-plus ms-1"></i></span>
                                                @elseif ($item->biodata->angkatan)
                                                    {{-- kalau masih nyicil --}}
                                                    <span class="badge rounded-pill bg-gradient-warning">Cicil <i
                                                            class="fas fa-circle ms-1"></i></span>
                                                @endif
                                            @else
                                                {{-- kalau belum blas --}}
                                                <span class="badge rounded-pill bg-gradient-danger">Belum dibayar <i
                                                        class="fas fa-times ms-1"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs text-uppercase text-secondary font-weight-bold mb-0">
                                                {{ $item->created_at->format('d M Y') }}</p>
                                            <p class="text-xxs text-uppercase text-secondary mb-0">
                                                {{ $item->created_at->format('H:i:s') }}</p>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire(
                "{{ session('success') }}", // Menggunakan session('success') untuk mengambil pesan
                'You clicked the button!',
                'success'
            )
        </script>
    @endif
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#table", {
            searchable: true,
            fixedHeight: true,
        });
    </script>
    <script>
        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
        gradientStroke1.addColorStop(1, 'rgba(19, 169, 95,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)');

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ], // Ganti dengan nilai-nilai yang sesuai
                datasets: [{
                        label: "Admin",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3C9D9B",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [10, 50, 200, 40, 90, 100, 10, 20, 180, 190, 200,
                            20
                        ], // Ganti dengan nilai-nilai yang sesuai
                        maxBarThickness: 6
                    },
                    {
                        label: "Pendaftar",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#A9A9A9", // Ganti dengan warna yang sesuai
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: [30, 60, 150, 80, 70, 120, 30, 50, 160, 170, 180,
                            30
                        ], // Ganti dengan nilai-nilai yang sesuai
                        maxBarThickness: 6
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
