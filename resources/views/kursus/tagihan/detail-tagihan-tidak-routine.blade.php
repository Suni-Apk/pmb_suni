@extends('kursus.layouts.parent')

@section('title', 'table template')

@push('styles')

@endpush

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Tagihan Tidak Routine <span class="text-uppercase">{{Auth::user()->name}}</span></h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="templateTable">
                <thead>
                  <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Nama Tagihan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Tenggat</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- foreach here --}}
                  <tr>
                    <td class="text-center">
                        <span class="text-secondary text-xs font-weight-bold">KKN</span>
                    </td>
                    <td class="text-center">
                      <span class="text-secondary text-xs font-weight-bold">Agustus</span>
                    </td>
                    <td class="text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{number_format(100000)}}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">17-10-2023</span>
                    </td>
                  </tr>
                  {{-- endforeach --}}
                </tbody>
              </table>
            </div>
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