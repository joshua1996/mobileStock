@extends('layout.sideBar')
@section('section')

    <div class="row">
        <form action="{{ route('supplyP') }}" method="post" class="supplyform">
            {{ csrf_field() }}
            <div class="formList row">
                <div class="row">
                    <div class="input-field col s6">
                        <input type="hidden" name="supply" value="" class="supplyhidden">
                        <input id="person" type="text" class="validate" name="" autocomplete="off" required>
                        <label for="last_name">Supply Person</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="hidden" name="staff" value="" class="staffhidden">
                        <input id="" type="text" class="validate staff" name="" autocomplete="off" required>
                        <label for="staff">Staff</label>
                    </div>
                </div>

                <div class="formListTool row">
                    <div class="input-field col s3">
                        <input type="hidden" name="stock[]" value="" class="stockhidden">
                        <input id="" type="text" class="validate stock" name="" autocomplete="off" required>
                        <label for="last_name">Stock Name</label>
                    </div>
                    <div class="input-field col s3">
                        <input  type="text" class="validate" name="quantity[]" required>
                        <label for="last_name">Quantity</label>
                    </div>
                    <div class="input-field col s3">
                        <input  type="text" class="validate" name="price[]" required>
                        <label for="last_name">Price</label>
                    </div>
                    <div class="col s3">
                        {{--<a class="deleteList waves-effect waves-light btn">delete row</a>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect waves-light" type="submit" name="action">Save
                </button>
                <a class="addList waves-effect waves-light btn" style="float: right;">ADD</a>
            </div>

        </form>


        <script>
            var stockList = [
                @foreach($stock as $i)
                {id: '{{ $i->stockID }}', text: '{{ $i->stockName }}'},
                @endforeach
            ];
            var personList = [
                @foreach($supplyPerson as $i)
                {id: '{{ $i->supplyID }}', text: '{{ $i->name }}'},
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
                $('#person').autocomplete2({
                    data: personList
                });
                $('.staff').autocomplete2({
                    data: staffList
                });

                $('.addList').on('click', function () {
                    var appendList = $(' <div class="formListTool row"> <div class="input-field col s3"> <input type="hidden" name="stock[]" value="" class="stockhidden"> <input id="" type="text" class="validate stock" name="" autocomplete="off" required> <label for="last_name">Stock Name</label> </div> <div class="input-field col s3"> <input type="text" class="validate" name="quantity[]" required> <label for="last_name">Quantity</label> </div> <div class="input-field col s3"> <input type="text" class="validate" name="price[]" required> <label for="last_name">Price</label> </div> <div class="col s3"> <a class="deleteList waves-effect waves-light btn">delete row</a> </div> </div>');
                    $('.formList').append(appendList);
                    $('.stock', appendList).autocomplete2({
                        data:stockList
                    });
                    $('.deleteList', appendList).on('click', function () {
                        $(this).parent().parent().remove();
                    });
                });

                $('.supplyform').on('submit', function () {
                    $('.supplyhidden').val($('#person').attr('autoid'));
                    $('.staffhidden').val($('.staff').attr('autoid'));
                    $('.stock').each(function (index) {
                        $(this).prev().val($(this).attr('autoid'));
                    });
                   // $('.stockhidden').val($('.stock').attr('autoid'));
                });
            });
        </script>
    </div>

@stop