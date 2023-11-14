<div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <h2>Categories</h2>
                        <li class="nav-item ms-auto">
                            <a href="" class="btn btn-sn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#categories_modal">Add Category</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Categoires Name</th>
                                    <th>N. of Subcategories</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->category_name }}</td>
                                        <td class="text-muted">
                                            {{ $category->subcategories->count() }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-primary"data-bs-toggle="modal"
                                                    data-bs-target="#categories_modal"
                                                    wire:click.prevent='editCategory({{ $category->id }})'>Chinh sua</a>
                                                <a href="#" class="btn btn-sm btn-danger">Xoa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"><span class="text-danger">Khong co danh muc de hien
                                                thi</span></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <h2>SubCategories</h2>
                        <li class="nav-item ms-auto">
                            <a href="" class="btn btn-sn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#subcategories_modal">Add SubCategory</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>SubCategoires Name</th>
                                    <th>Parent Category</th>
                                    <th>N. of post</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>any name</td>
                                    <td class="text-muted">any name</td>
                                    <td>4</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="categories_modal" tabindex="-1" role="dialog"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST"
                @if ($updateCategoryMode) wire:submit.prevent='updateCategory()'
            @else
            wire:submit.prevent='addCategory' @endif>
                <div class="modal-header">
                    <h5 class="modal-title">{{ $updateCategoryMode ? 'Update Category' : 'Add Category' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($updateCategoryMode)
                        <input type="hidden" wire:model='selected_category_id'>
                    @else
                    @endif
                    <div class="mb-3">
                        <label for="" class="form-label">Category name</label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Enter category name" wire:model='category_name'>
                        <span class="text-danger">
                            @error('category_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto">Close</button>
                    <button type="submit"
                        class="btn btn-primary">{{ $updateCategoryMode ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>


    <div class="modal modal-blur fade" id="subcategories_modal" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add SubCategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-label">Parent Category</div>
                        <select name="" id="" class="form-select">
                            <option value="1">one</option>
                            <option value="2">two</option>
                            <option value="3">three</option>
                            <option value="4">four</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">SubCategory name</label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Enter category name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('show-toast', function(data) {
            Toastify({
                text: data.message,
                duration: 3000,
                gravity: 'top',
                position: 'right',
                stopOnFocus: true,
                backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
                className: 'info',
            }).showToast();
        });
    });
</script>
