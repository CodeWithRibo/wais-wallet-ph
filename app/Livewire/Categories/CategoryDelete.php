<?php

namespace App\Livewire\Categories;

use App\Livewire\Concerns\HasToast;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryDelete extends Component
{
    use HasToast;

    public $category;

    #[On('delete-category')]
    public function loadCategory($id): void
    {
        $this->category = Category::where('user_id', auth()->id())
            ->findOrFail($id);

        $this->authorize('force-delete', $this->category);
    }

    public function delete()
    {
        $this->loadCategory($this->category->id);
        $this->category->delete();
        $this->dispatch('delete-category');

        session()->flash('notify', [
            'content' => 'Category deleted successfully!',
            'type' => 'success',
            'duration' => 4000
        ]);
        return redirect()->route('categories');
    }

    public function render()
    {
        return view('livewire.categories.category-delete');
    }
}
