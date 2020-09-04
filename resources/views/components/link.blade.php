<div>
  <div draggable="false" class="card my-2" data-link-id="{{ $link->id }}">
    <div draggable="false"  class="d-flex align-items-stretch">
      <div draggable="false"  class="d-flex justify-content-center align-items-center rounded-left drag-handle text-light bg-secondary"  style="width: 2rem; cursor: pointer;">
        <span><i class="fas fa-ellipsis-v"></i></span>
      </div>
      <div draggable="false"  class="card-body">
        <div draggable="false" >
          <div class="d-flex justify-content-between">
            <div class="flex-1">
              <h5 class="card-title">{{ $link->title }}</h5>
              <h6 class="card-subtitle">
                <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
              </h6>
            </div>
            <div>
              <a href="{{ route('links.edit', $link) }}"><span><i class="far fa-edit"></i></span> Edit</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
