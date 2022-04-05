<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryDropdown extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('components.category-dropdown')->with(compact('categories'));
    }
}
