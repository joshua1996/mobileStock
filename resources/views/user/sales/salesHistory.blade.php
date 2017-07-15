@extends('layout.sideBar')
@section('section')
    {{--<form action="{{ route('salesSearchDate') }}" method="post">--}}
        {{ csrf_field() }}
        <input type="text" name="searchDate" id="searchDate">
    <input type="text" name="searchDateEnd" id="searchDateEnd">
        <button id="searchBtn">Search</button>
    {{--</form>--}}

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach($sales as $index=>$value)

                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->quantity }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ $value->dateTime }}</td>
                </tr>
                @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
           $('#searchDate').datepicker();
            $('#searchDate').datepicker('option', 'dateFormat', 'yy-mm-dd');
            $("#searchDate").datepicker( "setDate" , new Date() );

            $('#searchDateEnd').datepicker();
            $('#searchDateEnd').datepicker('option', 'dateFormat', 'yy-mm-dd');
            $("#searchDateEnd").datepicker( "setDate" , new Date() );

           $('#searchBtn').on('click', function(){
               var tomo = new Date($('#searchDateEnd').val());
               var dd = new Date(tomo.setDate( tomo.getDate() + 1));

               var data = {
                   dateTime : $('#searchDate').val(),
                   dateTimeEnd : dd.getFullYear() + '-' + ("0" + (dd.getMonth() + 1)).slice(-2) + '-' + dd.getDate()
               };
               console.log(data);
               $.ajax({
                   url:'{{ route('salesSearchDate') }}',
                   type: 'post',
                   data: data,
                   dataType: 'json',
                   success: function (data) {
                       $('#tableBody').empty();
                       $.each(data.data, function(index, value){
                           $('#tableBody').append('<tr><td>'+ (index+1) +'</td><td>'+ value.name +'</td><td>'+ value.quantity +'</td><td>'+ value.price +'</td><td>'+ value.dateTime +'</td></tr>')
                       });

                   }
               });
           });


           {{--});--}}
        });
    </script>
    @stop