@extends('layout.sidebarAdmin')
@section('section')
<div class="row">
    <style>
        td{
            padding: 0px 5px;
        }
    </style>
    <div class="col s6">
        <label for="">Start Date</label>
        <input type="date" class="datepicker" name="searchDate" id="searchDate">
    </div>
    <div class="col s6">
        <label for="">End Date</label>
        <input type="date" class="datepicker" name="searchDateEnd" id="searchDateEnd">

    </div>
    <button id="searchBtn" class="waves-effect waves-light btn"><i class="material-icons left">search</i>Search</button>

    <table class="highlight">
        <thead>
        <tr>
            <th>No</th>
            <th>Person</th>
            <th>Stock Name</th>
            <th>Remark</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Time</th>
            <th>Staff Name</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        @foreach($supply as $index=>$value)

            <tr>
                <td>{{ (($supply->currentPage() - 1 ) * $supply->perPage() ) + $loop->iteration }}</td>
                <td>{{ $value->supplyName }}</td>
                <td>{{ $value->stockstockname }}</td>
                <td>{{ $value->remark }}</td>
                <td>{{ $value->supplyquantity }}</td>
                <td>{{ $value->supplyprice }}</td>
                <td>{{ $value->dateTime }}</td>
                <td>{{ $value->staffName }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $supply->render() }}
    <script>
        $(document).ready(function(){

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
                checkPreloader(true);
                var tomo = new Date($('#searchDateEnd').val());
                var dd = new Date(tomo.setDate( tomo.getDate() + 1));

                var data = {
                    dateTime : $('#searchDate').val(),
                    dateTimeEnd : dd.getFullYear() + '-' + ("0" + (dd.getMonth() + 1)).slice(-2) + '-' + dd.getDate()
                };
                console.log(data);
                window.location.replace('/admin/supplyHistory/'+$('#searchDate').val()+ '/' + dd.getFullYear() + '-' + ("0" + (dd.getMonth() + 1)).slice(-2) + '-' + dd.getDate());

            });
        });
    </script>
</div>

@stop