@extends('layouts.home')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Login</div>

                <div class="card-body">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                  <form class="form" method="post" >
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" placeholder="Username" name="username" id="username" />
                    </div>

                    <div class="form-group">
                      <label for="password">password</label>
                      <input type="password" class="form-control" name="password" id="password" />
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary mb-2">Sign In</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
