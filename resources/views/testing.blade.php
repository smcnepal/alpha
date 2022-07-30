@extends('template.layout')
@section('title','ajax form upload testing')
@section('content')
<div class="card mt-4">
    <div class="card-header">
      Featured
    </div>
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>
     
      {{-- <form action="" method="POST" enctype="multipart/form-data">
        <input class="form-control form-control-sm" type="text" name="photos" id="photos" multiple>
        <input type="button" class="btn btn-primary btn-sm mt-3" id="submit-file" value="submit">
      </form> --}}
      <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>
    <div class="alert alert-success print-success-msg" style="display:none"></div>

      <form>

        {{ csrf_field() }}

        <div class="form-group">

            <label>First Name:</label>

            <input type="text" name="first_name" class="form-control" placeholder="First Name">

        </div>

       

        <div class="form-group">

            <label>Last Name:</label>

            <input type="text" name="last_name" class="form-control" placeholder="Last Name">

        </div>

       

        <div class="form-group">

            <strong>Email:</strong>

            <input type="text" name="email" class="form-control" placeholder="Email">

        </div>

       

        <div class="form-group">

            <strong>Address:</strong>

            <textarea class="form-control" name="address" placeholder="Address"></textarea>

        </div>

       

        <div class="form-group">

            <button class="btn btn-success btn-submit">Submit</button>

        </div>

    </form>
    </div>
  </div>
</div>
@endsection

@section('custom-script')
<script>

$(document).ready(function() {

$(".btn-submit").click(function(e){

    e.preventDefault();



    var _token = $("input[name='_token']").val();

    var first_name = $("input[name='first_name']").val();

    var last_name = $("input[name='last_name']").val();

    var email = $("input[name='email']").val();

    var address = $("textarea[name='address']").val();



    $.ajax({

        url: "{{ url('ajax-test') }}",

        type:'POST',

        data: {_token:_token, first_name:first_name, last_name:last_name, email:email, address:address},

        success: function(data) {

            if($.isEmptyObject(data.error)){

                // alert(data.success);
                printSuccessMsg(data.success);

            }else{

                printErrorMsg(data.error);

            }

        }

    });



}); 

function printSuccessMsg(msg){
    $(".print-error-msg").css('display','none');
    $(".print-success-msg").css('display','block');
    $('.print-success-msg').html('');
    $('.print-success-msg').html(msg);
}

function printErrorMsg (msg) {

    $(".print-error-msg").find("ul").html('');
    $(".print-success-msg").css('display','none');
    $(".print-error-msg").css('display','block');

    $.each( msg, function( key, value ) {

        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

    });

}

});


</script>
@endsection
