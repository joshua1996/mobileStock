@extends('layout.sidebarAdmin')
@section('section')
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
            </tr>
        </thead>
        <tbody>
            @foreach($stock as $i=>$value)
                <tr stockID="{{ $value->stockID }}" class="e{{ $i+1 }}">
                    <td>{{ $i + 1 }}</td>
                    <td class="a{{ $i+1 }}">{{ $value->stockName }}</td>
                    <td class="b{{ $i+1 }}">{{ $value->quantity }}</td>
                    <td class="c{{ $i+1 }}">{{ $value->price }}</td>
                    <td class="d{{ $i+1 }}">{{ $value->name }}</td>
                    <td><a class="waves-effect waves-light btn" id="edit" href="#modal1" ind="{{ $i + 1 }}">edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="modal1" class="modal ">
    <div class="modal-content">
        <div class="row">
            <input type="hidden" value="" id="stockID">
            <div class="input-field col s6">
                <input id="stockName" value="" type="text" class="validate">
                <label for="stockName">Stock Name</label>
            </div>
            <div class="input-field col s6">
                <input id="quantity" type="text" class="validate">
                <label for="quantity">Quantity</label>
            </div>
            <div class="input-field col s6">
                <input id="price" type="text" class="validate">
                <label for="price">Price</label>
            </div>
            <div class="input-field col s6">
                <input id="stockType" type="text" class="validate">
                <label for="stockType">Stock Type</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat edit">EDIT</a>
    </div>
</div>

<script>
    //3282 - 3454
    $(document).ready(function(){
        var stockType = [
                @foreach($stockType as $i)
            {id: '{{ $i->stockTypeID }}', text: '{{ $i->name }}'},
            @endforeach
        ];

        $('#stockType').autocomplete2({
            data:stockType
        });


        $('#modal1').modal();
        $('#modal1').modal({
           ready: function(modal, trigger){
               $('#stockName').val($('.a' + trigger.attr('ind')).text());
               $('#quantity').val($('.b' + trigger.attr('ind')).text());
               $('#price').val($('.c' + trigger.attr('ind')).text());
               $('#stockType').val($('.d' + trigger.attr('ind')).text());
               $('#stockID').val($('.e' + trigger.attr('ind')).attr('stockID'));
               console.log(trigger);
               Materialize.updateTextFields();
           }
        });

        $('.edit').on('click', function(){
           var data = {
                stock:$('#stockName').val(),
               quantity:$('#quantity').val(),
               price:$('#price').val(),
               stockType:$('#stockType').val(),
               stockID: $('#stockID').val()
           };
           $.ajax({
               url:'{{ route('stockEditAdmin') }}',
               type:'post',
               data:data,
               success: function (data) {
                   
               }
           });
        });
    });
</script>
@stop