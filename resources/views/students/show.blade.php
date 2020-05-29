@extends('layouts.main')

@section('title', 'Detail Student')
    
@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{ $student->getPicture() }}" class="img-circle" alt="picture">
                                <h3 class="name">{{ $student->nama }}</h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        {{ $student->mapel->count() }} <span>Mata Pelajaran</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        15 <span>Awards</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        2174 <span>Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Tentang siswa</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>NIS <span>{{ $student->nis }}</span></li>
                                    <li>Kelas <span>{{ $student->kelas }}</span></li>
                                    <li>Jenis Kelamin <span>{{ $student->jenis_kelamin }}</span></li>
                                    <li>Agama <span>{{ $student->agama }}</span></li>
                                    <li>Alamat <span>{{ $student->alamat }}</span></li>
                                </ul>
                            </div>
                            <div class="text-center"><a href="/students/{{$student->id}}/edit" class="btn btn-primary">Edit Profile</a></div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah data nilai
                        </button>
                        <div class="row mt-3">
                            <div class="col-3">
                                @if (session('failed'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('failed')}}
                                </div>
                            @endif
                            </div>
                            <div class="row mt-3">
                                <div class="col-3">
                                    @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{session('status')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <h1 class="panel-title">Mata Pelajaran</h1>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Semester</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($student->mapel as $mapel)
                                        <tr>
                                            <td>{{ $mapel->kode }}</td>
                                            <td>{{ $mapel->nama }}</td>
                                            <td>{{ $mapel->semester }}</td>
                                            <td>{{ $mapel->pivot->nilai }}</td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/students/{{ $student->id }}/addnilai" class="d-inline" method="post" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="mapel">Mata Pelajaran</label>
                    <select class="form-control" id="mapel" name="mapel">
                      @foreach ($matapelajaran as $mp)
                          <option value="{{ $mp->id }}">{{ $mp->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
                    <label for="nilai">nilai</label>
                    <input type="text" class="form-control" id="nilai" name="nilai" value="{{ old('nilai') }}">
                    @if($errors->has('nilai'))
                        <span class="help-block">{{ $errors->first('nilai') }}</span>
                    @endif
                </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
@endsection