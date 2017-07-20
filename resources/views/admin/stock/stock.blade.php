@extends('layout.sidebarAdmin')
@section('section')
<div class="row">
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Stock Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Stock Type</th>
                <th>Shop ID</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stock as $i=>$value)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $value->stockName }}</td>
                    <td>{{ $value->quantity }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ $value->stockType }}</td>
                    <td>{{ $value->shopID }}</td>
                    <td><a class="waves-effect waves-light btn">edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop