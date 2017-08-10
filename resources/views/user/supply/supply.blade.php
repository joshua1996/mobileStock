@extends('layout.sideBar')
@section('section')

    <div class="">
        <style>
            td{
                padding: 0px 5px;
            }
        </style>
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
                    <div class="input-field col s4">
                        <input type="hidden" name="stock[]" value="" class="stockhidden">
                        <input id="" type="text" class="validate stock" name="" autocomplete="off" required>
                        <label for="last_name">Stock Name</label>
                    </div>
                    <div class="input-field col s1">
                        <input  type="number" min="1" class="validate" name="quantity[]" required disabled>
                        <label for="last_name">Quantity</label>
                    </div>
                    <div class="input-field col s1">
                        <input  type="number"  class="validate" name="price[]" required disabled>
                        <label for="last_name">Price</label>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" class="validate" name="remark[]" required >
                        <label for="remark">Remark</label>
                    </div>
                    <div class="col s3">
                        {{--<a class="deleteList waves-effect waves-light btn">delete row</a>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect waves-light" type="submit" name="action"><i class="material-icons left">save</i>Save</button>
                <a class="addList waves-effect waves-light btn" style="float: right;"><i class="material-icons left">add</i>ADD</a>
            </div>

        </form>


        <script>
            var stockList = [
                @foreach($stock as $i)
                {id: '{{ $i->stockID }}', text: '{{ $i->stockName }}', quantity: {{ $i->quantity }}},
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
                    var appendList = $('<div class="formListTool row"> <div class="input-field col s4"> <input type="hidden" name="stock[]" value="" class="stockhidden"> <input id="" type="text" class="validate stock" name="" autocomplete="off" required> <label for="last_name">Stock Name</label> </div> <div class="input-field col s1"> <input type="number" min="1" class="validate" name="quantity[]" required disabled> <label for="last_name">Quantity</label> </div> <div class="input-field col s1"> <input type="number" min="0.01" class="validate" name="price[]" required disabled> <label for="last_name">Price</label> </div> <div class="input-field col s4"> <input type="text" class="validate" name="remark[]" required > <label for="remark">Remark</label> </div> <div class="col s2"> <a class="deleteList waves-effect waves-light btn">delete</a> </div> </div>');
                    $('.formList').append(appendList);
                    $('.stock', appendList).autocomplete2({
                        data:stockList
                    });
                    $('.deleteList', appendList).on('click', function () {
                        $(this).parent().parent().remove();
                    });
                });

                $('.supplyform').on('submit', function () {
                    checkPreloader(true);
                    $('.supplyhidden').val($('#person').attr('autoid'));
                    $('.staffhidden').val($('.staff').attr('autoid'));
                    $('.stock').each(function (index) {
                        $(this).prev().val($(this).attr('autoid'));
                    });
                });

                $('.stock').on('blur', function () {
                    var a = $(this).val();
                    if(a.length)
                    {
                        var found_names = $.grep(stockList, function(v) {
                            return v.text === a;
                        });
                        $(this).parent().next().children().removeAttr('disabled');
                        $(this).parent().next().next().children().removeAttr('disabled');
                        $(this).parent().next().children().attr('max', found_names[0].quantity);
                    }else {
                        $(this).parent().next().children().val('');
                        $(this).parent().next().next().children().val('');
                        $(this).parent().next().children().prop('disabled', true);
                        $(this).parent().next().next().children().prop('disabled', true);
                        Materialize.updateTextFields();
                    }

                });
            });
        </script>
    </div>

@stop