<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class Categories extends Component
{


    public $category_name;
    public $selected_category_id;
    public $updateCategoryMode = false;


    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,category_name,'
        ]);

        $category = new Category();
        $category->category_name = $this->category_name;
        $saved = $category->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideCategoriesModal');
            $this->category_name = null;
            $this->emit('show-toast', ['message' => 'Da them moi danh muc thanh cong!']);
        } else {
            $this->emit('show-toast', ['message' => 'Da xay ra loi!']);
        }
    }


    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showcategoriesModal');
    }

    public function updateCategory()
    {
        if ($this->selected_category_id) {
            $this->validate([
                'category_name' => 'required|unique:categories,category_name,' . $this->selected_category_id,
            ]);

            $category = Category::findOrFail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $updated = $category->save();


            if ($updated) {
                $this->dispatchBrowserEvent('hideCategoriesModal');
                $this->updateCategoryMode = false;
                $this->emit('show-toast', ['message' => 'Da cap nhat thanh cong!']);
            } else {
                $this->emit('show-toast', ['message' => 'Da xay ra loi!']);
            }
        }
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('ordering', 'asc')->get(),
        ]);
    }
}
