
   @extends('layouts.mainLanding')
   @section('landing')
    <section class="mb-5">
        <div class="mx-5">
            <div class="row d-flex justify-content-center">
                @foreach ($data as $sayur)
                    <div class="card mt-5 col-md-4 ms-2 me-2 bg-light align-self-center" style="width: 18rem;">
                        <img src="{{ asset('storage/image/'.basename($sayur->gambar))}}" class="card-img-top" width="100%" height="150" style="padding-left: 0% !important; padding-right:0% !important" alt="jenis-sayur">
                        <div class="card-body" style="padding-left: 0 !important;padding-right: 0 !important;">
                            <h4 class="card-title">{{ $sayur->jenis_sayur }}</h4>
                            <div class="row">
                                <div class="col-md-6">Tanggal Tanam</div>
                                <div class="col-md-6"><span class="me-2">:</span>{{ $sayur->tanggal_tanam }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Panen Dalam</div>
                                <div class="col-md-6"><span class="me-2">:</span>{{ $sayur->tanggal_panen }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Kuantitas tersedia</div>
                                <div class="col-md-6"><span class="me-2">:</span>{{ $sayur->tersedia }}</div>
                            </div>
                           
                            <div class="row mx-4 mb-3 mt-3">
                                <a href="#" class="btn btn-primary text-center fw-bold shadow-sm" style="border-radius: 50px;">Booking</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endsection
    