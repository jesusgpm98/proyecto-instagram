@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">

          <div class="card-header">Edit image</div>

          <div class="card-body">

            <form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <input type="hidden" name="image_id" value="{{ $image->id }}">

              <div class="form-group row">
                <label for="image_path" class="col-md-4 col-form-label text-md-right">Image</label>

                <div class="col-md-6">
                  <div class="custom-file">
                    <input type="file" id="image_path" name="image_path" class="form-control @error('image_path') is-invalid @enderror custom-file-input">
                      @error('image_path')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                    </div>
                  </div>
                </div>

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                <div class="col-md-6">
                    <textarea id="description" name="description" class="form-control" required>{{ $image->description }}</textarea>
                    @error('description')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary btn-block">
                    Update image
                  </button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
