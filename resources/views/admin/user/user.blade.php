@extends('layout.sidebarAdmin')
@section('section')
    <div class="row">

        <div class="row">
            <a href="#modal2" class="waves-effect waves-light btn"><i class="material-icons left">add</i>add user</a>
        </div>
        <div class="row">
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $i=>$value)
                    <tr userid="{{ $value->userID }}" class="c{{ $i+1 }}">
                        <td>{{ $i+1 }}</td>
                        <td class="a{{ $i+1 }}">{{ $value->username }}</td>
                        <td><a class='dropdown-button btn' href='#' data-activates='dropdown{{ $i+1 }}'>Edit</a>
                            <ul id='dropdown{{ $i+1 }}' class='dropdown-content'>
                                <li><a href="#modal1" ind="{{ $i+1 }}"><i class="material-icons">edit</i>Modify</a></li>
                                <li><a href="#modal3" ind="{{ $i+1 }}"><i class="material-icons">delete</i>Delete</a></li>
                            </ul></td>
                         </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="modal1" class="modal ">
            <form action="" id="edit">
                <div class="modal-content">
                    <div class="row">
                        <input type="hidden" name="userID" class="userid">
                        <div class="input-field col s6">
                            <input id="" value="" type="text" class="validate username" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="" value="" type="text" class="validate password" required>
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="waves-effect waves-light  btn-flat " type="submit" name="action">edit</button>
                </div>
            </form>
        </div>

        <div id="modal2" class="modal ">
            <form action="" method="post" id="add">
                <div class="modal-content">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="" value="" type="text" class="validate addusername" name="username" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="" value="" type="text" class="validate addpassword" name="password" required>
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{--<input class="modal-action modal-close waves-effect waves-green btn-flat" value="Add" type="submit">--}}
                    <button class="waves-effect waves-light  btn-flat " type="submit" name="action">add</button>
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
            $(document).ready(function () {
                $('.dropdown-button').dropdown({
                        constrainWidth: false
                    }
                );
                        @if ($errors->any())
                         Materialize.toast(' {{ $errors->first('password') }}', 4000);
                        @endif
                var index = 0;
                $('#modal1').modal({
                    ready: function(modal, trigger){
                        index = trigger.attr('ind');
                        $('.userid').val($('.c' + trigger.attr('ind')).attr('userid'));
                        $('.username').val($('.a' + trigger.attr('ind')).text());
//                        $('.password').val($('.b' + trigger.attr('ind')).text());
                        Materialize.updateTextFields();
                    }
                });
                $('#modal2').modal();
                $('#modal3').modal({
                    ready: function (modal, trigger) {
                        index = trigger.attr('ind');
                        $('.delete').attr('deleteid', $('.c' + trigger.attr('ind')).attr('userid'));
                    }
                });

                $('#edit').on('submit', function (e) {
                    checkPreloader(true);
                    e.preventDefault();
                   var data = {
                       userID: $('.userid').val(),
                       username: $('.username').val(),
                       password: $('.password').val()
                   } ;
                   $.ajax({
                       url: '{{ route('userEditAdminP') }} ',
                       type: 'post',
                       data: data,
                       success: function () {
                           checkPreloader(false);
                           $('.a'+index).text($('.username').val());
                           Materialize.toast('Edit Success!', 4000);
                       }
                   });
                   $('#modal1').modal('close');
                   return false;
                });

                $('#add').on('submit', function (e) {
                    checkPreloader(true);
                   e.preventDefault();
                    var data = {
                        username: $('.addusername').val(),
                        password: $('.addpassword').val()
                    }
                    $.ajax({
                        url:'{{ route('userAddAdmin') }}',
                        type:'post',
                        data:data,
                        success: function (data) {
                            checkPreloader(false);
                            Materialize.toast('Add Success!', 4000);
                        }
                    });
                    $('#modal2').modal('close');
                    return false;
                });

                $('.delete').on('click', function () {
                    checkPreloader(true);
                    var data = {
                        userID :$(this).attr('deleteid')
                    }
                    $.ajax({
                        url:'{{ route('userDeleteAdmin') }}',
                        type:'post',
                        data:data,
                        success: function (data) {
                            checkPreloader(false);
                            $('.c' + index).remove();
                            Materialize.toast('Delete Success!', 4000);
                        }
                    });
                });
            });
        </script>
    </div>
    @stop