<?php

namespace App\Http\Controllers;

use App\Models\Procurement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;



class ProcurementController extends Controller
{
    public function itemList()
    {
        $data['header_title'] = "Procurement List";
        $data['getRecord'] = Procurement::getProcurement();
        
        return view('admin.procurement.item_list', $data);
    }


    public function itemAdd()
    {
        $data['header_title'] = "Add Procurement";
        
        return view('admin.procurement.add_item', $data);
    }


    public function itemStore(Request $request)
    {
        // dd($request->all());

        $item = new Procurement();
        $item->item_name = $request->item_name;
        $item->description = $request->description;
        $item->purchase_date = $request->purchase_date;
        $item->amount = $request->amount;
        

        if(!empty($request->file('image')))
        {
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('image'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/procurement/' . $filename); 


            $item->image = $filename;        //For the DB Field
        }

        $item->save();

        return redirect()->route('procurement.item.list')->with('success', 'Procurement Added Successfully!');
 
    }

    public function itemEdit($id)
    {
        $data['getRecord'] = Procurement::findOrFail($id);

        $data['header_title'] = "Edit Procurement";       
        return view('admin.procurement.edit_item', $data);
    }


    public function itemUpdate(Request $request, $id)
    {
        $item = Procurement::findOrFail($id);
        $item->item_name = $request->item_name;
        $item->description = $request->description;
        $item->purchase_date = $request->purchase_date;
        $item->amount = $request->amount;

        if(!empty($request->file('image')))
        {
            if(!empty($item->image))
            {
                unlink('upload/procurement/' . $item->image);
            }

            $ext = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('image'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/procurement/' . $filename); 


            $item->image = $filename;        //For the DB Fields
        }

        $item->save();

        return redirect()->route('procurement.item.list')->with('success', 'Procurement Updated Successfully!');

    }


    public function itemDelete($id)
    {
        $item = Procurement::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('warning', 'Procurement Deleted Successfully!');
    }







}
