@extends('layouts.app')

@section('css')
<link href="{{ asset('js/plugins/datepicker/daterangepicker.css') }}" rel="stylesheet">
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.p-t-30{
    padding-top: 50px !important;
}

h3{
    margin-bottom: 2%;
}
.create-btn{
    height: 40px!important;
    line-height: 0px !important;
    padding: 0 10px !important;
    font-size: 14px !important;
}
.daterangepicker select.yearselect {
    width: 46%;
}
.edit {
    margin: 0% 21% 0% 28%;
    font-size: 17px;
}
.delete{
    /* margin: 0% 21% 0% 28%; */
    font-size: 17px;
}
</style>

@stop

@section('content')



<div class="page-wrapper p-t-30 p-b-100 font-poppins">
    <div class="wrapper wrapper--w700">
        <div class="card card-6">
            <div class="card-body">
                <h3 style="float: left">Events List</h1>
                <button type="button" class="btn btn-primary create-btn pull-right add-new" data-toggle="modal" data-target="#myModal">Add New</button>
                <table class="table table-bordered" id="event-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="width: 550px;">
        <div class="modal-header">
          <h4 class="modal-title" style="width: 80%;">Events</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        {{ Form::open(array('url'=> '#','id'=>'form','class'=>'', 'method'=> 'POST')) }}
        {{ Form::hidden('id',null) }}
            <div class="modal-body">
                <div class="input-group form-group" id="name">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" id="">
                    <small class="help-block"></small>
                </div>
                <div class="form-group input-group" id="start_date">
                    <label for="start_date">Start Date:</label>
                    <input class="form-control js-datepicker" type="" name="start_date" >
                    <small class="help-block"></small>
                </div>
                <div class="form-group input-group" id="end_date">
                    <label for="end_date">End Date:</label>
                    <input class="form-control js-datepicker" type="" name="end_date" >
                    <small class="help-block"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }}
      </div>

    </div>
  </div>



@stop

  @section('scripts')

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="  https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>

$(function () {

    $.fn.dataTable.ext.errMode = 'throw';
    try {
        table = $('#event-table').DataTable({
            ajax: {
                "url": "{{ route('user.events') }}",
                "error": function (xhr, textStatus, thrownError) {
                    if (xhr.status === 401) {
                        window.location = "{{ route('login') }}";
                    }
                }
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: '',
                    sortable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data:'start_date',
                    name:'start_date'
                },
                {
                    data: 'end_date',
                    name: 'raend_datete'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: null,
                    orderable: false,
                    render: function (o) {
                        var actions = "";
                        actions += '<a href="#" class="edit fa fa-edit" data-id=' + o.id + '></a>'
                        actions += '<a href="#" class="delete fa fa-trash" data-id=' +o.id + '></a>';
                        return actions;
                    },
                }
            ]
        });
    } catch (e) {
        console.log(e.stack);
    }
    // On modal click
    $('.add-new').click(function(){
        $("#form")[0].reset();
        $('#myModal input[name="id"]').val('');
        $('#form').find('.form-group').removeClass('has-error').find('.help-block').text('');
        $('#myModal .modal-title').text("Create Event")
    });

     // Form submit
     $('#form').submit(function (e) {
        e.preventDefault();
        if($('#form input[name="id"]').val()){
            var message = 'Event has been updated successfully';
        }else{
            var message = 'Event has been created successfully';
        }
        formSubmit($('#form'), "{{ route('event.store') }}", table, e, message,true,"{{ route('event.page') }}");
    });

    // Edit
    $("#event-table").on("click", ".edit", function (e) {
        id = $(this).data('id');
        var url = '{{ route("event.single",":id") }}';
        var url = url.replace(':id', id);
        $('#form').find('.form-group').removeClass('has-error').find('.help-block').text('');
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                if (data) {
                    console.log('data', data);
                    $(".add-new").trigger( "click" );
                    $('#form input[name="id"]').val(data.id);
                    $('#form input[name="name"]').val(data.name);
                    $('#form input[name="start_date"]').val(data.start_date);
                    $('#form input[name="end_date"]').val(data.end_date);
                    $('#myModal .modal-title').text("Edit Event: " + data.name)
                } else {
                    console.log(data);
                    swal("Oops", "Edit was unsuccessful", "warning");
                }
            },
            error: function (xhr, textStatus, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                swal("Oops", "Something went wrong", "warning");
            },
            contentType: false,
            processData: false,
        });
    });

    /// Delete
    $('#event-table').on('click', '.delete', function (e) {
        var id = $(this).data('id');
        var base_url = "{{ route('event.destroy',':id') }}";
        var url = base_url.replace(':id', id);
        var message = 'Event has been deleted successfully';
        deleteServiceRecord(url, table, message);
    });

});

function deleteServiceRecord(url, table, message) {
        var url = url;
        var table = table;

        swal({
            title: "Are you sure?",
            text: "You will not be able to undo this action. Proceed?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.success) {
                        swal("Deleted", message, "success");
                        if (table != null) {
                            table.ajax.reload();
                        }
                    } else if (data.success == false) {
                        if (Object.prototype.hasOwnProperty.call(data, 'message') && data.message) {
                            swal("Warning", data.message, "warning");
                        } else {
                            swal("Warning", 'Data exists', "warning");
                        }
                    } else if (data.warning == true) {
                        swal("Warning",data.message, "warning");
                    } else {
                        console.log(data);
                    }
                },
                error: function (xhr, textStatus, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                },
                contentType: false,
                processData: false,
            });

            } else {
                // swal("Your imaginary file is safe!");
            }
        });

    }

</script>


  @stop
