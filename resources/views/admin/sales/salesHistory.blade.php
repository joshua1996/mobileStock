@extends('layout.sideBarAdmin')
@section('section')
    <div class="row">
        <div class="col s6">
            <label for="">Start Date</label>
            <input type="date" class="datepicker" name="searchDate" id="searchDate">
        </div>
        <div class="col s6">
            <label for="">End Date</label>
            <input type="date" class="datepicker" name="searchDateEnd" id="searchDateEnd">

        </div>
        <a class="waves-effect waves-light btn" id="searchBtn">Search</a>

        <table class="highlight">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Time</th>
                <th>User ID</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            @foreach($sales as $index=>$value)

                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $value->stockName }}</td>
                    <td>{{ $value->salesquantity }}</td>
                    <td>{{ $value->salesprice }}</td>
                    <td>{{ $value->dateTime }}</td>
                    <td>{{ $value->staffName }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function () {
                $('.datepicker').pickadate({
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 15, // Creates a dropdown of 15 years to control year
                    format : 'yyyy-mm-dd',
                    onStart: function ()
                    {
                        var date = new Date();
                        this.set('select', [date.getFullYear(), date.getMonth(), date.getDate()]);
                    },
                    onClose: function(){
                        $(document.activeElement).blur()
                    }
                });

                $('#searchBtn').on('click', function(){
                    var tomo = new Date($('#searchDateEnd').val());
                    var dd = new Date(tomo.setDate( tomo.getDate() + 1));

                    var data = {
                        dateTime : $('#searchDate').val(),
                        dateTimeEnd : dd.getFullYear() + '-' + ("0" + (dd.getMonth() + 1)).slice(-2) + '-' + dd.getDate()
                    };
                    console.log(data);
                    $.ajax({
                        url:'{{ route('salesSearchDateAdmin') }}',
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        success: function (data) {
                            $('#tableBody').empty();
                            $.each(data.data, function(index, value){
                                $('#tableBody').append('<tr><td>'+ (index+1) +'</td><td>'+ value.stockName +'</td><td>'+ value.salesquantity +'</td><td>'+ value.salesprice +'</td><td>'+ value.dateTime +'</td><td>'+ value.staffName +'</td></tr>')
                            });

                        }
                    });
                });



            });
        </script>
    </div>

@stop