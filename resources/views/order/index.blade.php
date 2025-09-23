@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-black">Data Order List</h3>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="{{ route('order.form_order') }}" class="btn btn-primary">Add Order</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Estimation</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td><a href="{{ route('order.show', $order->id) }}">{{ $order->order_code }}</a></td>
                                <td>{{ $order->customer->customer_name }}</td>
                                <td>{{ date('d F Y', strtotime($order->order_date)) }}</td>
                                <td>{{ date('d F Y', strtotime($order->order_end_date)) }}</td>
                                <td>{{ $order->status_text }}</td>
                                <td>
                                    <a href="{{ route('print_struk', $order->id) }}" class="btn btn-success btn-sm">Print</a>

                                    {{--  @if ($order->status == 0)
                                    <a href="{{ route('orders.pickup', $order->id) }}" class="btn btn-warning btn-sm">Pick Up</a>
                                    @endif  --}}

                                     @if ($order->order_status == 0)
                                     
                                <form action="{{route('order.pickup',$order->id)}}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" href="" class="btn btn-warning btn-sm">
                                        Pick up
                                    </button>
                                </form>
 @endif
                                    <form action="{{ route('order.destroy', $order->id) }}" method="post" id="delete-form-{{ $order->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmAndDelete({{ $order->id }})">Delete</button>
                                    </form>

                                </td>
                            </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
