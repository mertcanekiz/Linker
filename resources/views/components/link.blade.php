<div>
  <div draggable="false" class="card my-2" data-link-id="{{ $link->id }}">
    <div draggable="false" class="d-flex align-items-stretch">
      <div draggable="false"
           class="d-flex justify-content-center align-items-center rounded-left drag-handle text-light bg-secondary"
           style="width: 2rem; min-width: 2rem; cursor: move;">
        <span><i class="fas fa-ellipsis-v"></i></span>
      </div>
      <div draggable="false" class="card-body">
        <div draggable="false">
          <div class="d-flex justify-content-between">
            <div class="w-100 flex-1">
              <div class="d-flex justify-content-between mb-2">
                  <h5 class="card-title">{{ $link->title }}</h5>
                <div class="d-flex">
                  <div class="mx-1 mx-md-3">
                    <a href="#" class="text-warning"><span><i class="fas fa-chart-line"></i></span> <span class="d-none d-md-inline">Activity</span></a>
                  </div>
                  <div class="mx-1 mx-md-3">
                    <a href="{{ route('links.edit', $link) }}"><span><i class="far fa-edit"></i></span> <span class="d-none d-md-inline">Edit</span></a>
                  </div>
                  <div class="mx-1 mx-md-3">
                    <a class="text-danger" href="#" onclick="event.preventDefault(); document.getElementById('deletion-form-{{$link->id}}').submit()"><span><i class="far fa-trash-alt"></i></span> <span class="d-none d-md-inline">Delete</span></a>
                    <form id="deletion-form-{{$link->id}}" style="display:none" action="{{ route('links.destroy', $link) }}" method="post">
                      @csrf
                      @method('DELETE')
                    </form>
                  </div>
                </div>
              </div>
              <h6 class="card-subtitle mb-1">
                <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                <div class="mt-2">
                  <span class="text-muted">{{ $link->visits_count }} visits</span>
                </div>

              </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
