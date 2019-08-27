@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">


        <form action="{{ route('user.index') }}" method="GET" class="form-inline" id="buscador">
          <div class="col-md-4 offset-md-4">
            <div class="form-group mx-sm-3 mb-2">
              <input type="text" id="search" class="form-control" placeholder="Search people">
            </div>
          </div>
          <button type="submit" class="btn btn-dark mb-2">Search</button>
        </form>
        <hr>



        @include('includes.messages')

        @foreach ($users as $user)
          <div class="profile-user">
            @if ($user->image)
              <div class="container-avatar">
                <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="" class="avatar">
              </div>
            @endif

            <div class="user-info">
              <h2>{{ '@'.$user->username }}</h2>
              <h3>{{ $user->name.' '.$user->lastName }}</h3>
              <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="btn btn-success">See profile</a>
            </div>
            <div class="clearfix"></div>
            <hr>
          </div>
        @endforeach

        <!-- paginacion -->
        <div class="clearfix"></div>
        {{ $users->links() }}
      </div>
    </div>
  </div>
@endsection
