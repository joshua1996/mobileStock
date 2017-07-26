@extends('layout.sideBar')
@section('section')

    <div class="row">

        <form action="{{ route('sales') }}" method="post" id="stockform">
            {{ csrf_field() }}
            <div class="formList row">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="hidden" name="staff" value="" class="staffHidden">
                        <input id=""  type="text" class="validate staff"  name="" autocomplete="off" autoid="">
                        <label for="staff">Staff</label>
                    </div>
                </div>
                <div class="formListTool row" >
                    <div class="input-field col s3">
                        <input type="hidden" name="stock[]" class="stocknamehidden">
                        <input id="" class="stock" type="text" class="validate"  autocomplete="off">
                        <label for="last_name">Stock</label>
                    </div>
                    <div class="input-field col s3">
                        <input  type="text" class="validate" name="quantity[]">
                        <label for="last_name">Quantity</label>
                    </div>
                    <div class="input-field col s3">
                        <input  type="text" class="validate" name="price[]">
                        <label for="last_name">Price</label>
                    </div>
                    <div class="col s3">
                        {{--<a class="deleteList waves-effect waves-light btn">delete row</a>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <a class="addList waves-effect waves-light btn" style="float: right;">ADD</a>
                <button type="submit"  class="waves-effect waves-light btn" >Save</button>
            </div>
        </form>

        <script>
            var stockList = [
                @foreach($stock as $i)
            {id: '{{ $i->stockID }}', text: '{{ $i->stockName }}'},
            @endforeach
            ];
            var staffList = [
                    @foreach($staff as $i)
                {id: '{{ $i->staffID }}', text: '{{ $i->name }}'},
                @endforeach
            ];
            $(document).ready(function () {
                $('input.stock').autocomplete2({
                    data:stockList
                });
                $('input.staff').autocomplete2({
                    data:staffList
                });

                $('.addList').on('click', function () {
                    var appendList = $('<div class="formListTool row" > <div class="input-field col s3"> <input type="hidden" name="stock[]" class="stocknamehidden"> <input id="" class="stock" type="text" class="validate" autocomplete="off"> <label for="last_name">Stock</label> </div> <div class="input-field col s3"> <input type="text" class="validate" name="quantity[]"> <label for="last_name">Quantity</label> </div> <div class="input-field col s3"> <input type="text" class="validate" name="price[]"> <label for="last_name">Price</label> </div> <div class="col s3"> <a class="deleteList waves-effect waves-light btn">delete row</a> </div> </div>');
                    $('.formList').append(appendList);
                    $('input.stock', appendList).autocomplete2({
                        data:stockList
                    });
                    $('.deleteList', appendList).on('click', function () {
                        $(this).parent().parent().remove();
                    });
                });

                $('#stockform').on('submit', function () {
                    $('.staffHidden').val($('.staff').attr('autoid'));
                    $('.stock').each(function (index) {
                        $(this).prev().val($(this).attr('autoid'));
                    });
                   // $('.stocknamehidden').val($('.stock').attr('autoid'));
                });
            });
        </script>


    </div>

@stop