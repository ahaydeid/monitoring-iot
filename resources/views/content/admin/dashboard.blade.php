@extends('layouts.main')
@section('content-page')
<div class="row d-flex justify-content-center">
    <div class="col-md-2">
        <div class="card bg-light text-white mb-4 shadow-sm" style="border-radius : 20px;">
            <div class="card-body text-dark">
                <div class="mb-3">
                    <small>TDS</small>
                </div>
                <div class="mt-3 mb-4">
                    <h2 class="text-center" id="tds">{{ (isset($device)) ? ($device->tds) : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-light text-white mb-4 shadow-sm" style="border-radius : 20px;">
            <div class="card-body text-dark">
                <div class="mb-3">
                    <small>PH</small>
                </div>
                <div class="mt-3 mb-4">
                    <h2 class="text-center" id="ph">{{ (isset($device)) ? ($device->ph) : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-light text-white mb-4 shadow-sm" style="border-radius : 20px;">
            <div class="card-body text-dark">
                <div class="mb-3">
                    <small>Temperatur</small>
                </div>
                <div class="mt-3 mb-4">
                    <h2 class="text-center" id="temperatur">{{ (isset($device)) ? ($device->suhu) : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="mt-5">
        <a href="javascrit:void(0);" class="btn btn-primary shadow-sm" id="AddTanaman"><i class="fa fa-plus"></i>Tambah Tanaman</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered w-100" id="TanamanTbl">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">jenis Sayur</th>
                    <th class="text-center">Kuantitas Tanam</th>
                    <th class="text-center">Tersedia</th>
                    <th class="text-center">Dipesan</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@include('includes.modal.tambah_tanaman')
@include('includes.modal.detail_tanam')
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function(){
        function RealTimeData(){
            $.ajax({
                url : '/auto-load-data',
                type : 'post',
                dataType : 'json',
                success : function(data){
                    $('#tds').html(data.tds)
                    $('#ph').html(data.ph)
                    $('#temperatur').html(data.suhu)
                }
            })
        }
        setInterval(function(){
            RealTimeData() // this will run after every 5 seconds
        }, 5000);
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        var tblTnm = $('#TanamanTbl').DataTable({
            processing: true,
            serverSide: true,
            destroy : true,
            ajax: {
                url: '/get-tanaman',
                type: 'post',
            },
            order:  [1, 'asc'],
            columns: [
                { data: 'no', name:'id', sortable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className : "dt-center"
                },
                {
                    data: 'jenis_sayur',
                    name : 'jenis_sayur',
                },
                {
                    data: 'kuantitas_tanam',
                    name : 'kuantitas_tanam',
                    className : 'dt-center'
                },
                {
                    data: 'tersedia',
                    render : function(data){
                        var text = `<span class="text-success fw-bold">${data}</span>`;
                        return text;
                    },
                    className : 'dt-center'
                },
                {
                    data: 'dipesan',
                    name : 'dipesan',
                    className : 'dt-center'
                },
                {
                    data: 'action',
                    name : 'action',
                    className : 'dt-center'
                },
            ]
            
        })
        $('#AddTanaman').on('click',function(e){
            e.preventDefault();
            $('#tambahTanaman').modal('show');
            $.ajax({
                url : '/tanaman',
                dataType : 'json',
                beforeSend : function(){

                },
                success :function(respon){
                    sayur = '<option value="" selected>--pilih--</option>';
                    $.each(respon.tanaman,function(key,val){
                        sayur += `<option value = "`+val.id+`">`+val.jenis_sayur+`</option>`
                    })
                    $('#jenisSayur').html(sayur);
                },
                error :function(){
                    alert('Terjadi kesalahan !')
                }
            })
        })
        $('#formAddTanaman').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            Swal.fire({
                text: "Apakah anda akan menyimpan data ini ? ",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ya'
            }).then(function(confirm){
                if(confirm.value == true){
                    $.ajax({
                        url : '/store-tanaman',
                        type : 'post',
                        data : data,
                        dataType : 'json',
                        beforeSend : function(){

                        },
                        success :function(respon){
                            if(respon.status == 'success'){
                                $('#tambahTanaman').modal('hide');
                                $('#formAddTanaman')[0].reset();
                                tblTnm.ajax.reload();
                            }
                            swal.fire({
                                icon : respon.status,
                                text : respon.msg
                            })
                        },
                        error : function(){

                        }
                    })
                }
            })
        })
        $(document).on('click','.show-dtl',function(e){
            e.preventDefault();
            $('#Dtltanam').modal('show')
            var id = $(this).attr('data-id');
            var jenis_sayur = 'JENIS SAYUR  '+$(this).attr('data-jenis');
            $('#head').html(`
            <p class="fw-bold fs-5">`+jenis_sayur+`</p>
            <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            `)
            loadDetail(id)
        })
        function loadDetail(id){
            $('#DtlTanamanTanam').DataTable({
            processing: true,
            serverSide: true,
            destroy : true,
            ajax: {
                url: '/get-detail-tanam',
                type: 'post',
                data : {id : id},
            },
            order:  [1, 'asc'],
            columns: [
                { data: 'no', name:'id', sortable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className : "dt-center"
                },
                {
                    data: 'tanggal_tanam',
                    name : 'tanggal_tanam',
                    className : 'dt-center'
                },
                {
                    data: 'tanggal_panen',
                    render : function(data,row,type){
                        const date = new Date();
                        let day = date.getDate();
                        let month = date.getMonth() + 1;
                        let year = date.getFullYear();
                        let currentDate = `${year}-${month}-${day}`;                    
                        var tanggal1 = new Date(data);
                        var tanggal2 = new Date(currentDate);
                        tanggal1.setHours(0, 0, 0, 0);
                        tanggal2.setHours(0, 0, 0, 0);
                        var selisih = Math.abs(tanggal1 - tanggal2);
                        var hariDalamMillisecond = 1000 * 60 * 60 * 24;
                        var waitPanen = Math.round(selisih / hariDalamMillisecond);
                        var btn ='';
                        if(tanggal1 <= tanggal2){
                            btn = '<button class= "btn btn-success btn-sm shadow-sm">Panen</button>';
                        }else{
                            btn = "-"+waitPanen;  
                        }
                        return btn;
                    },
                    className : 'dt-center'
                },
                {
                    data: 'kuantitas_tanam',
                    name : 'kuantitas_tanam',
                    className : 'dt-center'
                },
            ]
            
            })
        }
    })
</script>
@endsection