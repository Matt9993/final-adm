@extends('layouts.app')
 
@section('content')
<br>
<div class="container box">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Új Hír létrehozása</div>

                <div class="panel-body">
                  <form action="/submit-post" method="post" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="title">Cím</label>
                          <input type="text" class="form-control" id="title" name="title" placeholder="Cím" value="{{ old('title') }}">
                          @if($errors->has('title'))
                              <span class="help-block">{{ $errors->first('title') }}</span>
                          @endif
                      </div>

                      <div class="form-group">
                        <label for="albumPic">Indexkép</label>
                        <input type="file" name="filename" class="form-control" id="indexPic">
                      </div>

                      <textarea id="description" name="content" class="form-control my-editor"></textarea>
                      <br><br>
                      <button type="submit" class="btn btn-primary">Mentés</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

 
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>

<script>

  tinymce.init({
    path_absolute : "/",
    selector: "textarea.my-editor",
    mode : "exact",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = '/laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  });
</script>
@endsection