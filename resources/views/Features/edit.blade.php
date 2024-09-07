{{--  Template Utama --}}
@extends('Partials.maindash')

{{-- Heading Section --}}
@section('heading')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 font-weight-bold text-gray-800">Edit Your Ex: {{ $specificEx->nama }}</h1>
    </div>
@endsection

{{-- Content Section --}}
@section('content')
    <div class="row">
        <div class="col">
            <form action="/update/{{ $specificEx->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama" class="font-weight-bold">Name</label>
                    <input type="text" class="form-control" value={{ $specificEx->nama }} id="nama" name="nama" required>
                    @error('nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label  for="status" class="font-weight-bold">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option>-- Select Status --</option>
                        <option value="musuh" {{ $specificEx->status == 'musuh' ? 'selected' : '' }}>Enemy</option>
                        <option value="asing" {{ $specificEx->status == 'asing' ? 'selected' : '' }}>Stranger</option>
                        <option value="teman" {{ $specificEx->status == 'teman' ? 'selected' : '' }}>Friend</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lama_pacaran" class="font-weight-bold">Duration In Days</label>
                    <input type="number" class="form-control" value={{ $specificEx->lama_pacaran }} id="lama_pacaran" name="lama_pacaran" required>
                    @error('lama_pacaran')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fotoMantan" class="font-weight-bold">Update Her Photo (Max: 5 MB)</label>
                    <br />
                    <input class="input-file-normal" type="file" name="fotoMantan"
                        id="fotoMantan" />
                </div>
                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>

@endsection


