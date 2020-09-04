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
                  <div class="mx-3">
                    <a href="#" class="text-warning"><span><i class="fas fa-chart-line"></i></span> Activity</a>
                  </div>
                  <div class="mx-3">
                    <a href="{{ route('links.edit', $link) }}"><span><i class="far fa-edit"></i></span> Edit</a>
                  </div>
                  <div class="mx-3">
                    <a class="text-danger" href="#"><span><i class="far fa-trash-alt"></i></span> Delete</a>
                  </div>
                </div>
              </div>
              <h6 class="card-subtitle">
                <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                <div class="mt-2">
                    {{ $link->visits_count }} visits
                </div>

              </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
