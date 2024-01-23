@extends('layouts.app')

@push('styles')
    <style>
        .wrap-action {
            display: flex;
            gap: 2px;
        }
    </style>
@endpush

@section('title', 'List Students')


@section('content')
    <div>

        <div class="card">
            <div class="card-body">
                <h3>Student List</h3>

                <div class="row">
                  
                    <div class="col-md-4">
                        <a href="{{ route('student.create') }}" class="btn btn-primary active" role="button" aria-pressed="true">Buat Data</a>
                        <a href="{{ route('student.export') }}" class="btn btn-success active" role="button" aria-pressed="true">Export Excel</a>
                      
                    </div>
                   
                    <div class="col-md-8">
                      <form action="{{ route('student.search') }}" method="GET" class="d-flex gap-2">
                          <select class="form-control" aria-label="Institution" name="nama_lembaga">
                              <option selected disabled>Pilih lembaga</option>
                              @foreach ($institutions as $lembaga)
                                  <option value="{{ $lembaga->id }}" {{ old('nama_lembaga') == $lembaga->id ? 'selected' : '' }}>
                                      {{ $lembaga->nama_lembaga }}
                                  </option>
                              @endforeach
                          </select>
                  
                          <input class="form-control" type="search" name="search" placeholder="Cari Siswa .."
                              value="{{ old('search') }}">
                  
                          <button type="submit" class="btn btn-primary">Cari</button>
                          <a href="{{ route('student.index') }}" class="btn btn-danger">Bersihkan</a>
                      </form>
                  </div>
                  

                </div>

                <div class="table-responsive">
                    <table class="table table-striped mt-3 border">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Email</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Lembaga</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                                <tr>
                                    <th scope="row">{{ $students->firstItem() + $key }}</th>
                                    <td>{{ $student->nis }}</td>
                                    <td>{{ $student->nama_siswa }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        <img src="{{ url('/' . $student->foto) }}" alt="foto-siswa" width="30"
                                            height="30">

                                    </td>
                                    <td>{{ $student->institution->nama_lembaga }}</td>
                                    <td class="wrap-action">
                                        <a href="{{ route('student.edit', $student) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('student.show', $student) }}"
                                            class="btn btn-sm btn-warning">Show</a>
                                        <form action=" {{ route('student.destroy', $student) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"> delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-3">
                    <div>
                        Showing
                        {{ $students->firstItem() }}
                        to
                        {{ $students->lastItem() }}
                        of
                        {{ $students->total() }}
                    </div>
                    <div>
                        {{ $students->links('pagination::bootstrap-4') }}
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection


