@extends('template.layout')
@section('title','ajax image upload')
@section('content')
<form action="{{ url('ajax-image-upload') }}" enctype="multipart/form-data" method="POST">


    <div class="alert alert-danger print-error-msg" style="display:none">

        <ul></ul>

    </div>


    <input type="hidden" name="_token" value="{{ csrf_token() }}">


    <div class="form-group">

      <label>Alt Title:</label>

      <input type="text" name="title" class="form-control" placeholder="Add Title">

    </div>


    <div class="form-group">

      <label>Image:</label>

      <input type="file" name="image" class="form-control">

    </div>


    <div class="form-group">

      <button class="btn btn-success upload-image" type="submit">Upload Image</button>

    </div>


  </form>
@endsection

@section('custom-script')
<script type="text/javascript">

    $("body").on("click",".upload-image",function(e){
  
      $(this).parents("form").ajaxForm(options);
  
    });
  
  
    var options = { 
  
      complete: function(response) 
  
      {
  
          if($.isEmptyObject(response.responseJSON.error)){
  
              $("input[name='title']").val('');
  
              alert('Image Upload Successfully.');
  
          }else{
  
              printErrorMsg(response.responseJSON.error);
  
          }
  
      }
  
    };
  
  
    function printErrorMsg (msg) {
  
      $(".print-error-msg").find("ul").html('');
  
      $(".print-error-msg").css('display','block');
  
      $.each( msg, function( key, value ) {
  
          $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
  
      });
  
    }
  
  </script> 
@endsection