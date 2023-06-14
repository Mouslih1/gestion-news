<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $category_name;
    public $selected_category_id;
    public $update_category_mode = false;

    public $subcategory_name;
    public $parent_category = 0;
    public $selected_subcategory_id;
    public $update_subcategory_mode = false;

    protected $listeners = [
        'resetModalForms',
        'deleteCategoryAction',
        'deleteSubcategoryAction',
        'updateCategoryOrdering',
        'updateSubCategoryOrdering'
    ];

    public function resetModalForms()
    {
        $this->resetErrorBag();
        $this->category_name = $this->subcategory_name = $this->parent_category = null;
    }

    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);

        $category = new Category();
        $category->category_name = $this->category_name;
        $saved = $category->save();

        if($saved)
        {
            $this->dispatchBrowserEvent('hide_category_modal');
            $this->category_name = null;
            $this->showToastr('New category has been successfully added', 'success');
        }else{
            $this->showToastr('Something went wrong', 'error');
        }
    }

    public function addSubcategory()
    {
        $this->validate([
            'subcategory_name' => 'required|unique:subcategories,subcategory_name',
            'parent_category' => 'required'
        ]);

        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $this->subcategory_name;
        $subcategory->slug = Str::slug($this->subcategory_name);
        $subcategory->parent_category = $this->parent_category;
        $saved = $subcategory->save();

        if($saved)
        {
            $this->dispatchBrowserEvent('hide_subcategory_modal');
            $this->subcategory_name = $this->parent_category = null;
            $this->showToastr('New Subcategory has been successfully added','success');
        }else{
            $this->showToastr('Something went wrong', 'error');
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->update_category_mode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('show_category_modal');
    }

    public function editSubcategory($id)
    {

        $subcategory = Subcategory::findOrFail($id);
        $this->selected_subcategory_id = $subcategory->id;
        $this->subcategory_name = $subcategory->subcategory_name;
        $this->parent_category = $subcategory->parent_category;
        $this->update_subcategory_mode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('show_subcategory_modal');
    }

    public function updateCategory()
    {
        if($this->selected_category_id)
        {
            $this->validate([
                'category_name' => 'required|unique:categories,category_name,'.$this->selected_category_id,
            ]);

            $category = Category::findOrFail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $updated = $category->save();

            if($updated)
            {
                $this->dispatchBrowserEvent('hide_category_modal');
                $this->update_category_mode = false;
                $this->showToastr('Category has been successfully updated', 'success');
            }else{
                $this->showToastr('Something went wrong', 'error');
            }
        }
    }

    public function updateSubcategory()
    {
        if($this->selected_subcategory_id)
        {
            $this->validate([
                'subcategory_name' => 'required|unique:subcategories,subcategory_name,'.$this->selected_subcategory_id,
                'parent_category' => 'required'
            ]);

            $subcategory = Subcategory::findOrFail($this->selected_subcategory_id);
            $subcategory->subcategory_name = $this->subcategory_name;
            $subcategory->parent_category = $this->parent_category;
            $subcategory->slug = Str::slug($this->subcategory_name);
            $updated = $subcategory->save();

            if($updated)
            {
                $this->dispatchBrowserEvent('hide_subcategory_modal');
                $this->update_subcategory_mode = false;
                $this->showToastr('SubCategory has been successfully updated', 'success');
            }else{
                $this->showToastr('Something went wrong', 'error');
            }
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $this->dispatchBrowserEvent('deleteCategory', [
            'title' => '<br>Are you sure ?',
            'html' => 'You want to delete '. $category->category_name .' category !',
            'id' => $id
        ]);
    }

    public function deleteSubcategory($id)
    {
        $subcategory = Subcategory::find($id);
        $this->dispatchBrowserEvent('deleteSubcategory', [
            'title' => '<br>Are you sure ?',
            'html' => 'You want to delete '.$subcategory->name.' subcategory !',
            'id' => $id
        ]);
    }

    public function deleteCategoryAction($id)
    {
        $category = Category::where('id',$id)->first();
        $subcategory = Subcategory::where('parent_category',$category->id)->whereHas('posts')->with('posts')->get();

        if(!empty($subcategory) && count($subcategory) > 0)
        {
            $totalPosts = 0;
            foreach($subcategory as $subcat)
            {
                $totalPosts += Post::where('category_id', $subcat->id)->get()->count();
            }
            $this->showToastr('This category has ('.$totalPosts.') posts related to it, cannot be deleted !', 'error');
        }else{
            $category->delete();
            Subcategory::where('parent_category', $category->id)->delete();
            $this->showToastr('Category has been successfully deleted', 'info');
        }
    }

    public function deleteSubcategoryAction($id)
    {
        $subcategory = Subcategory::where('id', $id)->first();
        $posts = Post::where('category_id', $subcategory->id)->get()->toArray();
        if(!empty($posts) && count($posts) > 0)
        {
            $this->showToastr('This subcategory has ('.count($posts).') posts related to it ,cannot be deleted', 'error');
        }else{
            $subcategory->delete();
            $this->showToastr('Subcategory has been successfully deleted', 'info');
        }
    }

    public function showToastr($message, $type)
    {
        $this->dispatchBrowserEvent('showToastr', [
            'message' => $message,
            'type' => $type
        ]);
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('ordering', 'asc')->get(),
            'subcategories' => Subcategory::orderBy('ordering', 'asc')->get()
        ]);
    }

    public function updateCategoryOrdering($positions)
    {
        foreach($positions as $position)
        {
            $index = $position[0];
            $new_position = $position[1];
            Category::where('id', $index)->update([
                'ordering' => $new_position,
            ]);
            $this->showToastr('Categories ordering has been successfully updated', 'success');
        }
    }

    public function updateSubCategoryOrdering($positions)
    {
        foreach($positions as $position)
        {
            $index = $position[0];
            $new_position = $position[1];
            Subcategory::where('id', $index)->update([
                'ordering' => $new_position,
            ]);
            $this->showToastr('Subcategories ordering has been successfully updated', 'success');
        }
    }
}
