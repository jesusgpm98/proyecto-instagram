@if(session('message_image'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message_image') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@elseif(session('message_comment'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message_comment') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@elseif(session('message_update_photo'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message_update_photo') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@elseif(session('message_delete'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('message_delete') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@elseif(session('message_delete_photo'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('message_delete_photo') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@elseif(session('message_update'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message_update') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@elseif (session('message_updatePassword'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message_updatePassword') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
