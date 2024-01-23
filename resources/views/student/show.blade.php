@extends('layouts.app')

@section('title', 'Show Student')

@section('content')
    <div>
        <div class="card">
            <div class="card-body">
                <h3 class="mb-4">Lihat Data Siswa</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="institution" class="form-label">Institution</label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis"
                                placeholder="nis siswa" value="{{ $student->institution->nama_lembaga }} " disabled>
                                @error('institution_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis"
                                    placeholder="nis siswa" value="{{ $student->nis }} " disabled>
                                @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror"
                                    id="nama_siswa" placeholder="nama siswa" name="nama_siswa" disabled>
                                @error('nama_siswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="siswa@latiseducation.com" name="email" disabled>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="mb-3">
                                <img src="{{ url('/'. $student->foto) }}" alt="foto-siswa" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('student.index') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
@endsection
