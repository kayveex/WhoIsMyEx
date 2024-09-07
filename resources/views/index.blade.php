{{-- Template Utama --}}
@extends('Partials.maindash')

{{-- Heading Section --}}
@section('heading')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 font-weight-bold text-gray-800">List of Your Exes 🥹</h1>
        <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#exModal">
            <i class="fas fa-plus mr-2"></i>
            Add New
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Add New Ex 🥀</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="font-weight-bold">Name</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                            @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label  for="status" class="font-weight-bold">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option>-- Select Status --</option>
                                <option value="musuh">Enemy</option>
                                <option value="asing">Stranger</option>
                                <option value="teman">Friend</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lama_pacaran" class="font-weight-bold">Duration In Days</label>
                            <input type="number" class="form-control" id="lama_pacaran" name="lama_pacaran" required>
                            @error('lama_pacaran')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fotoMantan" class="font-weight-bold">Upload Her Photo (Max: 5 MB)</label>
                            <br />
                            <input class="input-file-normal" type="file" name="fotoMantan"
                                id="fotoMantan" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>


            </div>
            </div>
        </div>

    </div>
@endsection

{{-- Content Section --}}
@section('content')
    <div class="table-responsive text-center">
        <table class="table table-bordered" id="exesListTable">
            <thead class="thead bg-primary text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Status</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exList as $ex)
                    <tr>
                        <td>{{ $ex->id }}</td>
                        <td>{{ $ex->nama }}</td>
                        <td>
                            <img src="{{ asset($ex->fotoMantan) }}" alt="{{ $ex->nama }}" class="img-thumbnail" width="100">
                        </td>
                        <td>
                            @if ($ex->status == 'musuh')
                                <span class="badge badge-danger px-4 py-2">Enemy</span>
                            @endif
                            @if ($ex->status == 'teman')
                                <span class="badge badge-success px-4 py-2">Friend</span>
                            @endif
                            @if ($ex->status == 'asing')
                                <span class="badge badge-warning px-4 py-2">Stranger</span>
                            @endif
                        </td>
                        <td>{{ $ex->lama_pacaran }} days</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="/edit/{{ $ex->id }}" class="btn btn-warning mr-2">Edit</a> <!-- Menambahkan margin kanan (mr-2) -->
                                <form action="/delete/{{ $ex->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                

            </tbody>
        </table>

    </div>
    
@endsection