@extends('layout.sidebarBoss')
@section('section')
<div>
    <div class="row">
        <div class="input-field col s12">
            <select id="adminselect">
                <option value="" disabled selected>Choose your option</option>
                @foreach($shop as $i=>$value)
                    <option value="{{ $value->shopID }}">{{ $value->shopName }}</option>
                @endforeach

            </select>
            <label>Shop Select</label>
        </div>
    </div>

    <div class="row">
        <a class="btn disabled add modal-trigger" href="#modal1"><i class="material-icons left">add</i>Add Admin</a>
    </div>

    <div class="row">
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody class="userlist">
            </tbody>
        </table>
    </div>

    <div id="modal1" class="modal">
        <form action="" id="add">
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s6">
                        <input  value="" type="text" class="validate adminname" required>
                        <label for="adminname">Admin Name</label>
                    </div>
                    <div class="input-field col s6">
                        <input  value="" type="text" class="validate password" required>
                        <label for="password">Password</label>
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
                    <div class="input-field col s6">
                        <input  value="" type="text" class="validate adminnameedit" required>
                        <label for="shopname">Shop Name</label>
                    </div>
                    <div class="input-field col s6">
                        <input  value="" type="text" class="validate passwordedit" required>
                        <label for="password">Password</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-light btn-flat" type="submit" name="action">Modify</button>
            </div>
        </form>
    </div>

    <div id="modal3" class="modal">
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
            $('#adminselect').material_select();
            $('#modal1').modal();


            $('#adminselect').on('change', function () {
                var data= {
                    shopID: $(this).val()
                };
                $.ajax({
                    url: '{{ route('shopSelect') }}',
                    type: 'post',
                    data: data,
                    success: function (data) {
                        $('.userlist').empty();
                        $.each(data.shop, function (i, v) {
                            $('.userlist').append(' <tr class="b'+(i+1)+'" adminID="'+ v.adminID +'"> <td>'+(i+1)+'</td> <td class="a'+ (i+1) +'">'+(v.adminName)+'</td> <td><a class="dropdown-button btn" href="#" data-activates="dropdown'+ (i+1) +'">Edit</a> <ul id="dropdown'+ (i+1) +'" class="dropdown-content"> <li><a href="#modal2" ind="'+ (i+1) +'"><i class="material-icons">edit</i>Modify</a></li> <li><a href="#modal3" ind="'+ (i+1) +'"><i class="material-icons">delete</i>Delete</a></li> </ul></td></tr>');

                        });
                        $('.dropdown-button').dropdown({
                                constrainWidth: false
                            }
                        );
                        $('#modal2').modal({
                            ready: function(modal, trigger){
                                index = trigger.attr('ind');
                                $('.adminnameedit').val($('.a'+ index).text());
                                Materialize.updateTextFields();
                            }
                        });
                        $('#modal3').modal({
                            ready: function(modal, trigger){
                                index = trigger.attr('ind');
                            }
                        });
                        $('.add').removeClass('disabled').addClass('waves-effect waves-light"');
                    }
                });
            });

            $('#add').on('submit', function (e) {
                $('#preloaderBlock').addClass('preloader-background');
                e.preventDefault();
                var data = {
                    shopID: $('#adminselect').val(),
                    adminName :  $('.adminname').val(),
                    password:  $('.password').val()
                };
                $.ajax({
                    url: '{{ route('adminAdd') }}',
                    type: 'post',
                    data: data,
                    success: function (d) {
                        $('#preloaderBlock').removeClass('preloader-background');
                        $('#modal1').modal('close');
                        Materialize.toast('Add Success!', 4000);
                    }
                });
                return false;
            });

            $('#edit').on('submit', function (e) {
                $('#preloaderBlock').addClass('preloader-background');
                e.preventDefault();
                var data = {
                    adminID: $('.b' + index).attr('adminid'),
                    adminName: $('.adminnameedit').val(),
                    password: $('.passwordedit').val()
                };
                $.ajax({
                    url: '{{ route('adminEdit') }}',
                    type: 'post',
                    data: data,
                    success: function (d) {
                        $('#preloaderBlock').removeClass('preloader-background');
                        $('.a' + index).text($('.adminnameedit').val());
                        $('#modal2').modal('close');
                        Materialize.toast('Modify Success!', 4000);
                    }
                });
                return false;
            });

            $('.delete').on('click', function (e) {
                $('#preloaderBlock').addClass('preloader-background');
                var data = {
                    adminID: $('.b' + index).attr('adminid')
                };
                $.ajax({
                    url: '{{ route('adminDelete') }}',
                    type: 'post',
                    data: data,
                    success: function (d) {
                        $('.b' + index).remove();
                        $('#modal3').modal('close');
                        $('#preloaderBlock').removeClass('preloader-background');
                        Materialize.toast('Delete Success!', 4000);
                    }
                });
            });
        });
    </script>
</div>
    @stop