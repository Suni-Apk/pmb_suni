@extends('layouts.master')

@section('title', 'Dokumentasi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Panduan Alur Sistem</h5>
                </div>
                <div class="card-body row">
                    <div class="accordion accordion-flush" id="accordionParent">
                    {{-- @for ($i = 1; $i <= 8; $i++) --}}
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tutor-1" aria-expanded="false" aria-controls="tutor-1">
                                #1 Membuat Data Tahun Ajaran
                                </button>
                            </h6>
                            <div id="tutor-1" class="accordion-collapse collapse" data-bs-parent="#accordionParent">
                                <div class="accordion-body">
                                    Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.
                                </div>
                            </div>
                        </div>
                        {{-- @endfor --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection