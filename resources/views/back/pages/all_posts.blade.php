@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tat ca bai viet')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Tat ca bai viet
                    </h2>
                </div>
            </div>
        </div>
    </div>

    @livewire('all-posts')
@endsection
