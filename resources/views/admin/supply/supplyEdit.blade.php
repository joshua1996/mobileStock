@extends('layout.sidebarAdmin')
@section('section')

    <div class="row">
        <div class="row">
            <a href="#modal2" class="waves-effect waves-light btn">add supply person</a>
        </div>
        <div class="row">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($supplyPerson as $i=>$value)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td class="a{{ $i+1 }}">{{ $value->name }}</td>
                        <td><a class="waves-effect waves-light btn" id="edit" href="#modal1" ind="{{ $i + 1 }}">edit</a></td>
                        <td><a class="waves-effect waves-light btn delete" deleteid="{{ $value->supplyID }}">delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal1" class="modal ">
        <div class="modal-content">
            <div class="row">
                <div class="input-field col s12">
                    <input id="" value="" class="supplyPerson" type="text" class="validate">
                    <label for="name">Supply Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat edit">EDIT</a>
        </div>
    </div>

    <div id="modal2" class="modal ">
        <div class="modal-content">
            <div class="row">
                <div class="input-field col s12">
                    <input id="" value="" class="supplyPersonAdd" type="text" class="validate">
                    <label for="name">Supply Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat add">add</a>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var index = 0;
            $('#modal1').modal();
            $('#modal1').modal({
                ready: function(modal, trigger){
                    index = trigger.attr('ind');
                    $('.supplyPerson').val($('.a'+ trigger.attr('ind')).text());
                    Materialize.updateTextFields();
                }
            });

            $('#modal2').modal();

            $('.edit').on('click', function () {
                var data = {
                    supplyPerson : $('.supplyPerson').val()
                };
                $.ajax({
                    url: '{{ route('supplyPersonEditAdmin') }}',
                    type: 'post',
                    data: data,
                    success: function () {
                        Materialize.toast('Edit Success!', 4000);
                        $('.a' + index).text($('.supplyPerson').val());
                    }
                });
            });

            $('.add').on('click', function () {
                var data = {
                  supplyPerson:  $('.supplyPersonAdd').val()
                };
                $.ajax({
                    url: '{{ route('supplyPersonAddAdmin') }}',
                    type: 'post',
                    data: data,
                    success: function(){
                        Materialize.toast('Add Success!', 4000);
                    }
                });
            });

            $('.delete').on('click', function () {
                var data = {
                    supplyID :$(this).attr('deleteid')
                }
                $.ajax({
                    url:'{{ route('supplyPersonDeleteAdmin') }}',
                    type:'post',
                    data:data,
                    success: function (data) {
                        Materialize.toast('Delete Success!', 4000);
                    }
                });
            });
        });
    </script>
    @stop