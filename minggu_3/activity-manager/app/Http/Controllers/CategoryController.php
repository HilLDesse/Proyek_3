<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function destroy(Category $category)
    {
        if ($category->activities()->exists()) {
            return redirect()
                ->route('activities.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh Activity.');
        }

        try {
            $category->delete();
        } catch (QueryException $exception) {
            return redirect()
                ->route('activities.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh Activity.');
        }

        return redirect()
            ->route('activities.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}