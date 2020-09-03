@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <a class="btn btn-primary btn-lg btn-block" href="{{ route('links.create') }}"><strong>Add new link</strong></a>
      @foreach($links as $link)
        <x-link :link="$link"/>
      @endforeach
    </div>
  </div>
@endsection
