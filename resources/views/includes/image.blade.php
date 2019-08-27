<div class="card pub_image">
  <div class="card-header">
    @if ($image->user->image)
      <div class="container-avatar">
        <a href="{{ route('user.profile', ['id' => $image->user->id]) }}"><img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt="" class="avatar"></a>
      </div>
    @endif
    <div class="data-user">
      {{ $image->user->name.' '.$image->user->lastName }}
      <span class="username">
        {{  ' | @'.$image->user->username  }}
      </span>

      <div class="offset-md-10 detail">
        <a href="{{ route('image.detail', ['id' => $image->id]) }}">See post</a>
      </div>

    </div>
  </div>

  <div class="card-body">
    <div class="image-container">
      <img src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="Picture">
    </div>

    <div class="likes">
      <!-- comprobrar si el usuario le dio like -->
      @php $user_like = false; @endphp
      @foreach ($image->likes as $likes)
        @if ($likes->user->id == Auth::user()->id)
          @php $user_like = true; @endphp
        @endif
      @endforeach

      @if ($user_like)
        <i class="fa fa-heart heart-red fa-lg btn-dislike" data-id="{{ $image->id }}" aria-hidden="true"></i>
      @else
        <i class="fa fa-heart-o fa-lg btn-like" data-id="{{ $image->id }}" aria-hidden="true"></i>
      @endif
      <span class="number-likes">
        {{ count($image->likes) }}
      </span>
    </div>

    <div class="description">
      <span class="username">{{ '@'.$image->user->username }}</span>
      <span class="username date">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}</span>
      <p>{{ $image->description }}</p>
    </div>
    <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-danger btn-sm btn-comments">Comments ({{ count($image->comments) }})</a>
  </div>
</div>
<hr>
