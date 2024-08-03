@extends('layouts.main')
@section('content-page')
<div class="row">
    <div class="mt-4">
        <a href="javascrit:void(0);" class="btn btn-primary shadow-sm" id="AddPembeli"><i class="fa fa-plus"></i>Tambah Pembeli</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered w-100" id="tblKatalog">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Pembeli</th>
                    <th class="text-center">jenis Sayur</th>
                    <th class="text-center">Tanggal Panen</th>
                    <th class="text-center">Quantitas Pesan</th>
                    <th class="text-center">Kontak</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@include('includes.modal.tambah_pembeli')
@include('includes.modal.edit_pembeli')
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
    });
    var tblKategory = $('#tblKatalog').DataTable({
        processing: true,
        serverSide: true,
        destroy : true,
        ajax: {
            url: '/get-katalog',
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
                data: 'nama_pembeli',
                name : 'nama_pembeli',
            },
            {
                data: 'jenis_sayur',
                name : 'jenis_sayur',
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
                data: 'kuantitas_pesan',
                name : 'kuantitas_pesan',
                className : 'dt-center'
            },
            {
                data: 'kontak',
                render : function(data){
                    var btn = '<i class="fa-brands fa-whatsapp fa-2x text-success fw-bold"></i>';
                    return btn;
                },
                className : 'dt-center'
            },
            {
                data: 'action',
                data: 'action',
                className : 'dt-center'
            },
        ]
        
    })
    $('#AddPembeli').on('click',function(e){
        e.preventDefault();
        $('#tambahPembeli').modal('show');
    })
    $('#jenisSayur').on('change',function(){
        var id = $(this).val();
        $.ajax({
            url : '/get-tanggal-panen',
            type :'post',
            data : { id : id},
            dataType : 'json',
            success : function(respon){
                var list = '<option value="">-- Pilih tanggal -- </option>';
                $.each(respon, function(key,val){
                    list += `<option value="`+val.id+`">`+val.tanggal_panen+`</option>`;
                })
                $('#tgl_panen').html(list);
            }
        })
    })
    $('#tgl_panen').on('change',function(){
        var id = $(this).val();
        $.ajax({
            url : '/get-stok-panen',
            type :'post',
            data : { id : id},
            dataType : 'json',
            success : function(respon){
                var stock = 0;
                if(respon.tersedia <= 0 || respon.tersedia ==''){
                    stock = 0;
                }else{
                    stock = respon.tersedia;
                }
                $('#terSediaStock').val(stock);
                $('#id_dtl_tanam').val(respon.id);
                $('#tglActPanen').val(respon.tanggal_panen);
            }
        })
    }) 
    $('#kuantitasPesan').on('keyup',function(){
        var val = $(this).val();
        var avilable = $('#terSediaStock').val();
        if(parseInt(val) > parseInt(avilable)){
            $(this).val('')
        }
    })
    $('#formAddKatalog').on('submit',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        Swal.fire({
            text: "Apakah anda akan menyimpan data ini?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ya'
        }).then(function(confirm){
            if(confirm.value == true){
                $.ajax({
                    url : '/store-katalog',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success :function(respon){
                        if(respon.status == 'success'){
                            $('#tambahPembeli').modal('hide');
                            tblKategory.ajax.reload();
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
    $(document).on('click','.edit-katalog',function(e){
        e.preventDefault();
        $('#updatePembeli').modal('show');
        var id = $(this).attr('data-id');
        $.ajax({
            url : 'edit-katalog',
            type : 'post',
            data : { id : id },
            dataType : 'json',
            success : function (respon){
                $('#editid').val(respon.data.id)
                $('#editId_dtl_tanam').val(respon.data.id_detail_tanam)
                $('#editTglActPanen').val(respon.data.tanggal_panen)
                $('#editKontak').val(respon.data.kontak)
                var stk = parseInt(respon.data.kuantitas_pesan) + parseInt(respon.data.tersedia)
                $('#note').html('*Maksimal yang bisa dipesan '+ stk )
                $('#tersediaAct').val(stk)
                $('#editTerSediaStock').val(respon.data.tersedia)
                $('#editKuantitasPesan').val(respon.data.kuantitas_pesan)
                $('#editNamaPembeli').val(respon.data.nama_pembeli)
                var jenissayur = `<option value="">`+respon.data.jenis_sayur+`</option>`;
                $('#editJenisSayur').html(jenissayur)
                $('#edittgl_panen').val(respon.data.tanggal_panen)
                $('#editTgl_panen').html(`<option value="`+respon.data.tanggal_panen+`">`+respon.data.tanggal_panen+`</option>`)
            }
        })
    })
    $('#editKuantitasPesan').on('keyup',function(){
        var input = $('#editKuantitasPesan').val();
        var Act = $('#tersediaAct').val();
        if(parseInt(Act) < parseInt(input) ){
            $('#editKuantitasPesan').val('');
        }
    })
    $('#formUpdateKatalog').on('submit',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        Swal.fire({
            title: 'Apakah anda yakin ?',
            text: "Ingin memperbarui data ini ? ",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ya'
        }).then(function(confirm){
            if(confirm.value == true){
                $.ajax({
                    url : '/update-katalog',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success :function(respon){
                        if(respon.status == 'success'){
                            $('#updatePembeli').modal('hide');
                            tblKategory.ajax.reload();
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
    $(document).on('click','.del-katalog',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id')
        Swal.fire({
            title: 'Apakah anda yakin ?',
            text: "Ingin menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ya'
        }).then(function(confirm){
            if(confirm.value == true){
                $.ajax({
                    url : '/hapus-katalog',
                    type : 'post',
                    data : {id : id},
                    beforeSend : function(){

                    },
                    success : function(respon){
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                        tblKategory.ajax.reload();
                    },
                    error : function (){
                        alert('Terjadi kesalahan !')
                    }
                })
            }
        })
    })
    $(document).on('click','.selesai-pesan',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id')
        Swal.fire({
            text: "Apakah pesanan sudah selesai ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ya'
        }).then(function(confirm){
            if(confirm.value == true){
                $.ajax({
                    url : 'selesai-katalog',
                    type : 'post',
                    data : {id : id},
                    beforeSend : function(){

                    },
                    success : function(respon){
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                        tblKategory.ajax.reload();
                    },
                    error : function (){
                        alert('Terjadi kesalahan !')
                    }
                })
            }
        })
    })
</script>
@endsection