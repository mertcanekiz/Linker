@extends('layouts.app')

@section('content')
  <div class="row main-content">
    <div class="col-lg-7">
      <h3 id="links-title" class="mt-3 text-primary">Links</h3>

      <a href="{{ route('linker', Auth::user())}}" class="btn btn-success btn-block" target="_blank"><span><i
            class="fas fa-link"></i></span>
        My Linker
      </a>
      <a class="btn btn-primary btn-block" href="{{ route('links.create') }}"><span><i
            class="fas fa-plus"></i></span> Add new link
      </a>
      <div id="linksList" class="mt-3">
        @forelse($links as $link)
          <x-link :link="$link"/>
        @empty
          <div class="text-muted mt-2">You don't have any links yet.</div>
        @endforelse
      </div>
    </div>
    <div class="col-md-4 d-none d-lg-inline ml-xl-5 ml-md-1">
      <h3 class="my-3 text-primary">Preview</h3>
      <div style="margin-top: 120px;">
        <img src="{{ asset('img/iphone-6s-front.png') }}" alt="iphone-border" class="iphone-border">
        <iframe id="phone-frame" src="/{{Auth::user()->username}}" class="iPhone6S"></iframe>
      </div>

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

    window.addEventListener("pageshow", function (event) {
      var historyTraversal = event.persisted ||
        (typeof window.performance != "undefined" &&
          window.performance.navigation.type === 2);
      if (historyTraversal) {
        // Handle page restore.
        window.location.reload();
      }
    });
  </script>
@endsection
