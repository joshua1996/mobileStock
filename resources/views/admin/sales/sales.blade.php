@extends('layout.sidebarAdmin')
@section('section')

    <form action="{{ route('adminSalesP') }}" method="post">
        {{ csrf_field() }}
        <div class="formList">
            <div class="formListTool">
                <input type="text" id="stock" name="stock[]">
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
        $(document).ready(function () {
            $('#stock').autocomplete({
                source:[stockList]
            });

            $('.addList').on('click', function () {
                var appendList = $('<div class="formListTool"> <input type="text" id="stock" name="stock[]"> <input type="text" name="quantity[]" id="" placeholder="quantity"> <input type="text" name="price[]" id="" placeholder="price"> </div>');
                $('.formList').append(appendList);
                $('#stock', appendList).autocomplete({
                    source:[stockList]
                });
            });
        });
    </script>

@stop