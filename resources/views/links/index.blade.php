@extends('layouts.app')

@section('content')
  <a class="btn btn-primary btn-lg btn-block" href="{{ route('links.create') }}"><strong>Add new link</strong></a>
  @foreach($links as $link)
    <div class="card my-2">
      <div class="card-body">
        <h5 class="card-title">{{ $link->title }}</h5>
        <h6 class="card-subtitle">
          <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
        </h6>
      </div>
    </div>
  @endforeach
@endsection
