@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">

          @include('includes.messages')

        <div class="card pub_image pub_image_detail">
          <div class="card-header">
            @if ($image->user->image)
              <div class="container-avatar">
                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt="" class="avatar">
              </div>
            @endif
            <div class="data-user">
              {{ $image->user->name.' '.$image->user->lastName }}
              <span class="username">
                {{  ' | @'.$image->user->username  }}
              </span>
            </div>

            @if (Auth::user() && Auth::user()->id == $image->user->id)
              <div class="delete offset-md-11">
                <!-- Button to Open the Modal -->
                <i class="fas fa-times pointer" style="color:black;" data-toggle="modal" data-target="#myModal"></i>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Are you sure you want to delete this photo?</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                        if you delete this photo, you will never be able to recover it.
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-color" data-dismiss="modal">No!</button>
                        <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Yes!</a>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            @endif

          </div>

          <div class="card-body">
            <div class="image-container image-detail">
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

            @if (Auth::user() && Auth::user()->id == $image->user->id)
              <div class="editar offset-md-11">
                <a href="{{ route('image.edit',['id' => $image->id]) }}"><i class="fas fa-edit fa-1x" style="color:black;"></i></a>
              </div>
            @endif

            <div class="description">
              <span class="username">{{ '@'.$image->user->username }}</span>
              <span class="username date">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}</span>
              <p>{{ $image->description }}</p>
            </div>

            <div class="clearfix"></div>
            <div class="comments">
              <h3>Comentarios ({{ count($image->comments) }})</h3>
              <hr>

              <form action="{{ route('comment.save') }}" method="POST">
                @csrf

                <input type="hidden" name="image_id" value="{{ $image->id }}">

                <p>
                  <textarea name="content" class="form-control @error('content') is-invalid @enderror" required></textarea>
                    @error('content')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </p>
                  <button type="submit" class="btn btn-success">Comment</button>
                </form>

                <hr>
                @foreach ($image->comments as $comment)
                  <div class="comment">
                    <span class="username">{{ '@'.$comment->user->username }}</span>
                    <span class="username date">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }}</span>
                    <p>{{ $comment->content }} <br>
                      @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-primary">delete message</a>
                      @endif
                    </p>
                  </div>
                @endforeach

              </div>

            </div>
          </div>
        </div>
      </div>
    @endsection
