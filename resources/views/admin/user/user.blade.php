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
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $i=>$value)
                    <tr userid="{{ $value->userID }}" class="c{{ $i+1 }}">
                        <td>{{ $i+1 }}</td>
                        <td class="a{{ $i+1 }}">{{ $value->username }}</td>
                        <td><a class="waves-effect waves-light btn" href="#modal1" ind="{{ $i + 1 }}"><i class="material-icons left">edit</i>edit</a></td>
                        <td><a class="waves-effect waves-light btn " ind="{{ $i + 1 }}" href="#modal3"><i class="material-icons left">delete</i>delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="modal1" class="modal ">
            <div class="modal-content">
                <div class="row">
                    <input type="hidden" name="userID" class="userid">
                    <div class="input-field col s6">
                        <input id="" value="" type="text" class="validate username">
                        <label for="username">Username</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="" value="" type="text" class="validate password">
                        <label for="password">Password</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat edit">EDIT</a>
            </div>
        </div>

        <div id="modal2" class="modal ">
            <form action="{{ route('userAddAdmin') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="" value="" type="text" class="validate" name="username">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="" value="" type="text" class="validate" name="password">
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="modal-action modal-close waves-effect waves-green btn-flat" value="Add" type="submit">
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

                $('.edit').on('click', function () {
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
                           Materialize.toast('Edit Success!', 4000);
                       }
                   });
                });

                $('.delete').on('click', function () {
                    var data = {
                        userID :$(this).attr('deleteid')
                    }
                    $.ajax({
                        url:'{{ route('userDeleteAdmin') }}',
                        type:'post',
                        data:data,
                        success: function (data) {
                            $('.c' + index).remove();
                            Materialize.toast('Delete Success!', 4000);
                        }
                    });
                });
            });
        </script>
    </div>
    @stop