<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\dishModel;

class dishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = dishModel::all();
        return view('show_all_dishes')->with('dishes',$dishes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_new_dishes');
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
            'dishPrice' => 'required',
            'dishName' => 'required',
            'dishDescription' => 'required' 
        ]);

        $imagName='noimg.png';
if($request->dishimage)
{
        $request->validate([
            'dishimage' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000', 
        ]);

        $imagName = date('mdYHis').uniqid().'.'.$request->dishimage->extension();
        $request->dishimage->move(public_path('uploaded_imgs'),$imagName);	
       

        }
 


        $dishModel_obj = new dishModel;
        $dishModel_obj->dish_name = $request->dishName;
        $dishModel_obj->dish_price = $request->dishPrice;
        $dishModel_obj->dish_description = $request->dishDescription;
        $dishModel_obj->dish_image = $imagName;
        $dishModel_obj->save();
        $request->session()->flash('status','Dish Inserted Successfully');
        return redirect('dishes');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         $dish = dishModel::find($id);
        return view('edit_dish')->with('dish',$dish) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         

        $request->validate([
            'dishPrice' => 'required',
            'dishName' => 'required',
            'dishDescription' => 'required' 
        ]);

        $dishModel_obj = dishModel::find($id);




if($request->dishimage){
    $request->validate([
        'dishimage' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
    ]);  

        if($dishModel_obj->dish_image != 'noimg.png'){

          $oldImg =$dishModel_obj->dish_image;
          unlink(public_path('uploaded_imgs').'/'.$oldImg);

          $imgName = $request->dishimage;
        }

            $imgName = date('mdYHis').uniqid().'.'.$request->dishimage->extension();
            $request->dishimage->move(public_path('uploaded_imgs'), $imgName); 
        
    }
    else{
        $imgName = $dishModel_obj->dish_image;
    }





       
        $dishModel_obj->dish_name = $request->dishName;
        $dishModel_obj->dish_price = $request->dishPrice;
        $dishModel_obj->dish_description = $request->dishDescription;
        $dishModel_obj->dish_image =  $imgName;
        $dishModel_obj->save();
        $request->session()->flash('status','Dish Updated Successfully');
        return redirect('dishes');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dishModel_obj = dishModel::find($id);
        if($dishModel_obj ->dish_image !='noimg.png'){ 
            $oldImg =$dishModel_obj->dish_image;
            unlink(public_path('uploaded_imgs').'/'.$oldImg); 
        }
        $dishModel_obj->delete();
        session()->flash('status', 'dishes Deleted Successfully');
        return redirect('dishes');
    }
}
