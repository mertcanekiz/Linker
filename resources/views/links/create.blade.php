@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 offset-md-2 py-3">
      <div class="card">
        <div class="card-header">
          Add new link
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('links.store') }}">
            @csrf
            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
              <label for="url">URL:</label>
              <input type="url" name="url" id="url" class="form-control" required>
            </div>
            <button class="btn btn-primary">Create</button>
            <a href="{{ route('links.index') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
