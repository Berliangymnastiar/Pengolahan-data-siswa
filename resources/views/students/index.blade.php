@extends('layouts/main')

@section('title', 'Students')
    
@section('container')
    <div class="container mt-5">
        <div class="row">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student as $student)
                    <tr>
                        <th>1</th>
                        <td>{{ $student->nama }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->jenis_kelamin }}</td>
                        <td>{{ $student->agama }}</td>
                        <td>{{ $student->alamat }}</td>
                    </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection