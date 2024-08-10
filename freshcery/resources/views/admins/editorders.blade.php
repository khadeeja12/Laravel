@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Edit Orders</h5>
          <form method="POST" action="{{route('orders.update',$order->id)}}" >
            @csrf
            
            <p>Current Status is <b>{{$order->status}}</b></p>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Order Status</label>
                <select name="status" class="form-control" id="exampleFormControlSelect1">
                  <option>--select Order Status--</option>
                  <option value="Processing">Processing</option>
                  <option value="Delivered">Delivered</option>
  
                </select>
            </div>
            

  
            <!-- Submit button -->
        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>


@endsection