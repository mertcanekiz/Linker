<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Linker | {{ $user->username }}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    body {
      background: #222;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3 mt-5">
      <div class="text-center mb-5">
        <h3 class="text-secondary">{{ '@' . Auth::user()->username }}</h3>
      </div>
      @forelse ($links as $link)
        <div class="card my-2">
          <a class="btn btn-primary" href="{{ $link->url }}" target="_blank" onclick="visit({{ $link->id }})">
            <div class="card-body text-center">
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

<script src="{{ asset('js/app.js') }}"></script>
<script>
  function visit(linkId) {
    axios.post(`/links/${linkId}/visit`)
      .then(response => console.log(response.data))
      .catch(error => console.error(error.response.data));
  }
</script>
</body>
</html>
