@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu Items</div>

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
                      <label for="name">Name</label>
                      <input type="text" class="form-control" placeholder="Name" name="name" id="name" />
                    </div>

                    <div class="form-group">
                      <label for="item_type"> Item Type</label>

                      @foreach ($menuitemstypes as $menuitemstype)
                      <div class="form-check">
                        <input type="radio" value="{{ $menuitemstype->id }}" name="item_type" id="item_type" class="form-check-input" />
                        <label for="item_type" class="form-check-label">{{ $menuitemstype->name }}</label>
                      </div>
                      @endforeach

                    </div>

                    <div class="form-group">
                      <label for="item_price">Price</label>
                      <input type="text" class="form-control" placeholder="Price" name="item_price" id="item_price" />
                    </div>

                    <div class="form-check">
                      <input type="checkbox" value="1" name="is_active" id="is_active" class="form-check-input" />
                      <label for="is_active" class="form-check-label">Is Active</label>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary mb-2">Save</button>
                      <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/menuitems'">Cancel</button>

                    </div>


                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
