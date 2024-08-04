
@extends('layouts.mainLanding')
@section('landing')
 <section class="zero mb-5 mx-5">
     <div class="mx-5 mt-5">
         <div class="row d-flex justify-content-center">
            <h4 class="fw-bold" style="color:#1AD30A;">TaniKini</h4>
            <p class="fw-bold">“Menghubungkan sayur segar <br/>dari ladang dengan meja makan”</p>
            <div>
            <button class="btn btn-primary" style="border-radius:50px">Masuk ke Ladang <i class="fa fa-user"></i></button>
        </div>
         </div>
     </div>
 </section>
 <section class="mb-5">
     <div class="mx-5">
         <div class="row d-flex justify-content-center">
            <div class="card mt-5 col-md-4 ms-2 me-2 bg-light align-self-center" style="width: 15rem; height:18rem">
                <div class="card-body" style="padding-left: 0 !important;padding-right: 0 !important;">
                    
                </div>
            </div>
            <div class="card mt-5 col-md-4 ms-2 me-2 bg-light align-self-center" style="width: 15rem; height:18rem">
                <div class="card-body" style="padding-left: 0 !important;padding-right: 0 !important;">
                    
                </div>
            </div>
            <div class="card mt-5 col-md-4 ms-2 me-2 bg-light align-self-center" style="width: 15rem; height:18rem">
                <div class="card-body" style="padding-left: 0 !important;padding-right: 0 !important;">
                    
                </div>
            </div>
            <div class="card mt-5 col-md-4 ms-2 me-2 bg-light align-self-center" style="width: 15rem; height:18rem">
                <div class="card-body" style="padding-left: 0 !important;padding-right: 0 !important;">
                    
                </div>
            </div>
         </div>
     </div>
 </section>
 <section class="tentang mb-5 mx-5" id="tentang">
     <div class="mx-5">
         <div class="row d-flex justify-content-center">
            <h4>Tentang</h4>
            <p>Tanikini adalah aplikasi IoT yang diciptakan untuk menjawab tantangan yang dihadapi oleh petani hidroponik modern. Latar belakang penciptaan Tanikini berakar pada kebutuhan untuk meningkatkan efisiensi dan produktivitas pertanian hidroponik, sambil meminimalkan dampak lingkungan. Pertanian hidroponik, meskipun menawarkan solusi pertanian yang lebih berkelanjutan dibandingkan metode tradisional, masih menghadapi kendala dalam hal pemantauan kondisi tanaman secara real-time dan manajemen sumber daya yang optimal. Tanikini hadir untuk menjembatani kesenjangan ini dengan menyediakan teknologi pemantauan canggih yang memungkinkan petani mengakses data kritis tentang kelembaban, nutrisi, dan suhu tanaman secara langsung melalui aplikasi.</p>
            <p>Kendala utama yang dihadapi oleh petani hidroponik saat ini termasuk kesulitan dalam memantau dan mengelola kondisi tanaman secara terus-menerus, yang dapat mengakibatkan penurunan kualitas dan hasil panen. Selain itu, akses pasar yang terbatas sering kali membuat petani sulit menjual produk mereka dengan harga yang adil. Tanikini menawarkan solusi melalui sistem pemantauan berbasis IoT yang memungkinkan pemantauan kondisi tanaman secara real-time, sehingga petani dapat segera mengambil tindakan yang diperlukan untuk menjaga kualitas tanaman. Selain itu, aplikasi ini juga berfungsi sebagai platform penghubung antara petani dan konsumen, memungkinkan konsumen memesan sayuran segar langsung dari petani tanpa melalui perantara, yang memastikan harga yang lebih baik bagi petani dan produk segar berkualitas tinggi bagi konsumen.</p>
            <p>Dampak positif yang dihasilkan oleh Tanikini sangat signifikan, baik bagi petani maupun konsumen. Bagi petani, aplikasi ini tidak hanya meningkatkan efisiensi dan produktivitas pertanian, tetapi juga membuka akses pasar yang lebih luas, meningkatkan pendapatan mereka secara keseluruhan. Sementara itu, konsumen mendapatkan keuntungan dari produk sayuran yang lebih segar dan berkualitas tinggi, yang dihasilkan dengan praktik pertanian yang lebih berkelanjutan. Dengan tagline “Menghubungkan sayur segar dari ladang dengan meja makan,” Tanikini berkomitmen untuk menciptakan ekosistem pertanian yang lebih efisien, berkelanjutan, dan saling menguntungkan bagi semua pihak yang terlibat.</p>
        </div>
     </div>
 </section>
 <section class="contact mb-5 mx-5" id="kontak">
     <div class="mx-5">
         <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body bg-light">
                        <h4 class="mb-5 text-center">Kirim Pesan ke Kami</h4>
                        <input type="text" class="form-control mb-3" name="">
                        <input type="text" class="form-control mb-3" name="">
                        <textarea class="form-control mb-4" cols ="5"></textarea>
                        <input type="text" class="form-control mb-3" name="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row ms-4 d-flex justify-content-center">
                    <div class="row mb-4">
                        <div class="col-md-4">No Telepon</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-7">0838914958154</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">WhatsApp</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-7">0838914958154</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">E-Mail</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-7">adi.hadi270@gmail.com</div>
                    </div>
                </div>
            </div>
         </div>
     </div>
 </section>
 @endsection
 