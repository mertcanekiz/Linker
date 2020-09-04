@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 offset-md-2 py-3">
      <div class="card">
        <div class="card-header">
          Edit Link
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('links.update', $link) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" class="form-control" name="title" id="title" required value="{{ $link->title }}">
            </div>
            <div class="form-group">
              <label for="url">URL:</label>
              <input type="url" name="url" id="url" class="form-control" required value="{{ $link->url }}">
            </div>
            <div class="row px-3">
              <div class="col-sm-auto px-0 mr-sm-2 my-2">
            <button class="btn btn-block btn-primary"><span><i class="fas fa-check"></i></span> Update</button>

              </div>
              <div class="col-sm-auto px-0 mx-sm-2 my-2">
            <button href="#" class="btn btn-block btn-danger" type="button" onclick="document.getElementById('delete-form').submit();"><span><i class="far fa-trash-alt"></i></span> Delete</button>

              </div>
              <div class="col-sm-auto px-0 mx-sm-2 my-2">
            <a href="{{ route('links.index') }}" class="btn btn-block btn-secondary" type="button"><span><i class="fas fa-times"></i></span> Cancel</a>

              </div>
            </div>
          </form>
          <form method="post" action="{{ route('links.destroy', $link) }}" id="delete-form">
            @csrf
            @method('DELETE')
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
