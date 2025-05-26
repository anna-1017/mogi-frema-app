<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use App\Models\Category;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'products');

        if($tab === 'mylist'){
            $items = auth()->user()->likes()->with('item')->get()->pluck('item');
        }else{
            $items = Item::all();
        }

        return view('product', [
            'items' => $items,
            'tab' => $tab,
        ]);

    }

    public function show($id)
    {
        $item = Item::withCount('likes')->findOrFail($id);
        $liked = false;

        if (Auth::check()){
            $liked = $item->likes()->where('user_id', Auth::id())->exists();
        }

        return view('detail', compact('item', 'liked'));
    }



    public function getDetail(Item $item)
    {
        $item->loadCount('comments');
        $item->load('categories'); 
        $item->loadCount('likes'); 

        $liked = false;
        if (Auth::check()){
            $liked = $item->likes()->where('user_id', Auth::id())->exists();
        }


        return view('detail', compact('item', 'liked'));
    }

    public function toggleLike($item_id)
    {

        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        if($item->likes()->where('user_id', $user->id)->exists()){
            $item->likes()->where('user_id', $user->id)->delete();
        } else{
            $item->likes()->create(['user_id' => $user->id]);
        }

        

        return back();

    }

    public function create()
    {
        $categories =['アクセサリー', '時計', '靴', '家電', 'スポーツ', '食料品', 'キッチン用品', 'バッグ', '化粧品'];

        return view('sell', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $path = $request->file('img_url')->store('images', 'public');


        $item = Item::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'brand_name' => $request->input('brand_name'),
            'condition' => $request->input('condition'),
            'price' => $request->input('price'),
            'img_url' => $path,
            'user_id' => Auth::id(),
        ]);


        $categoryName = $request->input('category');
        $category = Category::where('category', $categoryName)->first();

       if($category){
        $item->categories()->attach($category->id);

       }

        
        return redirect()->route('items.index')->with('success', '出品が完了しました');
    }
}




