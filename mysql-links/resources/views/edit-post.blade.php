@extends('layouts.app')
 
@section('content')
<div class="container box">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Hír szerkesztése</div>

                <div class="panel-body">
                  <form action="/update-post" method="post" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="title">Cím</label>
                          <input type="text" class="form-control" id="title" name="title" placeholder="Cím" value="{{ $title }}">
                          @if($errors->has('title'))
                              <span class="help-block">{{ $errors->first('title') }}</span>
                          @endif
                      </div>

                      <div class="form-group">
                        <label for="albumPic">Mostani Indexkép</label>
                        <img src="{{ URL::asset($path . '/' . $indexPic) }}" width="100" height="69">
                      </div>

                      <div class="form-group">
                        <label for="albumPic">Új Indexkép (régi lecserélése)</label>
                        <input type="file" name="filename" class="form-control" id="indexPic">
                      </div>

                      <textarea id="description" name="content" class="form-control my-editor">{{ $content }}</textarea>
                      <input type="hidden" value="{{$postId}}" id="title" name="id" /><br>
                      <button type="submit" class="btn btn-primary">Mentés</button>
                  </form>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>

 
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
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

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
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
  };

  tinymce.init(editor_config);
</script>
@endsection