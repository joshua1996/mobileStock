@extends('layout.sidebarAdmin')
@section('section')
<div class="row">
    <div class="row">
        <a href="#modal1" class="waves-effect waves-light btn"><i class="material-icons left">add</i>add</a>
    </div>

    <div class="row">
        <table>
            <thead>
            <tr>
                <th>NO</th>
                <th>Stock Type</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stockType as $i=>$value)
                <tr stockTypeID="{{ $value->stockTypeID }}" class="b{{ $i+1 }}">
                    <td>{{ $i + 1 }}</td>
                    <td class="a{{ $i+1 }}">{{ $value->name }}</td>
                    <td><a class="waves-effect waves-light btn" href="#modal2" ind="{{ $i + 1 }}"><i class="material-icons left">edit</i>edit</a></td>
                    <td><a class="waves-effect waves-light btn " href="#modal3"  ind="{{ $i + 1 }}"><i class="material-icons left">delete</i>delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--{{ $stock->render() }}--}}
    </div>

    <div id="modal1" class="modal">
        <form action="" id="add">
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="" value="" type="text" class="validate stocktypename" required>
                        <label for="name">Name</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-light  btn-flat " type="submit" name="action">add</button>
            </div>
        </form>
    </div>

    <div id="modal2" class="modal">
        <form action="" id="edit">
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s6">

                        <input id="" value="" type="text" class="validate editname" required>
                        <label for="name">Name</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-light  btn-flat " type="submit" name="action">edit</button>
            </div>
        </form>
    </div>

    <div id="modal3" class="modal">
        <div class="modal-content">
            <div class="row">
               <h4>Delete?</h4>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat delete" deleteid="">Delete</a>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var index=  0;
            var stockTypeID = '';
            $('#modal1').modal();
            $('#modal2').modal({
                ready: function(modal, trigger){
                    index = trigger.attr('ind');
                    $('.editname').val($('.a' + trigger.attr('ind')).text());
                    stockTypeID = $('.b' + trigger.attr('ind')).attr('stockTypeID');
                    Materialize.updateTextFields();
                }
            });
            $('#modal3').modal({
                ready: function(modal, trigger){
                    index = trigger.attr('ind');
                    $('.delete').attr('deleteid', $('.b' + trigger.attr('ind')).attr('stocktypeid'));
                    Materialize.updateTextFields();
                }
            });

            $('#add').on('submit', function (e) {
                e.preventDefault();
                var data = {
                    name: $('.stocktypename').val()
                };
                $.ajax({
                    url:'{{ route('stockTypeAddAdmin') }}',
                    type:'post',
                    data:data,
                    success: function(data){
                        Materialize.toast('Add Success!', 4000);
                    }
                });
                $('#modal1').modal('close');
                return false;
            });

            $('#edit').on('submit', function(e){
                e.preventDefault();
                var data = {
                    name:$('.editname').val(),
                    stockTypeID: stockTypeID
                };
                $.ajax({
                    url:'{{ route('stockTypeEditAdmin') }}',
                    type:'post',
                    data:data,
                    success: function (data) {
                        Materialize.toast('Edit Success!', 4000)
                        $('.a' + index).text($('.editname').val());
                        $('.b' + index).val(stockTypeID);
                    }
                });
                $('#modal2').modal('close');
                return false;
            });

            $('.delete').on('click', function () {
                var data = {
                    stockTypeID :$(this).attr('deleteid')
                }
                $.ajax({
                    url:'{{ route('stockTypeDeleteAdmin') }}',
                    type:'post',
                    data:data,
                    success: function (data) {
                        $('.b' + index).remove();
                        Materialize.toast('Delete Success!', 4000);
                    }
                });
            });
        });
    </script>
</div>
    @stop