@extends('_assets.layout.single')
@section('page_title', ' - Bagaimana menggunakan website ini')

@section('content')
<div class="container">
  <div class="row">
      <div class="card h-100 col-md-10 mx-auto">
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="align-middle card-title panel-heading">
                          <h3 class="panel-title text-center">Tutorial menggunakan website ini</h3>
                      </div>
                      <br/>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="container">
                                  <div class="alert alert-secondary">
                                      <h1>Daftar isi</h1>
                                      <ol>
                                          <li><a href="#enroll_course">Cara Mengikuti Kursus</a></li>
                                          <li><a href="#create_course">Cara Membuat Kursus</a></li>
                                          <li><a href="#add_lesson">Cara Menambah Pelajaran</a></li>
                                          <li><a href="#add_test">Cara Menambah Ujian</a></li>
                                          <li><a href="#add_question">Cara Menambah Question</a></li>
                                      </ol>
                                  </div>

                                  <h3 id="enroll_course">Cara Mengikuti Kursus</h3>
                                  <ol>
                                      <li>Cari dan Pilih Kursus</li>
                                      <li>Klik Enroll Sekarang</li>
                                      <li>Pelajari</li>
                                      <li>Ikuti Ujian</li>
                                      <li>Dapatkan Kelulusan</li>
                                  </ol>
                                  <h3 id="create_course">Cara Membuat Kursus</h3>
                                  <ol>
                                      <li>Menuju ke halaman Home</li>
                                      <li>Klik tombol Buat Kursus</li>
                                      <li>Isi Informasi</li>
                                      <li>Klik Buat</li>
                                  </ol>
                                  <h3 id="add_lesson">Cara Menambah Pelajaran</h3>
                                  <ol>
                                      <li>Buka kursus milik anda</li>
                                      <li>Klik tombol tambah pelajaran</li>
                                      <li>Isi informasi</li>
                                      <li>Klik buat</li>
                                  </ol>
                                  <h3 id="add_test">Cara Menambah Ujian</h3>
                                  <ol>
                                      <li>Buka kursus milik anda</li>
                                      <li>Klik tombol tambah ujian</li>
                                      <li>Pilih pelajaran</li>
                                      <li>Isi informasi</li>
                                      <li>Klik Buat</li>
                                  </ol>
                                  <h3 id="add_question">Cara Menambah Pertanyaan</h3>
                                  <ol>
                                      <li>Buka Ujian dari kursus milik anda</li>
                                      <li>Klik tombol tambah pertanyaan</li>
                                      <li>Isi Information</li>
                                      <li>Klik buat</li>
                                  </ol>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12 text-center">
                              <div class="btn-group mx-auto">
                                  <a href="{{route('home')}}" class="btn btn-primary btn-lg"><i class="fa fa-check" aria-hidden="true"></i> Mengerti</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
