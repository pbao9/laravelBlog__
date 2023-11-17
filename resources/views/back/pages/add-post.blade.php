@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Thêm bài viết')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Thêm bài viết mới
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('author.post.create') }}" method="post" id="addPostForm" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề bài viết</label>
                            <input type="text" class="form-control" name="post_title"
                                placeholder="Nhập tiêu đề bài viết">
                            <span class="text-danger error-text post_title_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung bài viết </label>
                            <textarea class="form-control" name="post_content" rows="6" placeholder="Nội dung">
                                
                            </textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="form-label">Danh mục</div>
                            <select class="form-select" name="post_category">
                                <option value="">Không có dữ liệu</option>
                                @foreach (\App\Models\SubCategory::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->subcategory_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text post_category_error"></span>
                        </div>

                        <div class="mb-3">
                            <div class="form-label">Featured image</div>
                            <input type="file" class="form-control" name="featured_image" id="input-file"
                                accept="image/jpeg, image/png, image/jpg" onchange="loadFile(event)">
                            <span class="text-danger error-text featured_image_error"></span>
                        </div>
                        <div class="image_holder mb-2" style="max-width:250px">
                            <img src="./back/dist/img/authors/default-img.png" alt="" class="img-thumbnail"
                                id="image-preview">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection


@push('scripts')
    <script>
        var loadFile = function(event) {
            var featured_image = document.getElementById('image-preview');
            featured_image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endpush
