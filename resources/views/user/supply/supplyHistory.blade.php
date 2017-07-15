@extends('layout.sideBar')
@section('section')

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Person</th>
            <th>Stock Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($supply as $index=>$value)

            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->person }}</td>
                <td>{{ $value->stockName }}</td>
                <td>{{ $value->quantity }}</td>
                <td>{{ $value->price }}</td>
                <td>{{ $value->dateTime }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop