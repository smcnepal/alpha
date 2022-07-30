@extends('template.layout')
@section('title','ajax image upload')
@section('content')
<form method="POST" enctype="multipart/form-data" id="image-upload" action="javascript:void(0)" >
    @csrf
    <div class="row">
    <div class="col-md-12">
    <div class="form-group">
    <input type="file" name="image" multiple placeholder="Choose image" id="image">
    </div>
    </div>
    <div class="col-md-12 mb-2">
    <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
    alt="preview image" style="max-height: 250px;">
    </div>
    <div class="col-md-12">
    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
    </div>
    </div>     
    </form>
@endsection

@section('custom-script')
<script type="text/javascript">
    $(document).ready(function (e) {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    
    });
    $('#image').change(function(){
    let reader = new FileReader();
    reader.onload = (e) => { 
    $('#preview-image-before-upload').attr('src', e.target.result); 
    }
    reader.readAsDataURL(this.files[0]); 
    });
    $('#image-upload').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    type:'POST',
    url: "{{ url('ajax-image-upload2')}}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => {
    this.reset();
    alert('Image has been uploaded using jQuery ajax successfully');
    },
    error: function(data){
    console.log(data);
    }
    });
    });
    });
    </script>
@endsection