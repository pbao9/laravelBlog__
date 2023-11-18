<div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="" class="form-label">Tim kiem</label>
            <input type="text" class="form-control" placeholder="Tu khoa...." wire:model="search">
        </div>
        <div class="col-md-3 mb-3">
            <label for="" class="form-label">Danh muc</label>
            <select name="" id="" class="form-select">
                <option value="">-- Trong --</option>
                @foreach (\App\Models\SubCategory::whereHas('posts')->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->subcategory_name }}</option>
                @endforeach
            </select>
        </div>
        @if (auth()->user()->type == 1)
            <div class="col-md-3 mb-3">
                <label for="" class="form-label">Tac gia</label>
                <select name="" id="" class="form-select">
                    <option value="">-- Trong --</option>
                    @foreach (\App\Models\User::whereHas('posts')->get() as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="col-md-3 mb-3">
            <label for="" class="form-label">Sap xep</label>
            <select name="" id="" class="form-select" wire:model="orderBy">
                <option value="asc">Tang dan</option>
                <option value="desc">Giam dan</option>
            </select>
        </div>

    </div>

    <div class="row row-cards">
        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <img src="/storage/images/post_images/thumbnail/resized_{{ $post->featured_image }}" alt=""
                        class="card-img-top">
                    <div class="card-body p-2">
                        <h3 class="m-0 mb-1">{{ $post->post_title }}</h3>
                    </div>
                    <div class="d-flex">
                        <a href="" class="card-btn">Edit</a>
                        <a href="" class="card-btn">Delete</a>
                    </div>
                </div>
            </div>
        @empty
            <span class="text-danger">Khong co bai viet</span>
        @endforelse
    </div>

    <div class="d-block mt-2">
        {{ $posts->links('livewire::simple-bootstrap') }}
    </div>
</div>
