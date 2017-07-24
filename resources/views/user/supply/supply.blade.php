@extends('layout.sideBar')
@section('section')

    <div class="row">
        <form action="{{ route('supplyP') }}" method="post">
            {{ csrf_field() }}
            <div class="formList row">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="person" type="text" class="validate" name="person" autocomplete="off">
                        <label for="last_name">Supply Person</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="hidden" name="staff" value="">
                        <input id="" type="text" class="validate staff" name="" autocomplete="off">
                        <label for="staff">Staff</label>
                    </div>
                </div>

                <div class="formListTool row">
                    <div class="input-field col s4">
                        <input id="stock" type="text" class="validate" name="stockName[]" autocomplete="off">
                        <label for="last_name">Stock Name</label>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" class="validate" name="quantity[]">
                        <label for="last_name">Quantity</label>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" class="validate" name="price[]">
                        <label for="last_name">Price</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <input type="submit" value="Save" class="waves-effect waves-light btn">
                <a class="addList waves-effect waves-light btn" style="float: right;">ADD</a>
            </div>

        </form>


        <script>
            var stockList = {
                @foreach($stock as $i)
                '{{ $i->stockName }}': null,
                @endforeach
            };
            var personList = {
                @foreach($supplyPerson as $value)
                '{{ $value->name }}': null,
                @endforeach
            };
            var staffList = [
                @foreach($staff as $i)
            {id: '{{ $i->staffID }}', text: '{{ $i->name }}'},
                @endforeach
            ];

            $(document).ready(function () {
                $('#stock').autocomplete({
                    data:stockList
                });
                $('#person').autocomplete({
                    data: personList
                });
                $('.staff').autocomplete2({
                    data: staffList
                });

                $('.addList').on('click', function () {
                    var appendList = $('<div class="formListTool"> <div class="input-field col s4"> <input id="stock" type="text" class="validate" name="stockName[]"> <label for="last_name">Stock Name</label> </div> <div class="input-field col s4"> <input id="stock" type="text" class="validate" name="quantity[]"> <label for="last_name">Quantity</label> </div> <div class="input-field col s4"> <input id="stock" type="text" class="validate" name="price[]"> <label for="last_name">Price</label> </div> </div>');
                    $('.formList').append(appendList);
                    $('#stock', appendList).autocomplete({
                        source:[stockList]
                    });
                });
            });
        </script>
    </div>

@stop