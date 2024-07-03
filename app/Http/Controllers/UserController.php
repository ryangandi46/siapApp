<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::all();
        if ($request->ajax()) {
            return datatables()->of($user)
                ->addColumn('action', function ($data) {
                    $urlEdit = route('user.edit', $data->id); // Replace with your actual edit route
                    $urlDelete = route('user.destroy', $data->id); // Replace with your actual delete route
                   
                    $button = '<a href="' . $urlEdit . '" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<form action="' . $urlDelete . '" method="POST" style="display:inline-block">';
                    $button .= csrf_field();
                    $button .= method_field('DELETE'); // Add method field for DELETE request
                    $button .= '<button type="submit" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>';
                    $button .= '</form>';
                    return '<div class="text-center">' . $button . '</div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'email' => 'required',            
            'password' => 'required'
        ]);

        //create a new product in the database
        User::create($request->all());

        // redirect the user and send friendly message
        return redirect()->route('user.index')->with('success', 'Users Created Succressfully');
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
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',            
            'password' => ''
        ]);

        //update a  product in the database
        $user->update($request->all());

        // redirect the user and send friendly message
        return redirect()->route('user.index')->with('success', 'Users Updated Succressfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
         // delete the user
         $user->delete();


         //redirect the user adn display succes message
         return redirect()->route('user.index')->with('success', 'Users Deleted Succressfully');
    }
}
