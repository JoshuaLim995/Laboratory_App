<?php


namespace App\Http\Controllers;

use Storage;
use App\Inventory;
use Illuminate\Http\Request;
use Image;
use DataTables;
use Validator;
use Session;
use Auth;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
        $this->middleware('admin', ['only' => ['create', 'store', 'edit', 'update', 'delete']]);
    }

    public function index()
    {
        return view('inventory.index');
    }

    public function get_datatable()
    {
        $inventories = Inventory::select([
            'id',
            'name',
            'category',
            ]);

        return DataTables::eloquent($inventories)
        ->addColumn('category', function ($inventory) {
                return $inventory->getCategory();
        })
        ->addColumn('action', function ($inventory) {
            return $this->getActionButtons($inventory);            
        })
        ->toJson();
    }

    public function getActionButtons($inventory)
    {
        if(Auth::user()->isAdmin() || Auth::user()->isdlmsa())
        {
            return 
            '<div class="action">' .
            '<a href="'. route('inventory.show', $inventory) .'" class="btn btn-info">View</a>' . 
            '<a href="'. route('inventory.edit', $inventory) .'" class="btn btn-success">Edit</a>' .
            '<a href="'. route('inventory.delete', $inventory) .'" class="btn btn-danger"' . ' onclick="if(!confirm(' . "'Are you sure delete this record?'". ')){return false;};"' . '">Delete</a>' .
            '</div>';
        }
        else
        {
            return 
            '<div class="action">' .
            '<a href="'. route('inventory.show', $inventory) .'" class="btn btn-info">View</a>' . 
            '</div>';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            ]);


        // $validator = Validator::make($request->all(), [
        //    'name' => 'required',
        //    'model' => 'required',
        //    'category_id' => 'required',
        //    ]);

        // if($validator->fails()){
        //     $request->session()->flash('warning', 'Please fill in the required text field. (Name, Model, Category');

        //     return redirect()->route('inventory.create')->withErrors($validator);
        // }
        // else{
        $inventory = new Inventory();
        $inventory->fill($request->all());

        $this->storePhoto($request, $inventory);

        $inventory->save();

        $request->session()->flash('success', 'New inventory added successfully!');
        return redirect()->route('inventory.create');
        // }

    }


    

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        // return Storage::disk('public');

        return view('inventory.show', [
            'inventory' => $inventory,
            'locations' => $inventory->locations,
            'transactions' => $inventory->transactions,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', [
            'inventory' => $inventory,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            ]);

        $inventory->fill($request->all());

        $this->storePhoto($request, $inventory);

        $inventory->save();

        $request->session()->flash('success', 'Item updated successfully!');
        return redirect()->route('inventory.index');
    }

    public function storePhoto(Request $request, Inventory $inventory)
    {
        if($request->photo)
        {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
            $inventory->photo = $inventory->name .'.jpg';
            try {
                $image_resize = Image::make($request->file('photo'));
                $image_resize->orientate();

                $image_resize->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $image_resize->save(public_path('storage/inventories/' .$inventory->photo));
            }
            catch (Exception $e) {
                $request->session()->flash('warning', 'Error during upload photo to server.');
                return redirect()->route('inventory.index');
            }
        }
    }

    public function delete(Inventory $inventory)
    {
        $inventory->delete();
        Session::flash('success', 'Item deleted successfully!');
        return redirect()->route('inventory.index');
    }
}
