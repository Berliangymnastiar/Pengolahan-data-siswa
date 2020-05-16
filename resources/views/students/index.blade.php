@extends('layouts/main')

@section('title', 'Students')
    
@section('container')
    <div class="container">
        <div class="row">
            <div class="col-5 my-3">
                <form action="/students" method="get">
                    <div class="input-group mb-3 float-right">
                        <input type="text" class="form-control" placeholder="search student" name="search">
                        <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Seacrh</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                    Add Students
            </button>
            </div>
        </div>
            <div class="row mt-3">
                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                @endif
            </div>    
        <div class="row mt-3">
            <div class="col">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                    <th>{{$loop->iteration}}</th>
                        <td>{{ $student->nama }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->jenis_kelamin }}</td>
                        <td>{{ $student->agama }}</td>
                        <td>{{ $student->alamat }}</td>
                        <td>
                        <a href="/students/{{$student->id}}/edit" class="btn btn-success">Edit</a>

                        <form action="/students/{{$student->id}}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>    
                        </form>
                        </td>
                    </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="/students/create" method="get">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis">
                    @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas">
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                        <option>L</option>
                        <option>P</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <input type="text" class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama">
                    @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"></textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>
    </div>
    </div>
@endsection