<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->authorize("viewAny" , User::class);
        $users = User::all();

        $active_parametre_index = 'active';

        return view('admin.parametre.utilisateur', compact('active_parametre_index', 'users'));
    }

    public function edit(User $user){
        $role = array();
        $user_role = unserialize(str_replace('\\', '', $user->role));
        foreach (is_array($user_role) ? $user_role : array() as $key => $value) {
          array_push($role, $value);
        }
        $user->role = $role;
        return response()->json(["user" => $user]);
    }

    public function update(request $request, User $user){
        $this->authorize("update" , $user);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'edit_password' => ['sometimes'],
            'role' => ['sometimes']
        ]);

        // Check validation failure
        if ($validator->fails()) {
            // [...]
            $errors = $validator->errors();
            return response()->json($errors);
        }
    
        // Check validation success
        if ($validator->passes()) {
            
             $data = request()->all(["name", "email", "ville", "adresse", "role", "edit_password" ]);
                
             if($data["edit_password"] == "on"){

                $revalidator = Validator::make($request->all(), [
                    'password' => ['required', 'string', 'min:8', 'confirmed']
                ]);

                // Check validation failure
                 if ($revalidator->fails()) {                   
                    $errors = $revalidator->errors();
                    return response()->json($errors);
                 }
                 // Check validation success
                if ($validator->passes()) {
                    $data["password"] =  request()->all(["password"])["password"];
                    $data['password'] = Hash::make($data['password']);
                }
            }

             
                
                 $data["role"] = (isset($data["role"]) && is_array($data["role"]) ) ? serialize($data["role"]) : "";

                 unset($data["edit_password"]);
                 
                 User::where("id", "=", $user->id)->update($data);
         
                 $string = "L'utilisateur ".ucwords($data["name"]).' a été modifié avec succès';
                 alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

                 return response()->json(["success" => true]);
             
        }

    }

    public function delete(User $user){
       $name = $user->name;
        User::where("id" , "=" , $user->id)->delete();
        
        $string = "L'utilisateur ".ucwords($name).' a été supprimé avec succès';
        alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

        return redirect()->back();
    }

    public function create(request $request){
        

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['sometimes']
        ]);
        // Check validation failure
        if ($validator->fails()) {
            // [...]
            $errors = $validator->errors();
            return response()->json($errors);
        }
    
        // Check validation success
        if ($validator->passes()) {
            // [...]
            $data = $request->except("role");
            $role = $request->all("role");

            $data["role"] = (isset($role["role"]) && is_array($role["role"]) ) ? serialize($role["role"]) : "";
            $data['type'] = 'default';
            $data['password'] = Hash::make($data['password']);

            User::create($data);

            $string = "L'utilisateur ".ucwords($data["name"])." a bien été ajouté";
            alertify()->success($string)->delay(5000)->clickToClose()->position('bottom right');

            return response()->json(["success" => true]);
            
        } 
    
    }

}
