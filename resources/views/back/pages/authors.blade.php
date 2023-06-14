@extends('back.layouts.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Authors')
@section('content')

    @livewire('authors')

@endsection

@push('scripts')
<script>
    $(window).on('hidden.bs.modal', function(){
        Livewire.emit('resetForms');
    });

    window.addEventListener("hide_add_author_modal", function(event){
        $("#new_author_modal").modal("hide");
    })

    window.addEventListener("show_edit_author_modal", function(event){
        $("#edit_author_modal").modal("show");
    })

    window.addEventListener("hide_edit_author_modal", function(event){
        $("#edit_author_modal").modal("hide");
    })




    window.addEventListener('deleteAuthor', function(event){
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
                Livewire.emit('deleteAuthorAction', event.detail.id);
            }
        });
    });
</script>

@endpush
