<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Linker | {{ $user->username }}</title>
  {{--  <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/flatly/bootstrap.min.css">
  <style>
  </style>
</head>
<body class="bg-secondary">
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2 mt-4">
      <div class="d-flex justify-content-center flex-column align-items-center mb-3">
        <img class="img-thumbnail rounded-circle mb-3" src="https://www.gravatar.com/avatar/bd3c72a53993932713aa32c99dd128a5" width="100">
        <div class="text-center">
          <h4 class="text-primary">{{ '@' . Auth::user()->username }}</h4>
        </div>
      </div>
        @forelse ($links as $link)
          <div>
            <a class="btn btn-block btn-primary rounded-pill my-3" href="{{ $link->url }}" target="_blank"
               onclick="visit({{ $link->id }})">
              <div class="text-center my-2">
                <strong>{{ $link->title }}</strong>
              </div>
            </a>
          </div>
        @empty
      <div class="text-secondary text-center">
        Your links will appear here.
      </div>
      @endforelse
    </div>
  </div>
</div>

{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
<script>
  function visit(linkId) {
    axios.post(`/links/${linkId}/visit`)
      .then(response => console.log(response.data))
      .catch(error => console.error(error.response.data));
  }
</script>
</body>
</html>
