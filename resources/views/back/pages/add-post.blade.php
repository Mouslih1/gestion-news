@extends('back.layouts.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Add new post')
@section('content')


<div class="page-header d-print-none">
    <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              Add new post
            </h2>
          </div>
    </div>
</div>
<form action="{{ route('author.posts.create') }}" id='addPostForm' method="post" enctype="multipart/form-data">
    @csrf
    <div class="card mt-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label class="form-label">Post title</label>
                        <input type="text" class="form-control" name="post_title" placeholder="Enter your post title">
                         <span class="text-danger error-text post_title_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Post content</label>
                        <textarea class="ckeditor form-control" id="post_content" name="post_content" rows="6" placeholder="Content.."></textarea>
                        <span class="text-danger error-text post_content_error"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <div class="form-label">Post categories</div>
                        <select class="form-control" name="post_category">
                          <option value="">No selected</option>
                          @foreach (App\Models\Subcategory::all() as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger error-text post_category_error"></span>
                      </div>
                      <div class="mb-3">
                        <div class="form-label">Featured image</div>
                        <input type="file" class="form-control" name="featured_image">
                        <span class="text-danger error-text featured_image_error"></span>
                      </div>
                      <div class="image-holder mb-3" style="max-width:250px">
                        <img src="" alt="" class="img-thumbnail" id="image-previewer" data-ijabo-default-img=''>
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">Post tags</label>
                        <input type="text" class="form-control" name="post_tags">
                      </div>
                      <button type="submit" class="btn btn-primary">Save post</button>
                </div>
            </div>
            </div>
    </div>
</form>
@endsection
@push('scripts')
<script src="/ckeditor/ckeditor.js"></script>
<script>
    $(function()
    {
        $('input[type="file"][name="featured_image"]').ijaboViewer({
            preview:'#image-previewer',
            imageShape:'rectangular',
            allowedExtensions:['jpg', 'jpeg','png'],
            onSuccess:function(message, element){

            },
            onInvalidType:function(message, element){
                alert(message);
            },
            onErrorShape:function(message, element){
                alert(message);
            }
        });


        $('form#addPostForm').on('submit', function(e){
            e.preventDefault();
            toastr.remove();
            var post_content = CKEDITOR.instances.post_content.getData();
            var form = this;
            var formdata = new FormData(form);
                formdata.append('post_content', post_content);
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:formdata,
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(response)
                {
                    toastr.remove();
                    if(response.code == 1)
                    {
                        $(form)[0].reset();
                        $('div.image_holder').html('');
                        CKEDITOR.instances.post_content.setData('');
                        $('input[name="post_tags"]').amsifySuggestags();
                        toastr.success(response.msg);
                    }else{
                        toastr.error(response.msg);
                    }
                },
                error:function(response){
                    toastr.remove();
                    $.each(response.responseJSON.errors, function(prefix, val){
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }
            });
        });


    });
</script>

@endpush
