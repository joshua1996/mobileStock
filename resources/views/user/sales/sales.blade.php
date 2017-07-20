@extends('layout.sideBar')
@section('section')

    <div class="row">

           <form action="{{ route('sales') }}" method="post">
               {{ csrf_field() }}
               <div class="formList row">
                   <div class="row">
                       <div class="input-field col s12">
                           <input type="hidden" name="staff" value="" class="staffHidden">
                           <input id="" class="staff" type="text" class="validate" name="" autocomplete="off">
                           <label for="staff">Staff</label>
                       </div>
                   </div>
                   <div class="formListTool row" >
                       <div class="input-field col s4">
                           <input id="" class="stock" type="text" class="validate" name="stock[]" autocomplete="off">
                           <label for="last_name">Stock</label>
                       </div>
                       <div class="input-field col s4">
                           <input  type="text" class="validate" name="quantity[]">
                           <label for="last_name">Quantity</label>
                       </div>
                       <div class="input-field col s4">
                           <input  type="text" class="validate" name="price[]">
                           <label for="last_name">Price</label>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <a class="addList waves-effect waves-light btn" style="float: right;">ADD</a>
                   <button type="submit"  class="waves-effect waves-light btn" >Save</button>
               </div>
           </form>

        <script>
            var stockList = {
                @foreach($stock as $i)
                    '{{ $i->stockName }}' : null,
                @endforeach
            };
            {{--var staffList = {--}}
                {{--@foreach($staff as $i)--}}
                    {{--'{{ $i->name }}' : '{{ $i->staffID }}',--}}
                {{--@endforeach--}}
            {{--};--}}
            var staffList = [
                @foreach($staff as $i)
                {id: '{{ $i->staffID }}', text: '{{ $i->name }}'},
                @endforeach
            ];
            $(document).ready(function () {
                $('input.stock').autocomplete({
                    data:stockList
                });
                $('input.staff').autocomplete2({
                    data:staffList
                });

                $('input.stock').on('change', function(){
                    for (var key in stockList) {
                        if ($('input.stock').val() == key)
                        {
                            console.log('yes');
                        }
                        if (stockList.hasOwnProperty(key)) {
                            console.log(key + " -> " + stockList[key]);
                        }
                    }
                });

                $('.addList').on('click', function () {
                    var appendList = $(' <div class="formListTool row"> <div class="input-field col s4"> <input id="" class="stock" type="text" class="validate" name="stock[]"> <label for="last_name">Stock</label> </div> <div class="input-field col s4"> <input type="text" class="validate" name="quantity[]"> <label for="last_name">Quantity</label> </div> <div class="input-field col s4"> <input type="text" class="validate" name="price[]"> <label for="last_name">Price</label> </div> </div>');
                    $('.formList').append(appendList);
                    $('input.stock', appendList).autocomplete({
                        data:stockList
                    });
                });
            });


        </script>


    </div>

    @stop