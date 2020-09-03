@extends('layouts.app')

@section('content')
  <h1>Add new link</h1>
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
    <button class="btn btn-primary">Submit</button>
  </form>
@endsection
