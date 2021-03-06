@extends('layout.sidebarAdmin')
@section('section')

    <div class="">
        <form action="{{ route('adminSupplyP') }}" method="post" class="supplyform">
            {{ csrf_field() }}
            <div class="formList ">
                <div class="row">
                    <div class="input-field col s6">
                        <input type="hidden" name="supply" value="" class="supplyhidden">
                        <input id="person" type="text" class="validate" name="" autocomplete="off" required>
                        <label for="person">Supply Person</label>
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
                        <label for="stock">Stock Name</label>
                    </div>
                    <div class="input-field col s1">
                        <input  type="number" min="1" class="validate" name="quantity[]" required disabled>
                        <label for="quantity">Quantity</label>
                    </div>
                    <div class="input-field col s1">
                        <input  type="number" min="0.01" class="validate" name="price[]" required step="0.01" disabled>
                        <label for="price">Price</label>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" class="validate" name="remark[]" >
                        <label for="remark">Remark</label>
                    </div>
                    <div class="col s2">
                        {{--<a class="deleteList waves-effect waves-light btn">delete</a>--}}
                    </div>
                </div>
            </div>
           <div class="row">
               <button class="btn waves-effect waves-light" type="submit" name="action">
                   <i class="material-icons left">save</i>Save
               </button>
               {{--<input type="submit" value="Save" class="waves-effect waves-light btn">--}}
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
                    var appendList = $(' <div class="formListTool row"> <div class="input-field col s4"> <input type="hidden" name="stock[]" value="" class="stockhidden"> <input id="" type="text" class="validate stock" name="" autocomplete="off" required> <label for="stock">Stock Name</label> </div> <div class="input-field col s1"> <input type="number" min="1" class="validate" name="quantity[]" required disabled> <label for="quantity">Quantity</label> </div> <div class="input-field col s1"> <input type="number" min="0.01" class="validate" name="price[]" required step="0.01" disabled> <label for="price">Price</label> </div> <div class="input-field col s4"> <input type="text" class="validate" name="remark[]"  > <label for="remark">Remark</label> </div> <div class="col s2"> <a class="deleteList waves-effect waves-light btn">delete</a> </div> </div>');
                    $('.formList').append(appendList);
                    $('.stock', appendList).autocomplete2({
                        data: stockList
                    });
                    $('.deleteList', appendList).on('click', function () {
                        $(this).parent().parent().remove();
                    });

                    $('.stock', appendList).on('blur', function () {
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