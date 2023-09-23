<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PersonsController extends Controller
{
    public function Index(){
        $persons = User::latest()->paginate(100);
        return view('admin.content.persons.persons',compact('persons'));
    }

    public function Search(Request $request){
        $persons = User::where('name', 'LIKE', '%' . $request->search . '%')
        ->orWhere('email', 'LIKE', '%' . $request->search . '%')
        ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
        ->latest()->paginate(100);
        return view('admin.content.persons.persons',compact('persons'));
    }

    public function Add(){
        return view('admin.content.persons.person-add');
    }

    public function Store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if(!empty($request->password)){
            
        }else{
            $password = 12345678;
        }

        if(!empty($request->image)){
            $imageName = substr($request->image->getClientOriginalName(),0,-4).'-'.rand(1,9999).'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = 'avatar.png';
        }

        User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'billing_address' => $request->address,
            'shipping_address' => $request->address,
            'password' =>  Hash::make($request->password),
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success','Person added successfully');
    }

    public function Edit($id){
        $person = User::findOrFail($id);
        return view('admin.content.persons.person-edit',compact('person'));
    }
    
    public function Update(Request $request){

        $person = User::findOrFail($request->hidden_id);

        $request->validate([
            'name' => 'required|max:255',
            'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if(!empty($request->password)){
            $password = Hash::make($request->password);
        }else{
            $password = $person->password;
        }

        if(!empty($request->image)){
            $old_image = public_path('images/' . $person->image);            

            if(file_exists($old_image)) {
                unlink($old_image);
            }
            
            $imageName = substr($request->image->getClientOriginalName(),0,-4).'-'.rand(1,9999).'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = $person->image;
        }

        User::findOrFail($request->hidden_id)->update([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'billing_address' => $request->address,
            'shipping_address' => $request->address,
            'password' =>  $password,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.person_index')->with('success','Person added successfully');
    }


    public function Delete($id){
        $person = User::findOrFail($id);
        if($person->image != 'avatar.png'){
            $old_image = public_path('images/' . $person->image);
            if(file_exists($old_image)) {
                unlink($old_image);
            }
        }

        User::findOrFail($id)->delete();        
        return redirect()->route('admin.person_index')->with('success','Person added successfully');
    }
}
