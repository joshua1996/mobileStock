@extends('layout.sidebarAdmin')
@section('section')

    <div class="row">
        <div class="row">
            <a href="#modal2" class="waves-effect waves-light btn"><i class="material-icons left">add</i>add supply person</a>
        </div>
        <div class="row">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($supplyPerson as $i=>$value)
                    <tr class="b{{ $i+1 }}" supplypersonid="{{ $value->supplyID }}">
                        <td>{{ $i+1 }}</td>
                        <td class="a{{ $i+1 }}">{{ $value->name }}</td>
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
    </div>

    <div id="modal1" class="modal ">
        <form action="" id="edit" supplyid="">
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="" value=""  type="text" class="validate supplyPerson" required>
                        <label for="name">Supply Name</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-light  btn-flat " type="submit" name="action">edit</button>
            </div>
        </form>
    </div>

    <div id="modal2" class="modal ">
        <form action="" id="add">
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="" value=""  type="text" class="validate supplyPersonAdd" required>
                        <label for="name">Supply Name</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
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
            var index = 0;
            $('#modal1').modal({
                ready: function(modal, trigger){
                    index = trigger.attr('ind');
                    $('.supplyPerson').val($('.a'+ trigger.attr('ind')).text());
                    $('#edit').attr('supplyid', $('.b'+ trigger.attr('ind')).attr('supplypersonid'));
                    Materialize.updateTextFields();
                }
            });

            $('#modal2').modal();

            $('#modal3').modal({
                ready: function (modal, trigger) {
                    index = trigger.attr('ind');
                    console.log($('.b'+ trigger.attr('ind')).attr('supplypersonid'));
                    $('.delete').attr('deleteid', $('.b'+ trigger.attr('ind')).attr('supplypersonid'));
                }
            });

            $('#edit').on('submit', function (e) {
                checkPreloader(true);
                e.preventDefault();
                var data = {
                    supplyPerson : $('.supplyPerson').val(),
                    supplyID: $(this).attr('supplyid')
                };
                $.ajax({
                    url: '{{ route('supplyPersonEditAdmin') }}',
                    type: 'post',
                    data: data,
                    success: function () {
                        checkPreloader(false);
                        Materialize.toast('Edit Success!', 4000);
                        $('.a' + index).text($('.supplyPerson').val());
                    }
                });
                $('#modal1').modal('close');
                return false;
            });

            $('#add').on('submit', function (e) {
                checkPreloader(true);
                e.preventDefault();
                var data = {
                  supplyPerson:  $('.supplyPersonAdd').val()
                };
                $.ajax({
                    url: '{{ route('supplyPersonAddAdmin') }}',
                    type: 'post',
                    data: data,
                    success: function(){
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
                    supplyID :$(this).attr('deleteid')
                }
                $.ajax({
                    url:'{{ route('supplyPersonDeleteAdmin') }}',
                    type:'post',
                    data:data,
                    success: function (data) {
                        checkPreloader(false);
                        $('.b' + index).remove();
                        Materialize.toast('Delete Success!', 4000);
                    }
                });
            });
        });
    </script>
    @stop