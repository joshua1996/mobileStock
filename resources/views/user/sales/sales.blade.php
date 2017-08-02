@extends('layout.sideBar')
@section('section')

    <div class="">

        <form action="{{ route('sales') }}" method="post" id="stockform">
            {{ csrf_field() }}
            <div class="formList ">
                <div class="row">
                    <div class="input-field col s12 l12">
                        <input type="hidden" name="staff" value="" class="staffHidden">
                        <input id=""  type="text" class="validate staff"  name="" autocomplete="off" autoid="" required>
                        <label for="staff">Staff</label>
                    </div>
                </div>
                <div class="formListTool row" >
                    <div class="input-field col s3">
                        <input type="hidden" name="stock[]" class="stocknamehidden">
                        <input id="" type="text" class="validate stock"  autocomplete="off" required>
                        <label for="last_name">Stock</label>
                    </div>
                    <div class="input-field col s3">
                        <input  type="number" min="1" class="validate quantity" disabled id="" name="quantity[]" required>
                        <label for="disabled">Quantity</label>
                    </div>
                    <div class="input-field col s3">
                        <input  type="number" min="1" class="validate" name="price[]" required disabled step=".01">
                        <label for="last_name">Price</label>
                    </div>
                    <div class="col s3">
                        {{--<a class="deleteList waves-effect waves-light btn"><i class="material-icons left">delete</i>delete</a>--}}
                    </div>
                </div>
            </div>
            <div class="">
                <a class="addList waves-effect waves-light btn" style="float: right;"> <i class="material-icons left">add</i>Add</a>
                <button type="submit"  class="waves-effect waves-light btn" > <i class="material-icons left">save</i>Save</button>
            </div>
        </form>

        <script>
            var stockList = [
                @foreach($stock as $i)
            {id: '{{ $i->stockID }}', text: '{{ $i->stockName }}', quantity: {{ $i->quantity }}},
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
                    var appendList = $('<div class="formListTool row" > <div class="input-field col s3"> <input type="hidden" name="stock[]" class="stocknamehidden"> <input id="" type="text" class="validate stock" autocomplete="off" required> <label for="last_name">Stock</label> </div> <div class="input-field col s3"> <input type="number" min="1" class="validate quantity" disabled id="" name="quantity[]" required> <label for="disabled">Quantity</label> </div> <div class="input-field col s3"> <input type="number" min="1" class="validate" name="price[]" required disabled step=".01"> <label for="last_name">Price</label> </div> <div class="col s3"> {{--<a class="deleteList waves-effect waves-light btn"><i class="material-icons left">delete</i>delete</a>--}} </div> </div>');
                    $('.formList').append(appendList);
                    $('input.stock', appendList).autocomplete2({
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