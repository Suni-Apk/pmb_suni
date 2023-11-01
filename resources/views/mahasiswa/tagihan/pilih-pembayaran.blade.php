@extends('layouts.master')

@section('title', 'table template')

@push('styles')

@endpush

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Detail Tagihan SPP <span class="text-uppercase">{{Auth::user()->name}}</span></h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table mb-0 w-100" id="templateTable">
                    <thead class="bg-dark">
                      <tr>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">MAHASISWA INFORMASI</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- foreach here --}}
                      <tr>
                        <td>
                            <div class="d-flex flex-column">
                                <label for="" class="form-label border-bottom border-primary">NAMA : <strong>Muhammad Farhan</strong></label>
                                <label for="" class="form-label border-bottom border-primary">ANGKATAN : <strong>2023</strong></label>
                                <label for="" class="form-label border-bottom border-primary">JURUSAN : <strong>INFORMATIKA</strong></label>
                            </div>
                        </td>
                      </tr>
                      {{-- endforeach --}}
                    </tbody>
                  </table>
                <table class="table mb-0 w-100" id="templateTable">
                    <thead class="bg-dark">
                      <tr>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">TAGIHAN INFORMASI</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- foreach here --}}
                      <tr>
                        <td class="d-flex flex-column">
                                <label for="" class="form-label border-bottom border-primary">STATUS TAGIHAN : <strong>Belum Di Bayar</strong></label>
                                <label for="" class="form-label border-bottom border-primary">TOTAL BAYAR : <strong>Rp {{number_format(1000000)}}</strong></label>
                        </td>
                      </tr>
                      {{-- endforeach --}}
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
              <a class="btn border border-secondary col-6">Transfer Bank</a>
              <a class="btn border border-primary col-6 ms-2">Pembayaran Online</a>
            </div>
          </div>
      </div>
    </div>
    </div>
@endsection

@push('scripts')
<script>
	const dataTableSearch = new simpleDatatables.DataTable("#templateTableNoSearch", {
      searchable: false,
      fixedHeight: true,
    });

	const dataTableBasic = new simpleDatatables.DataTable("#templateTable", {
      searchable: true,
      fixedHeight: true,
    });
</script>
@endpush