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
            </tr>
            </thead>
            <tbody>
            @foreach($shop as $i=>$v)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $v->shopName }}</td>
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

    <script>
        $(document).ready(function () {
            $('#modal1').modal();

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

                    }
                });
            });
        });
    </script>
</div>
    @stop