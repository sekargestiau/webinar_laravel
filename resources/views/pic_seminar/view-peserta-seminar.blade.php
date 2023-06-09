@extends('layouts.main-ip')
@section('title','SeminarKu')
    
    @section('container')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{url('dashboard')}}">Dashboard</a></li>
          <li><a href="{{url('pic-seminar')}}">Seminar</a></li>
          <li>Peserta Seminar</li>
        </ol>
        <h2>Peserta Seminar</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section id="inner-page">
      <div class="container" style="background-color: #f3f5fa; border-radius: 50px;">
        <div class="p-4">
          <h3 style="color:#37517e;">Informasi Seminar</h3>
          <table>
            @foreach($seminar as $seminar)
              <tr>
                  <th style="padding-right:50px;">Judul</th>
                  <td>: {{ $seminar->nama_seminar }}</th>
              </tr>
              <tr>
                  <th style="padding-right:50px;">Tanggal Pelaksanaan</th>
                  <td>: {{ $seminar->tanggal_seminar }}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>

      <div class="container">
        <div class="mt-4 p-4">
          <h3 class="" style="color:#37517e;">Peserta Seminar</h3>
          <div class="table-responsive mt-4">
              <table class="table table-hover">
                  <thead class="sticky-top">
                      <tr class="text-start table-primary">
                          <th>No.</th>
                          <th>Nama Lengkap</th>
                          <th>Asal Instansi</th>
                          <th>Email</th>
                          <th>Nomor Telepon</th>
                          <th>Nomor Identitas</th>
                          <th>Sumber Informasi</th>
                          <th>Bukti Pembayaran</th>
                          <th>Tanggal Pembayaran</th>
                          <th>Status Peserta</th>
                      </tr>
                  </thead>

                  <tbody>
                      <!-- <tr>
                          <td colspan="4">Belum ada data.</td>
                      </tr> -->
                      @php
                        $no = 1;
                      @endphp

                      @forelse($users as $user)
                              <tr class="text-start">
                                  <td>{{ $no++ }}</td>
                                  <td>{{ $user->nama_user }}</td>
                                  <td>{{ $user->asal_instansi }}</td>
                                  <td>{{ $user->email_user }}</td>
                                  <td>{{ $user->no_telp }}</td>
                                  <td>{{ $user->no_identitas }}</td>
                                  <td>{{ $user->sumber_info }}</td>
                                  @php
                            $fileName = basename($user->bukti_pembayaran);
                        @endphp
                                  <td>
                                    <a href="{{ Storage::url('bukti_pembayaran/' . $fileName) }}" target="_blank" style="color:black; text-decoration:underline;"><button class="btn btn-outline-dark" style="border-radius: 20px;">Lihat</button></a>
                                  </td>
                                  <td>{{ $user->tgl_pembayaran }}</td>
                                  <td>{{ $user->status_peserta }}<a href="{{ url('/pic-seminar/edit-status-peserta/'.$user->id) }}"><i class="ps-2 bi bi-pencil"></i></a></td>
                              </tr>
                        @empty
                              <tr>
                                  <td colspan="10" class="text-center">Belum ada data</td>
                              </tr>
                      @endforelse
                  </tbody>
              </table>
          </div>
        </div>
      </div>
      <!-- end: grid layout -->
    </section>

  </main><!-- End #main -->

  @endsection