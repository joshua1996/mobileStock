@extends('layout.sideBar')
@section('section')

    <div class="row">

       <div class="row">
           <form action="{{ route('sales') }}" method="post">
               {{ csrf_field() }}
               <div class="formList">
                   <div class="formListTool row" >
                       <div class="input-field col s4">
                           <input id="" class="stock" type="text" class="validate" name="stock[]">
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
               <a class="addList waves-effect waves-light btn" style="float: right;">ADD</a>
               <button type="submit"  class="waves-effect waves-light btn" >Save</button>
           </form>
       </div>


        <script>
            var stockList = {
                @foreach($stock as $i)
                    '{{ $i->stockName }}' : null,
                @endforeach
            };
            $(document).ready(function () {
                $('input.stock').autocomplete({
                    data:stockList
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