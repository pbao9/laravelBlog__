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
