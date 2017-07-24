@extends('layout.sidebarAdmin')
@section('section')

    <div class="row">
        <form action="{{ route('adminSalesP') }}" method="post">
            {{ csrf_field() }}
            <div class="formList row">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="hidden" name="staff" value="" class="staffHidden">
                        <input id="" type="text" class="validate staff" name="" autocomplete="off">
                        <label for="staff">Staff</label>
                    </div>
                </div>
                <div class="formListTool row">
                    <div class="input-field col s4">
                        <input id="stock" class="" type="text" class="validate" name="stock[]" autocomplete="off">
                        <label for="stock">Stock</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="" class="" type="text" class="validate" name="quantity[]">
                        <label for="Quantity">Quantity</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="" class="" type="text" class="validate" name="price[]">
                        <label for="price">Price</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <a class="addList waves-effect waves-light btn">ADD</a>
                <button type="submit"  class="waves-effect waves-light btn">Save</button>
            </div>
             </form>

        <script>
            var stockList = {
                @foreach($stock as $i)
                '{{ $i->stockName }}': null,
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
                $('input.staff').autocomplete2({
                    data:staffList
                });

                $('.addList').on('click', function () {
                    var appendList = $('<div class="formListTool row"> <div class="input-field col s4"> <input id="stock" class="" type="text" class="validate" name="stock[]"> <label for="stock">Stock</label> </div> <div class="input-field col s4"> <input id="" class="" type="text" class="validate" name="quantity[]"> <label for="Quantity">Quantity</label> </div> <div class="input-field col s4"> <input id="" class="" type="text" class="validate" name="price[]"> <label for="price">Price</label> </div> </div>');
                    $('.formList').append(appendList);
                    $('#stock', appendList).autocomplete({
                        source:[stockList]
                    });
                });
            });
        </script>
    </div>


@stop