@extends('back.layouts.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Categories')
@section('content')



<div class="page-header d-print-none">
    <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              Categories & subcategories
            </h2>
          </div>
    </div>
</div>

@livewire('categories')

@endsection
@push('scripts')
<script>
    window.addEventListener('hide_category_modal', function(event){
        $('#categories_modal').modal('hide');
    });

    window.addEventListener('show_category_modal', function(event){
        $('#categories_modal').modal('show');
    });

    window.addEventListener('hide_subcategory_modal', function(event){
        $('#subcategories_modal').modal('hide');
    });

    window.addEventListener('show_subcategory_modal', function(event){
        $('#subcategories_modal').modal('show');
    });

    $('#categories_modal,#subcategories_modal').on('hidden.bs.modal', function(event){
        Livewire.emit('resetModalForms');
    });

</script>
<script>

    window.addEventListener('deleteCategory', function(event){
        swal.fire({
            title:event.detail.title,
            imageWith:48,
            imageHeight:48,
            html:event.detail.html,
            id:event.detail.id,
            showCloseButton:true,
            showCancelButton:true,
            cancelButtonText:'Cancel',
            confirmButtonText:'Yes, delete',
            cancelButtonColor : '#d33',
            confirmButtonColor:'#3085d6',
            width:300,
            allowOutsideClick:false,
        }).then(function(result){
            if(result.value)
            {
                window.livewire.emit('deleteCategoryAction', event.detail.id);
            }
        });
    });

    window.addEventListener('deleteSubcategory', function(event){
        swal.fire({
            title:event.detail.title,
            imageWith:48,
            imageHeight:48,
            html:event.detail.html,
            id:event.detail.id,
            showCloseButton:true,
            showCancelButton:true,
            cancelButtonText:'Cancel',
            confirmButtonText:'Yes, delete',
            cancelButtonColor : '#d33',
            confirmButtonColor:'#3085d6',
            width:300,
            allowOutsideClick:false,
        }).then(function(result){
            if(result.value)
            {
                window.livewire.emit('deleteSubcategoryAction', event.detail.id);
            }
        });
    });

    $('table tbody#sortable_category').sortable({
        update:function(event, ui){
            $(this).children().each(function(index){
                if($(this).attr('data-ordering') != (index+1)){
                    $(this).attr('data-ordering', (index+1)).addClass('updated');
                }
            });
            var positions = [];
            $('.updated').each(function(){
                positions.push([$(this).attr('data-index'), $(this).attr('data-ordering')]);
            });
            // alert(positions);
            window.livewire.emit('updateCategoryOrdering', positions);
        }
    });

    $('table tbody#sortable_subcategory').sortable({
        update:function(event, ui){
            $(this).children().each(function(index){
                if($(this).attr('data-ordering') != (index+1)){
                    $(this).attr('data-ordering', (index+1)).addClass('updated');
                }
            });
            var positions = [];
            $('.updated').each(function(){
                positions.push([$(this).attr('data-index'), $(this).attr('data-ordering')]);
            });
            // alert(positions);
            window.livewire.emit('updateSubCategoryOrdering', positions);
        }
    });
</script>

@endpush
