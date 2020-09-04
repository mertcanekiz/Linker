@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <a href="#" class="btn btn-success btn-lg btn-block"><span><i class="fas fa-link"></i></span> <strong>My Linker</strong></a>
      <a class="btn btn-primary btn-lg btn-block" href="{{ route('links.create') }}"><span><i class="fas fa-plus"></i></span> <strong>Add new link</strong></a>
      <h3 class="mt-3">Links</h3>
      <div id="linksList">
        @foreach($links as $link)
          <x-link :link="$link"/>
        @endforeach
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script>
    document.addEventListener("DOMContentLoaded", function(){
      let linksList = document.getElementById('linksList');
      Sortable.create(document.getElementById('linksList'), {
        handle: '.drag-handle',
        animation: 200,
        onEnd: (evt) =>
        {
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
          }).catch(error => {
            console.error(error.response.data);
          })
        }
      });
    });
  </script>
@endsection
