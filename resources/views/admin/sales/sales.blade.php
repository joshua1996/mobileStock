@extends('layout.sidebarAdmin')
@section('section')

    <div class="">
        <form action="{{ route('adminSalesP') }}" method="post" id="stockform">
            {{ csrf_field() }}
            <div class="formList row">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="hidden" name="staffID" value="" class="staffHidden" >
                        <input id="" type="text" class="validate staff" name="" autocomplete="off" required>
                        <label for="staff">Staff</label>
                    </div>
                </div>
                <div class="formListTool row">
                    <div class="input-field col s4">
                        <input type="hidden" name="stock[]" id="stocknamehidden">
                        <input  type="text" class="validate stock"  autocomplete="off" autoid="" required>
                        <label for="stock">Stock</label>
                    </div>
                    <div class="input-field col s1">
                        <input id="" type="number" min="1" class="validate" name="quantity[]" required disabled="">
                        <label for="Quantity">Quantity</label>
                    </div>
                    <div class="input-field col s1">
                        <input id=""  type="number" class="validate" name="price[]" required disabled step=".01">
                        <label for="price">Price</label>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" class="validate" name="remark[]"  >
                        <label for="remark">Remark</label>
                    </div>
                    <div class="col s2">
                        {{--<a class="deleteList waves-effect waves-light btn">ADD</a>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <a class="addList waves-effect waves-light btn" style="float: right;"><i class="material-icons left">add</i>ADD</a>
                <button type="submit"  class="waves-effect waves-light btn"><i class="material-icons left">save</i>Save</button>
            </div>
             </form>

        <script>
            var stockList = [
                @foreach($stock as $i)
                {id: '{{ $i->stockID }}', text: '{{ $i->stockName }}', quantity: '{{ $i->quantity }}' },
                @endforeach
            ];
            var staffList = [
                    @foreach($staff as $i)
                {id: '{{ $i->staffID }}', text: '{{ $i->name }}'},
                @endforeach
            ];

            $(document).ready(function () {

                $('.stock').autocomplete2({
                    data:stockList,
                    change: function (event, ui) {
                        console.log('ss');
                    }
                });
                $('input.staff').autocomplete2({
                    data:staffList
                });

                $('.addList').on('click', function () {
                    var appendList = $('<div class="formListTool row"> <div class="input-field col s4"> <input type="hidden" name="stock[]" id="stocknamehidden"> <input type="text" class="validate stock" autocomplete="off" autoid="" required> <label for="stock">Stock</label> </div> <div class="input-field col s1"> <input id="" type="number" min="1" class="validate" name="quantity[]" required disabled=""> <label for="Quantity">Quantity</label> </div> <div class="input-field col s1"> <input id="" type="number" class="validate" name="price[]" required disabled step=".01"> <label for="price">Price</label> </div> <div class="input-field col s4"> <input type="text" class="validate" name="remark[]"  > <label for="remark">Remark</label> </div> <div class="col s2"> <a class="deleteList waves-effect waves-light btn">delete</a> </div> </div>');
                    $('.formList').append(appendList);

                    $('.stock', appendList).autocomplete2({
                        data:stockList
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


                $('#stockform').on('submit', function () {
                    checkPreloader(true);
                    $('.staffHidden').val($('.staff').attr('autoid'));
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