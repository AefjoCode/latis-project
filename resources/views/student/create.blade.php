@extends('layouts.app')

@section('title', 'Create student')

@section('content')
    <div>
        <div class="card">
            <div class="card-body">
                <h3 class="mb-4">Data Siswa</h3>

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="institution" class="form-label">Institution</label>
                                <select class="form-control @error('institution_id') is-invalid @enderror"
                                    aria-label="Institution" name="institution_id">
                                    <option selected disabled>Pilih lembaga</option>
                                    @foreach ($institutions as $lembaga)
                                        <option value="{{ $lembaga->id }}">{{ $lembaga->nama_lembaga }}</option>
                                    @endforeach

                                </select>
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
                                    placeholder="nis siswa" name="nis">
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
                                    id="nama_siswa" placeholder="nama siswa" name="nama_siswa">
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
                                    id="email" placeholder="siswa@latiseducation.com" name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 custom-file">
                                <label for="file" class="form-label">Upload Foto</label>
                                <div class="custom-file">

                                    <input type="file" class="custom-file-input @error('foto') is-invalid @enderror"
                                        id="imageInput" name="foto">
                                    <label class="custom-file-label" for="customFile" id="imageInputLabel">Choose
                                        file</label>
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5">Buat Data Siswa</button>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('imageInput').addEventListener('change', function() {
            var label = document.getElementById('imageInputLabel');
            if (this.files.length > 0) {
                label.textContent = this.files[0].name;
            } else {
                label.textContent = 'Choose file';
            }
        });
    </script>
@endpush
