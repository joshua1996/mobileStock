@extends('layout.sidebarAdmin')
@section('section')

    <div class="row">
        <form action="{{ route('adminSalesP') }}" method="post" id="stockform">
            {{ csrf_field() }}
            <div class="formList row">
                <div class="row">
                    <div class="input-field col s9">
                        <input type="hidden" name="staffID" value="" class="staffHidden" >
                        <input id="" type="text" class="validate staff" name="" autocomplete="off" required>
                        <label for="staff">Staff</label>
                    </div>
                </div>
                <div class="formListTool row">
                    <div class="input-field col s3">
                        <input type="hidden" name="stock[]" id="stocknamehidden">
                        <input  type="text" class="validate stock"  autocomplete="off" autoid="">
                        <label for="stock">Stock</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="" class="" type="text" class="validate" name="quantity[]">
                        <label for="Quantity">Quantity</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="" class="" type="text" class="validate" name="price[]">
                        <label for="price">Price</label>
                    </div>
                    <div class="col s3">
                        {{--<a class="deleteList waves-effect waves-light btn">ADD</a>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <a class="addList waves-effect waves-light btn" style="float: right;">ADD</a>
                <button type="submit"  class="waves-effect waves-light btn">Save</button>
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
                $('.stock').autocomplete2({
                    data:stockList
                });
                $('input.staff').autocomplete2({
                    data:staffList
                });

                $('.addList').on('click', function () {
                    var appendList = $(' <div class="formListTool row"> <div class="input-field col s3"> <input type="hidden" name="stock[]" id="stocknamehidden"> <input type="text" class="validate stock" autocomplete="off" autoid=""> <label for="stock">Stock</label> </div> <div class="input-field col s3"> <input id="" class="" type="text" class="validate" name="quantity[]"> <label for="Quantity">Quantity</label> </div> <div class="input-field col s3"> <input id="" class="" type="text" class="validate" name="price[]"> <label for="price">Price</label> </div> <div class="col s3"> <a class="deleteList waves-effect waves-light btn">delete row</a> </div> </div>');
                    $('.formList').append(appendList);
                    $('.stock', appendList).autocomplete2({
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
                   // $('#stocknamehidden').val($('#stock').attr('autoid'));
                });






            });
        </script>
    </div>


@stop