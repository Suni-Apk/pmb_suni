@extends('layouts.master')

@section('title', 'Matkul')

@push('styles')

@endpush

@section('content')
    <div class="row">
      <h4 class="ms-2">Jurusan Informatika</h4>
      {{-- foreach here --}}
      <div class="col-12 col-lg-6">
        <div class="card mb-4">
          <div class="card-header pb-0 d-flex justify-content-between">
            <div>
              <h6>Semester 1</h6>
            </div>
            <div class="flex-row d-flex">
              <a href="" class="btn btn-primary fs-6 p-2 px-3">
                <i class="fab fa-whatsapp"></i>
              </a>
              <a href="" class="btn btn-secondary fs-6 p-2 px-3 ms-2">
                <i class="fas fa-file-download"></i>
              </a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="templateTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Mata Kuliah</th>
                    <th class="text-uppercase text-secondary text-xxs px-2 font-weight-bolder opacity-7">Mulai</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Selesai</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Programming</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-text-start">
                      <span class="text-secondary text-xs font-weight-bold">19:20</span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">20:25</p>
                    </td>
                    <td class="align-text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0">17-10-2023</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{-- end forech --}}
    </div>
@endsection