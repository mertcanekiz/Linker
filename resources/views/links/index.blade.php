@extends('layouts.app')

@section('content')
  <div class="row main-content">
    <div class="col-lg-7">
      <h3 class="mt-3">Links</h3>
      <a class="btn btn-primary btn-block" href="{{ route('links.create') }}"><span><i
            class="fas fa-plus"></i></span> Add new link</a>
      <a href="{{ route('linker', Auth::user())}}" class="btn btn-success btn-block"><span><i class="fas fa-link"></i></span>
        My Linker</a>
      <div id="linksList">
        @foreach($links as $link)
          <x-link :link="$link"/>
        @endforeach
      </div>
    </div>
    <div class="col-lg-1 d-none d-lg-block"></div>
    <div class="col-md-4 d-none d-lg-inline" style="margin-top: 100px">
      <img src="{{ asset('img/iphone-6s-front.png') }}" alt="iphone-border" class="iphone-border">
      <iframe id="phone-frame" src="/{{Auth::user()->username}}" class="iPhone6S"></iframe>
    </div>
  </div>
@endsection

@section('javascript')
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      let linksList = document.getElementById('linksList');
      Sortable.create(document.getElementById('linksList'), {
        handle: '.drag-handle',
        animation: 200,
        onEnd: (evt) => {
          if (evt.oldIndex == evt.newIndex) {
            return;
          }
          let to = evt.to;
          let ordering = [];
          $(to).find('[data-link-id]').each(function (index) {
            ordering.push($(this).data('linkId'));
          })
          axios.post('/changeorder', {
            ordering
          }, {
            headers: {
              'Content-Type': 'application/json'
            }
          }).then(response => {
            console.log(response.data);
            document.getElementById('phone-frame').contentWindow.location.reload();
          }).catch(error => {
            console.error(error.response.data);
          })
        }
      });
    });

    window.addEventListener( "pageshow", function ( event ) {
      var historyTraversal = event.persisted ||
        ( typeof window.performance != "undefined" &&
          window.performance.navigation.type === 2 );
      if ( historyTraversal ) {
        // Handle page restore.
        window.location.reload();
      }
    });
  </script>
@endsection
