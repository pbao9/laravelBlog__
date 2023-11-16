@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categories')
@section('content')


    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title">
                    Categories & Subcategories
                </div>
            </div>
        </div>
    </div>
    @livewire('categories')


@endsection

@push('scripts')
    <script>
        window.addEventListener('hideCategoriesModal', function(e) {
            $('#categories_modal').modal('hide');
        });
        window.addEventListener('showcategoriesModal', function(e) {
            $('#categories_modal').modal('show');
        });
        window.addEventListener('hideCategoriesModal', function(e) {
            $('#subcategories_modal').modal('hide');
        });
        window.addEventListener('showSubCategoriesModal', function(e) {
            $('#subcategories_modal').modal('show');
        });


        $('#categories_modal, #subcategories_modal').on('hidden.bs.modal', function(e) {
            Livewire.emit('resetModalForm');
        });
    </script>
@endpush
