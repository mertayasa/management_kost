<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller{

    public function index(){
        //
    }

    public function datatable(){
        $users = User::all();

        return UserDataTable::set($users);
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit(User $user){
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user){
        try{
            $data = $request->all();

            // if($data['password']){
            //     $data['password'] = bcrypt($data['password']);
            // }else{
            //     unset($data['password']);
            // }

            // $base_64_foto = json_decode($request['foto'], true);
            // $upload_image = uploadFile($base_64_foto);

            // if($upload_image == 0){
            //     return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
            // }

            // $data['foto'] = $upload_image;

            // $update_user = $user->update($data);

            // if(userRole() == 'admin'){
            //     Admin::updateOrCreate(['user_id' => $user->id], $data);
            // }else{
            //     $user->pegawai->update($data);
            // }
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah profile!');
        }

        return redirect()->back()->with('success','Profile berhasil diubah!');
    }

    public function destroy($user){
        try{
            $user->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus user']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus user']);
    }
}
