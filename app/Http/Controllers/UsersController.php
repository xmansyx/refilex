<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::join('transactions', 'transactions.user_id' ,'=' ,'users.id');
            if(request()->has('search')){
                $users->where('name', 'like', '%' . request('search') . '%');
            }
    
            if(request()->has('status_code')){
                $users->join('status_codes', 'status_codes.id' , '=' , 'transactions.status_code_id')
                    ->where('status_code_name', request('status_code'));
            }
    
            if(request()->has('date_from')){
                $users->where('transactions.created_at', '>=' , request('date_to'));
            }
    
            if(request()->has('date_to')){
                $users->where('transactions.created_at', '<=' , request('date_to'));
            }
    
            if(request()->has('amount_from')){
                $users->where('transactions.amount', '>=' , request('amount_from'));
            }
            if(request()->has('amount_to')){
                $users->where('transactions.amount', '<=' , request('amount_to'));
            }
            if(request()->has('currency')){
                $users->where('transactions.currency', '<=' , request('currency'));
            }
    
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => "the request data not found"], 400);
        }
        
        $users = $users->paginate();
        return response()->json($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::with('transactions')->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
