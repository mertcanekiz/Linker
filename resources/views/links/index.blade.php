@extends('layouts.app')

@section('content')
  My links

  @foreach($links as $link)
    <div class="card">
      <div class="card-body">
        <a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
      </div>
    </div>
  @endforeach
@endsection
