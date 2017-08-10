@extends('layout.sidebarAdmin')
@section('section')
    <div class="row">
        <style>
            td{
                padding: 1px 0px;
            }
        </style>
        <div class="row">
            <div class="input-field col s12">
                <select id="userselect">
                    <option value="" disabled selected>Choose your option</option>
                    @foreach($user as $i=>$value)
                        <option value="{{ $value->userID }}">{{ $value->username }}</option>
                        @endforeach

                </select>
                <label>User Select</label>
            </div>
        </div>

        <div class="row">
            <a class="btn disabled add modal-trigger" href="#modal3"><i class="material-icons left">add</i>Add Staff</a>
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
            <form action="" id="edit">
                <div class="modal-content">
                    <div class="row">
                        <input type="hidden" value="" class="staffid">
                        <div class="input-field col s12">
                            <input id="" type="text" class="validate staffname" required>
                            <label for="Name">Name</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="waves-effect waves-light  btn-flat " type="submit" name="action">edit</button>
                </div>
            </form>
        </div>

        <div id="modal2" class="modal">
            <div class="modal-content">
                <div class="row">
                   Delete?
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat delete" staffid="">Ok</a>
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
            </div>
        </div>

        <div id="modal3" class="modal">
            <form action="" id="add">
                <div class="modal-content">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="" type="text" class="validate staffnameadd" required>
                            <label for="Name">Name</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="waves-effect waves-light  btn-flat " type="submit" name="action">add</button>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function() {
                var index = 0;
                $('#userselect').material_select();
                $('#modal1').modal({
                    ready: function(modal, trigger){
                        index = trigger.attr('ind');
                        $('.staffname').val($('.a' + trigger.attr('ind')).text());
                        $('.staffid').val($('.b' + trigger.attr('ind')).attr('staffid'));
                        Materialize.updateTextFields();
                    }
                });

                $('#modal2').modal({
                    ready: function(modal, trigger){
                        index = trigger.attr('ind');
                        $('.delete').attr('staffid', $('.b' + trigger.attr('ind')).attr('staffid'));
                    }
                });

                $('#modal3').modal();

                $('#userselect').on('change', function () {
                    checkPreloader(true);
                    var data= {
                        userid: $(this).val()
                    };
                   $.ajax({
                       url: '{{ route('staffSelectAdmin') }}',
                       type: 'post',
                       data: data,
                       success: function (data) {
                           checkPreloader(false);
                           console.log(data.staff.length);
                           $('.userlist').empty();
                           $.each(data.staff, function (i, v) {
                               $('.userlist').append('<tr class="b'+(i+1)+'" staffid="'+ v.staffID +'"> <td>'+(i+1)+'</td><td class="a'+ (i+1) +'">'+(v.name)+'</td> <td><a class="dropdown-button btn" href="#" data-activates="dropdown'+(i+1)+'">Edit</a> <ul id="dropdown'+(i+1)+'" class="dropdown-content"> <li><a href="#modal1" ind="'+(i+1)+'"><i class="material-icons">edit</i>Modify</a></li> <li><a href="#modal2" ind="'+(i+1)+'"><i class="material-icons">delete</i>Delete</a></li> </ul></td></tr>');
                           });
                           $('.add').removeClass('disabled').addClass('waves-effect waves-light"');
                           $('.dropdown-button').dropdown({
                                   constrainWidth: false
                               }
                           );
                       }
                   });
                });

                $('#edit').on('submit', function (e) {
                    checkPreloader(true);
                    e.preventDefault();
                   var data = {
                       staffID: $('.staffid').val(),
                       name: $('.staffname').val()
                   } ;
                   $.ajax({
                       url: '{{ route('staffEditAdmin') }}',
                       type: 'post',
                       data: data,
                       success: function (data) {
                           checkPreloader(false);
                           $('.a' + index).text($('.staffname').val());
                           Materialize.toast('Edit Success!', 4000);
                       }
                   });
                   $('#modal1').modal('close');
                   return false;
                });
                
                $('.delete').on('click', function () {
                    checkPreloader(true);
                   var data = {
                       staffid: $(this).attr('staffid')
                   } ;
                   $.ajax({
                       url:  '{{ route('staffDeleteAdmin') }}',
                       type: 'post',
                       data: data,
                       success: function (data) {
                           checkPreloader(false);
                           $('.b' + index).remove();
                           Materialize.toast('Delete Success!', 4000);
                       }
                   });
                });

                $('#add').on('submit', function (e) {
                    checkPreloader(true);
                    e.preventDefault();
                    var data = {
                        staffid: $('.staffnameadd').val(),
                        userid: $('#userselect').val()
                    } ;
                    $.ajax({
                        url:  '{{ route('staffAddAdmin') }}',
                        type: 'post',
                        data: data,
                        success: function (data) {
                            checkPreloader(false);
                            Materialize.toast('Add Success!', 4000);
                        }
                    });
                    $('#modal3').modal('close');
                    return false;
                });
            });
        </script>
    </div>
    @stop