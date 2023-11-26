@extends('layouts.master')

@section('title', 'Tagihan')

@push('styles')
@endpush

@section('content')

    @php
        $transactionDaftar = App\Models\Transaksi::where('user_id', Auth::user()->id)
            ->where('jenis_tagihan', 'DaftarUlang')
            ->where('status', 'berhasil')
            ->where('jenis_pembayaran', 'cash')
            ->first();
        $biaya = App\Models\Biaya::where('program_belajar', 'S1')
            ->where('jenis_biaya', 'DaftarUlang')
            ->where('id_angkatans', Auth::user()->biodata->angkatan_id)
            ->latest()
            ->first();

        $user = Auth::user();
        $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
            ->where('id_users', $user->id)
            ->latest()
            ->first();
        $cicilans = App\Models\Cicilan::where('id_tagihan_details', $tagihan->id)->first();
        $cicilan2 = App\Models\Cicilan::where('id_tagihan_details', $tagihan->id)
            ->where('status', 'LUNAS')
            ->get();

    @endphp
    @if (!isset($cicilans) && !isset($transactionDaftar))
        <div class="col-12 text-center mb-4">
            <div class="card">
                <h3 class="mt-3">Tagihan</h3>
                <h5 class="text-secondary font-weight-normal">Daftar Ulang Langsung</h5>
                <div class="row">
                    <div class="d-flex align-items-center justify-content-center">
                        <form action="{{ route('mahasiswa.tagihan.daftar.ulang') }}" method="POST"
                            class="d-flex align-items-center justify-content-center w-100">
                            @csrf
                            @method('GET')
                            <div class="col-6 col-sm-4">
                                <button name="jenis_pembayaran" value="cash" type="submit"
                                    class="btn bg-gradient-primary sm:w-50">
                                    Cash
                                </button>
                            </div>
                            <div class="col-6 col-sm-4">
                                <button name="jenis_pembayaran" value="cicil" type="submit"
                                    class="btn bg-gradient-primary sm:w-50">
                                    Cicil 3x
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif($cicilans)
        @php
            $biaya = App\Models\Biaya::where('program_belajar', 'S1')
                ->where('jenis_biaya', 'DaftarUlang')
                ->where('id_angkatans', Auth::user()->biodata->angkatan_id)
                ->latest()
                ->first();

            $user = Auth::user();
            $tagihan = App\Models\TagihanDetail::where('id_biayas', $biaya->id)
                ->where('id_users', $user->id)
                ->latest()
                ->first();

      // Menghitung total pembayaran yang telah dilakukan
      $total_pembayaran = App\Models\Transaksi::where('user_id', $user->id)
          ->where('tagihan_detail_id', $tagihan->id)
          ->where('jenis_tagihan', $biaya->jenis_biaya)
          ->where('status', 'berhasil')
          ->where('jenis_pembayaran','cicil')
          ->sum('total');

      // Hitung setengah dari $jumlah_uang_daftar_ulang
      $setengah_jumlah_daftar_ulang = $tagihan->amount * 2/3;
      
      // Hitung sepersepuluh dari $jumlah_uang_daftar_ulang
      $sepertiganya_jumlah_daftar_ulang = $tagihan->amount / 3;

      // Mengecek apakah mahasiswa telah berhasil membayar cicilan pertama
     

      // Mengecek apakah mahasiswa telah berhasil membayar cicilan kedua
      

      // Mengecek apakah mahasiswa telah berhasil membayar cicilan ketiga
      

      // dd($cicilan_pertama_terbayar, $cicilan_kedua_terbayar, $cicilan_ketiga_terbayar);
    @endphp

    @if ($total_pembayaran == $sepertiganya_jumlah_daftar_ulang)
    <div class="row">
      {{-- INI ADALAH CARD BUAT TAGIHAN DAFTAR ULANG CICIL --}}
      <div class="col-12 text-center mb-4">
      <div class="card">
        <h3 class="mt-3">Tagihan</h3>
        <h5 class="text-secondary font-weight-normal">Daftar Ulang Nyicil</h5>
        <div class="multisteps-form">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto mb-5">
              <div class="multisteps-form__progress">
                <button class="multisteps-form__progress-btn js-active" type="button" title="Cicil Pertama">
                  <span>Cicil Pertama</span>
                </button>
                <button class="multisteps-form__progress-btn" type="button" title="Cicil Kedua">
                  <span>Cicil Kedua</span>
                </button>
                <button class="multisteps-form__progress-btn" type="button" title="Cicil Ketiga">
                  <span>Cicil Ketiga</span>
                </button>
              </div>
            </div>
            <form action="{{route('mahasiswa.tagihan.daftar.ulang')}}" method="POST">
              @csrf
              @method('GET')
              <div class="col-12 col-lg-8 mx-auto">
                <button type="submit" name="jenis_pembayaran" value="cicil" class="btn bg-gradient-primary">
                  Bayar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    @elseif($total_pembayaran == $setengah_jumlah_daftar_ulang)
    <div class="row">
      {{-- INI ADALAH CARD BUAT TAGIHAN DAFTAR ULANG CICIL --}}
      <div class="col-12 text-center mb-4">
      <div class="card">
        <h3 class="mt-3">Tagihan</h3>
        <h5 class="text-secondary font-weight-normal">Daftar Ulang Nyicil</h5>
        <div class="multisteps-form">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto mb-5">
              <div class="multisteps-form__progress">
                <button class="multisteps-form__progress-btn js-active" type="button" title="Cicil Pertama">
                  <span>Cicil Pertama</span>
                </button>
                <button class="multisteps-form__progress-btn js-active" type="button" title="Cicil Kedua">
                  <span>Cicil Kedua</span>
                </button>
                <button class="multisteps-form__progress-btn" type="button" title="Cicil Ketiga">
                  <span>Cicil Ketiga</span>
                </button>
              </div>
            </div>
            <form action="{{route('mahasiswa.tagihan.daftar.ulang')}}" method="POST">
              @csrf
              @method('GET')
              <div class="col-12 col-lg-8 mx-auto">
                <button type="submit" name="jenis_pembayaran" value="cicil" class="btn bg-gradient-primary">
                  Bayar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    @elseif($total_pembayaran >= $tagihan->amount)
    <div class="row">
      {{-- INI ADALAH CARD BUAT TAGIHAN DAFTAR ULANG CICIL --}}
      <div class="col-12 text-center mb-4">
      <div class="card">
        <h3 class="mt-3">Tagihan</h3>
        <h5 class="text-secondary font-weight-normal">Daftar Ulang Nyicil</h5>
        <div class="multisteps-form">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto mb-5">
              <div class="multisteps-form__progress">
                <button class="multisteps-form__progress-btn js-active" type="button" title="Cicil Pertama">
                  <span>Cicil Pertama</span>
                </button>
                <button class="multisteps-form__progress-btn js-active" type="button" title="Cicil Kedua">
                  <span>Cicil Kedua</span>
                </button>
                <button class="multisteps-form__progress-btn js-active" type="button" title="Cicil Ketiga">
                  <span>Cicil Ketiga</span>
                </button>
              </div>
            </div>
            {{-- <form action="{{route('mahasiswa.tagihan.daftar.ulang')}}" method="POST">
              @csrf
              @method('GET')
              <div class="col-12 col-lg-8 mx-auto">
                <button type="submit" name="jenis_pembayaran" value="cicil" class="btn bg-gradient-primary">
                  Bayar
                </button>
              </div>
            </form> --}}
          </div>
        </div>
      </div>
      </div>
    @else
    <div class="row">
      {{-- INI ADALAH CARD BUAT TAGIHAN DAFTAR ULANG CICIL --}}
      <div class="col-12 text-center mb-4">
      <div class="card">
        <h3 class="mt-3">Tagihan</h3>
        <h5 class="text-secondary font-weight-normal">Daftar Ulang Nyicil</h5>
        <div class="multisteps-form">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto mb-5">
              <div class="multisteps-form__progress">
                <button class="multisteps-form__progress-btn js-active" type="button" title="Cicil Pertama">
                  <span>Cicil Pertama</span>
                </button>
                <button class="multisteps-form__progress-btn" type="button" title="Cicil Kedua">
                  <span>Cicil Kedua</span>
                </button>
                <button class="multisteps-form__progress-btn" type="button" title="Cicil Ketiga">
                  <span>Cicil Ketiga</span>
                </button>
              </div>
            </div>
            <form action="{{route('mahasiswa.tagihan.daftar.ulang')}}" method="POST">
              @csrf
              @method('GET')
              <div class="col-12 col-lg-8 mx-auto">
                <button type="submit" name="jenis_pembayaran" value="cicil" class="btn bg-gradient-primary">
                  Bayar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    @endif
  @else
    @if (!$transactionDaftar->jenis_pembayaran == 'cash')
      <div class="col-12 text-center mb-4">
        <div class="card">
        <h3 class="mt-3">Tagihan</h3>
        <h5 class="text-secondary font-weight-normal">Daftar Ulang Langsung</h5>
        <div class="multisteps-form">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto mb-5">
              <div class="multisteps-form__progress">
                <button class="multisteps-form__progress-btn js-active" type="button" title="Bayar Cash">
                  <span>Bayar Cash</span>
                </button>
                <button class="multisteps-form__progress-btn " type="button" title="Lunas">
                  <span>Lunas</span>
                </button>
              </div>
            </div>
            <div class="col-12 col-lg-8 mx-auto">
              <button class="btn btn-primary">
                Bayar
              </button>
            </div>
          </div>
        </div>
        </div>
      </div>
    @else
      <div class="col-12 text-center mb-4">
        <div class="card">
        <h3 class="mt-3">Tagihan</h3>
        <h5 class="text-secondary font-weight-normal">Daftar Ulang Langsung</h5>
        <div class="multisteps-form">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto mb-5">
              <div class="multisteps-form__progress">
                <button class="multisteps-form__progress-btn js-active" type="button" title="Bayar Cash">
                  <span>Bayar Cash</span>
                </button>
                <button class="multisteps-form__progress-btn js-active" type="button" title="Lunas">
                  <span>Lunas</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    @endif
  @endif
    @php
      $biaya = App\Models\Biaya::where('program_belajar','S1')->where('jenis_biaya','DaftarUlang')->where('id_angkatans',Auth::user()->biodata->angkatan_id)->latest()->first();
      
      $user = Auth::user();
      $tagihan = App\Models\TagihanDetail::where('id_biayas',$biaya->id)->where('id_users',$user->id)->latest()->first();
      // $bagi3 = $tagihan->amount / 3;
      // dd($bagi3);
      $transaction = App\Models\Transaksi::where('user_id',$user->id)->where('tagihan_detail_id',$tagihan->id)->where('jenis_tagihan',$biaya->jenis_biaya)->where('status','berhasil')->sum('total');
    @endphp
    @if ($transaction != $tagihan->amount)
      
    @else
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Pembayaran Routine</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="templateTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Tagihan</th>
                      <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Jenis Tagihan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Angkatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                            <h6 class="mb-0 text-sm text-center">1</h6>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                            <h6 class="mb-0 text-sm text-center">SPP</h6>
                        </div>
                      </td>
                      <td class="align- text-start">
                        <span class="text-secondary text-xs font-weight-bold">Routine</span>
                      </td>
                      <td class="align- text-start">
                        <span class="text-secondary text-xs font-weight-bold">2023</span>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Informatika</p>
                      </td>
                      <td>
                        <a href="{{route('mahasiswa.tagihan.detail.spp',Auth::user()->name)}}" class="badge badge-sm bg-gradient-primary font-weight-bold text-xs mx-2" data-toggle="tooltip" data-original-title="Edit user">
                          Detail
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Pembayaran Tidak Routine</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="templateTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 width-32-px">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Tagihan</th>
                      <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Jenis Tagihan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Angkatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                          <h6 class="text-secondary mb-0 text-sm text-center">#1</h6>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                            <h6 class="mb-0 text-sm text-center">KKN</h6>
                        </div>
                      </td>
                      <td class="align- text-start">
                        <span class="text-secondary text-xs font-weight-bold">Tidak Routine</span>
                      </td>
                      <td class="align- text-start">
                        <span class="text-secondary text-xs font-weight-bold">2023</span>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Informatika</p>
                      </td>
                      <td>
                        <a href="{{route('mahasiswa.tagihan.detail.tidak.routine',Auth::user()->name)}}" class="badge badge-sm bg-gradient-primary font-weight-bold text-xxs" data-toggle="tooltip" data-original-title="Edit user">
                          Detail
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
@endif
@endif
@endif



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
@if (session('error'))
<script>
    Swal.fire(
        "{{ session('error') }}", // Menggunakan session('success') untuk mengambil pesan
        'You clicked the button!',
        'error'
    )
</script>
@endif
<script>
    $(function(e) {
        $("#select_all_ids").click(function() {
            $('.checksAll').prop('checked', $(this).prop('checked'));
        });
        $("#select_all_ids2").click(function() {
            $('.checksAll2').prop('checked', $(this).prop('checked'));
        });
        $("#select_all_ids3").click(function() {
            $('.checksAll3').prop('checked', $(this).prop('checked'));
        });
    });
</script>
@endpush
