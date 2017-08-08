@extends('layout.sidebarAdmin')
@section('section')
<div class="row">
    <style>
        td{
            padding: 1px 0px;
        }
    </style>
    <div class="row">
        <div class="input-field col s6">
            <input id="" type="text" class="validate searchname">
            <label for="Stock">Stock Name</label>
        </div>
        <a class="waves-effect waves-light btn search"><i class="material-icons left">search</i>Search</a>
    </div>
    <div class="row">
        <a href="#modal2" class="waves-effect waves-light btn"><i class="material-icons left">add</i>add stock</a>
    </div>
    <div class="row">
        <table>
            <thead>
            <tr>
                <th>NO</th>
                <th>Stock Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Stock Type</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody class="stocktable">
            @foreach($stock as $i=>$value)
                <tr stockID="{{ $value->stockID }}" class="e{{ $i+1 }}">
                    <td>{{ (($stock->currentPage() - 1 ) * $stock->perPage() ) + $loop->iteration }}</td>
                    <td class="a{{ $i+1 }}">{{ $value->stockName }}</td>
                    <td class="b{{ $i+1 }}">{{ $value->quantity }}</td>
                    <td class="c{{ $i+1 }}">{{ $value->price }}</td>
                    <td class="d{{ $i+1 }}" stockType="{{ $value->stockTypeID }}">{{ $value->name }}</td>
                    <td><a class="waves-effect waves-light btn" href="#modal1" ind="{{ $i + 1 }}"><i class="material-icons left">edit</i>edit</a></td>
                    <td><a class="waves-effect waves-light btn " href="#modal3" ind="{{ $i + 1 }}"><i class="material-icons left">delete</i>delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $stock->render() }}
    </div>

</div>
<div id="modal1" class="modal ">
    <form action="" id="edit">
        <div class="modal-content">
            <div class="row">
                <input type="hidden" value="" id="stockID">
                <div class="input-field col s6">
                    <input id="stockName" value="" type="text" class="validate" required>
                    <label for="stockName">Stock Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="quantity" type="number" class="validate" required>
                    <label for="quantity">Quantity</label>
                </div>
                <div class="input-field col s6">
                    <input id="price" type="number" class="validate" required>
                    <label for="price">Price</label>
                </div>
                <div class="input-field col s6">
                    <input id="stockType" type="text" class="validate" autoid="" required>
                    <label for="stockType">Stock Type</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="waves-effect waves-light  btn-flat add" type="submit" name="action">edit</button>
        </div>
    </form>

</div>

<div id="modal2" class="modal">
    <form action="" id="add">
        <div class="modal-content">

            <div class="row">
                <div class="input-field col s6">
                    <input id="" value="" type="text" class="validate addstock" required>
                    <label for="stockName">Stock Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="" type="number" class="validate addquantity" required>
                    <label for="quantity">Quantity</label>
                </div>
                <div class="input-field col s6">
                    <input id="" type="number" class="validate addprice" step="0.01" required>
                    <label for="price">Price</label>
                </div>
                <div class="input-field col s6">
                    <input id="addStockType" type="text" class="validate addstocktype" autoid="" required autocomplete="off">
                    <label for="stockType">Stock Type</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="waves-effect waves-light  btn-flat add" type="submit" name="action">add</button>
            {{--<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat add">add</a>--}}
        </div>
    </form>

</div>

<div id="modal3" class="modal">
    <div class="modal-content">
        <div class="row">
            <h4>Warning!</h4>
            <p>Delete?</p>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" deleteid="" class="modal-action modal-close waves-effect waves-green btn-flat delete">Delete</a>
    </div>
</div>

<script>
    //3282 - 3454
    $(document).ready(function(){
        var index=  0;
        var stockType = [
                @foreach($stockType as $i)
            {id: '{{ $i->stockTypeID }}', text: '{{ $i->name }}'},
            @endforeach
        ];
        $('#stockType').autocomplete2({
            data:stockType
        });
        $('#addStockType').autocomplete2({
           data: stockType
        });

        $('#modal1').modal();
        $('#modal1').modal({
           ready: function(modal, trigger){
               index = trigger.attr('ind');
               $('#stockName').val($('.a' + trigger.attr('ind')).text());
               $('#quantity').val($('.b' + trigger.attr('ind')).text());
               $('#price').val($('.c' + trigger.attr('ind')).text());
               $('#stockType').val($('.d' + trigger.attr('ind')).text());
               $('#stockType').attr('autoid', $('.d' + trigger.attr('ind')).attr('stockType'));
               $('#stockID').val($('.e' + trigger.attr('ind')).attr('stockID'));
               Materialize.updateTextFields();
           }
        });

        $('#modal2').modal();
        $('#modal3').modal({
            ready: function (modal, trigger) {
                index = trigger.attr('ind');
                $('.delete').attr('deleteid', $('.e' + trigger.attr('ind')).attr('stockid'));
            }
        });

        $('#edit').on('submit', function (e) {
           e.preventDefault();
            var data = {
                stockName:$('#stockName').val(),
                quantity:$('#quantity').val(),
                price:$('#price').val(),
                stockType: $('#stockType').attr('autoid'),
                stockID: $('#stockID').val()
            };
            $.ajax({
                url:'{{ route('stockEditAdmin') }}',
                type:'post',
                data:data,
                success: function (data) {
                    Materialize.toast('Edit Success!', 4000)
                    $('.a' + index).text($('#stockName').val());
                    $('.b' + index).text($('#quantity').val());
                    $('.c' + index).text($('#price').val());
                    $('.d' + index).text($('#stockType').val());
                    $('.d' + index).attr('stocktype', $('#stockType').attr('autoid'));
                }
            });
            $('#modal1').modal('close');
            return false;
        });


        $('.delete').on('click', function () {
            var data = {
                stockID :$(this).attr('deleteid')
            }
            $.ajax({
                url:'{{ route('stockDeleteAdmin') }}',
                type:'post',
                data:data,
                success: function (data) {
                    $('.e' + index).remove();
                    Materialize.toast('Delete Success!', 4000);
                }
            });
        });

        $('#add').submit(function (e) {
            e.preventDefault();
            var data = {
                stockname: $('.addstock').val(),
                quantity: $('.addquantity').val(),
                price: $('.addprice').val(),
                stocktype: $('.addstocktype').attr('autoid')
            };
            $.ajax({
                url:'{{ route('stockAddAdmin') }}',
                type:'post',
                data:data,
                success: function(data){
                    Materialize.toast('Add Success!', 4000);
                }
            });
            $('#modal2').modal('close');
            return false;
        })

        $('.search').on('click', function () {
            window.location.replace('/admin/stock/'+$('.searchname').val()+'');
        });
    });
</script>
@stop