@extends('layout.sidebarBoss')
@section('section')
<div>
    <div class="row">
        <a href="#modal1" class="waves-effect waves-light btn"><i class="material-icons left">add</i>add Shop</a>
    </div>
    <div>
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Shop Name</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shop as $i=>$v)
                <tr shopid="{{ $v->shopID }}" class="b{{ $i }}">
                    <td>{{ $i+1 }}</td>
                    <td class="a{{ $i }}">{{ $v->shopName }}</td>
                    <td><a class='dropdown-button btn' href='#' data-activates='dropdown{{ $i }}'>Edit</a>
                        <ul id='dropdown{{ $i }}' class='dropdown-content'>
                            <li><a href="#modal2" ind="{{ $i }}"><i class="material-icons">edit</i>Modify</a></li>
                            <li><a href="#modal3" ind="{{ $i }}"><i class="material-icons">delete</i>Delete</a></li>
                        </ul></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div id="modal1" class="modal ">
        <form action="" id="add">
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s12">
                        <input  value="" type="text" class="validate shopname" required>
                        <label for="shopname">Shop Name</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-light btn-flat add" type="submit" name="action">Add</button>
            </div>
        </form>
    </div>

    <div id="modal2" class="modal ">
        <form action="" id="edit">
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s12">
                        <input  value="" type="text" class="validate shopnameedit" required>
                        <label for="shopname">Shop Name</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-light btn-flat" type="submit" name="action">Modify</button>
            </div>
        </form>
    </div>

    <div id="modal3" class="modal ">
            <div class="modal-content">
                <h4>Delete?</h4>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat delete">Delete</a>
            </div>
    </div>

    <script>
        $(document).ready(function () {
            var index = 0;
            $('#modal1').modal();
            $('#modal2').modal({
                ready: function(modal, trigger){
                    index = trigger.attr('ind');
                    $('.shopnameedit').val($('.a'+ index).text());
                    Materialize.updateTextFields();
                }
            });
            $('#modal3').modal({
                ready: function (modal, trigger) {
                    index = trigger.attr('ind');
                }
            });

            $('#add').on('submit', function (e) {
                e.preventDefault();
                var data = {
                   shopName :  $('.shopname').val()
                };
                $.ajax({
                    url: '{{ route('shopadd') }}',
                    type: 'post',
                    data: data,
                    success: function (d) {
                        $('#modal1').modal('close');
                        Materialize.toast('Add Success!', 4000);
                    }
                });
                return false;
            });

            $('#edit').on('submit', function (e) {
                e.preventDefault();
                var data = {
                    shopName :  $('.shopnameedit').val(),
                    shopID: $('.b' + index).attr('shopid')
                };
                $.ajax({
                    url: '{{ route('shopedit') }}',
                    type: 'post',
                    data: data,
                    success: function (d) {
                        $('.a' + index).text($('.shopnameedit').val());
                        $('#modal2').modal('close');
                        Materialize.toast('Modify Success!', 4000);
                    }
                });
                return false;
            });

            $('.delete').on('click', function (e) {
                var data = {
                    shopID: $('.b' + index).attr('shopid')
                };
                $.ajax({
                    url: '{{ route('shopdelete') }}',
                    type: 'post',
                    data: data,
                    success: function (d) {
                        $('.b' + index).remove();
                        $('#modal3').modal('close');
                        Materialize.toast('Delete Success!', 4000);
                    }
                });
            });

            $('.dropdown-button').dropdown({
                    constrainWidth: false
                }
            );
        });
    </script>
</div>
    @stop