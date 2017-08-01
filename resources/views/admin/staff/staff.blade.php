@extends('layout.sidebarAdmin')
@section('section')
    <div class="row">
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
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody class="userlist">
                </tbody>
            </table>
        </div>

        <div id="modal1" class="modal">
            <div class="modal-content">
               <div class="row">
                   <input type="hidden" value="" class="staffid">
                   <div class="input-field col s12">
                       <input id="" type="text" class="validate staffname">
                       <label for="Name">Name</label>
                   </div>
               </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat edit">Edit</a>
            </div>
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
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="" type="text" class="validate staffnameadd">
                        <label for="Name">Name</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat staffadd" staffid="">add</a>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var index = 0;
                $('#userselect').material_select();
                $('.modal').modal();
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

                $('#userselect').on('change', function () {
                    var data= {
                        userid: $(this).val()
                    };
                   $.ajax({
                       url: '{{ route('staffSelectAdmin') }}',
                       type: 'post',
                       data: data,
                       success: function (data) {
                           console.log(data.staff.length);
                           $('.userlist').empty();
                           $.each(data.staff, function (i, v) {
                               $('.userlist').append('<tr class="b'+(i+1)+'" staffid="'+ v.staffID +'"> <td>'+(i+1)+'</td><td class="a'+ (i+1) +'">'+(v.name)+'</td><td><a class="waves-effect waves-light btn modal-trigger" href="#modal1" ind="'+(i+1)+'"><i class="material-icons left">edit</i>Edit</a></td><td><a class="waves-effect waves-light btn modal-trigger" href="#modal2" ind="'+(i+1)+'"><i class="material-icons left">delete</i>Delete</a></td></tr>');
                           });
                           $('.add').removeClass('disabled').addClass('waves-effect waves-light"');
                       }
                   });
                });

                $('.edit').on('click', function () {
                   var data = {
                       staffID: $('.staffid').val(),
                       name: $('.staffname').val()
                   } ;
                   $.ajax({
                       url: '{{ route('staffEditAdmin') }}',
                       type: 'post',
                       data: data,
                       success: function (data) {
                           $('.a' + index).text($('.staffname').val());
                           Materialize.toast('Edit Success!', 4000);
                       }
                   });
                });
                
                $('.delete').on('click', function () {
                   var data = {
                       staffid: $(this).attr('staffid')
                   } ;
                   $.ajax({
                       url:  '{{ route('staffDeleteAdmin') }}',
                       type: 'post',
                       data: data,
                       success: function (data) {
                           $('.b' + index).remove();
                           Materialize.toast('Delete Success!', 4000);
                       }
                   });
                });

                $('.staffadd').on('click', function () {
                    var data = {
                        staffid: $('.staffnameadd').val(),
                        userid: $('#userselect').val()
                    } ;
                    $.ajax({
                        url:  '{{ route('staffAddAdmin') }}',
                        type: 'post',
                        data: data,
                        success: function (data) {
                            $('.b' + index).remove();
                            Materialize.toast('Add Success!', 4000);
                        }
                    });
                });
            });
        </script>
    </div>
    @stop