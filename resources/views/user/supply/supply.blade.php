@extends('layout.sideBar')
@section('section')

    <form action="{{ route('supplyP') }}" method="post">
        {{ csrf_field() }}
        <div class="formList">
            <input type="text" name="person" id="person" placeholder="person">
            <div class="formListTool">
                <input type="text" id="stock" name="stockName[]" placeholder="stock name">
                <input type="text" name="quantity[]" id="" placeholder="quantity">
                <input type="text" name="price[]" id="" placeholder="price">
            </div>
        </div>
        <input type="submit" value="Save">
    </form>
    <button class="addList">ADD</button>

    <script>
        var stockList = [
            @foreach($stock as $i)
                '{{ $i->stockName }}',
            @endforeach
        ];
        var personList = [
            @foreach($supplyPerson as $value)
                '{{ $value->name }}',
            @endforeach
        ]
        $(document).ready(function () {
            $('#stock').autocomplete({
                source:[stockList]
            });

            $('#person').autocomplete({
                source: [personList]
            });

            $('.addList').on('click', function () {
                var appendList = $('<div class="formListTool"> <input type="text" id="stock" name="stockName[]" placeholder="stock name"> <input type="text" name="quantity[]" id="" placeholder="quantity"> <input type="text" name="price[]" id="" placeholder="price"> </div>');
                $('.formList').append(appendList);
                $('#stock', appendList).autocomplete({
                    source:[stockList]
                });
            });
        });
    </script>
@stop