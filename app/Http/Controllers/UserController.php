<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller{

    public function index(){
        return view('user.index');
    }

    public function datatable(){
        $users = User::all();

        return UserDataTable::set($users);
    }

    public function create(){
        $level = [1 => 'Manager', 2 => 'Pegawai'];
        return view('user.create', compact('level'));
    }

    public function store(UserStoreRequest $request){
        try{
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            // $base_64_foto = json_decode($request['foto'], true);
            // $upload_image = uploadFile($base_64_foto);

            // if($upload_image == 0){
            //     return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
            // }

            // $data['foto'] = $upload_image;

            User::create($data);

            // if(userlevel() == 'owner'){
            //     owner::updateOrCreate(['user_id' => $user->id], $data);
            // }else{
            //     $user->pegawai->update($data);
            // }
        }catch(Exception $e){
            Log::info($e->getMessage());
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user');
        }

        return redirect()->route('user.index')->with('success','Berhasil menambahkan user');
    }

    public function show($id){
        //
    }

    public function edit(User $user){
        $level = [1 => 'Manager', 2 => 'Pegawai'];
        if(userRole($user->level) == 'owner' || userRole() != 'owner'){
            $hide_level = true;
        }else{
            $hide_level = false;
        }

        $url_update_profile = route('user.update.profile', $user->id);
        // dd($hide_level);

        return view('user.edit', compact('user', 'level', 'hide_level'));
    }

    public function update(Request $request, User $user){
        $http_referer = request()->headers->get('referer');
        try{
            $data = $request->all();

            if($data['password']){
                $data['password'] = bcrypt($data['password']);
            }else{
                unset($data['password']);
            }

            if(str_contains($http_referer, 'profile')){
                unset($data['level']);
            }

            // $base_64_foto = json_decode($request['foto'], true);
            // $upload_image = uploadFile($base_64_foto);

            // if($upload_image == 0){
            //     return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
            // }

            // $data['foto'] = $upload_image;

            $user->update($data);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah user');
        }

        if(str_contains($http_referer, 'profile')){
            return redirect()->back()->with('success','Berhasil mengubah profil');
        }

        return redirect()->route('user.index')->with('success','Berhasil mengubah user');
    }

    public function destroy(User $user){
        $name = $user->name;
        try{
            $user->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus user '.$name]);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus user '.$name]);
    }

    public function editProfile(){
        return view('user.edit_profile');
    }

    public function updatProfile(){
        
    }
}
