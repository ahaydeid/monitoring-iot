@extends('layouts.main')
@section('content-page')
<div class="row">
    <div class="mt-4">
        <a href="javascrit:void(0);" class="btn btn-primary shadow-sm" id="AddTanaman"><i class="fa fa-plus"></i>Tambah Jenis Sayur</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered w-100" id="tblTanaman">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">jenis Sayur</th>
                    <th class="text-center">gambar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@include('includes.modal.tambah_jenis_sayur')
@include('includes.modal.edit_jenis_sayur')
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
    });
    var tblJenisSayur = $('#tblTanaman').DataTable({
        processing: true,
        serverSide: true,
        destroy : true,
        ajax: {
            url: '/get-jenis-sayur',
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
                data: 'gambar',
                render :function(data){
                    var img = `<img src ="`+data+`" class="img-fluid" height="50" width="50" alt="gambar">`;
                    return img;
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
    $('#AddTanaman').on('click',function(e){
        e.preventDefault();
        $('#tambahTanaman').modal('show');
    })
    $('#formAddTanaman').on('submit',function(e){
        e.preventDefault();
        var data = new FormData(this);
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
                    url : '/store-jenis-sayur',
                    type : 'post',
                    data : data,
                    contentType : false,
                    processData : false,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success :function(respon){
                        if(respon.status == 'success'){
                            $('#tambahTanaman').modal('hide');
                            tblJenisSayur.ajax.reload();
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
    $(document).on('click','.edit-tanaman',function(e){
        e.preventDefault();
        $('#updateTanaman').modal('show');
        var id = $(this).attr('data-id');
        $.ajax({
            url : 'edit-jenis-sayur',
            type : 'post',
            data : { id : id },
            dataType : 'json',
            success : function (respon){
                $('#id').val(respon.id)
                $('#jenis_sayur').val(respon.jenis_sayur)
                
            }
        })
    })
    $('#formUpdateTanaman').on('submit',function(e){
        e.preventDefault();
        var data = new FormData(this);
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
                    url : '/update-jenis-sayur',
                    type : 'post',
                    data : data,
                    contentType : false,
                    processData : false,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success :function(respon){
                        if(respon.status == 'success'){
                            $('#updateTanaman').modal('hide');
                            tblJenisSayur.ajax.reload();
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
    $(document).on('click','.del-tanaman',function(e){
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
                    url : '/hapus-jenis-sayur',
                    type : 'post',
                    data : {id : id},
                    beforeSend : function(){

                    },
                    success : function(respon){
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                        tblJenisSayur.ajax.reload();
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