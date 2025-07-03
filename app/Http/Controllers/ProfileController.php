<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'reg' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if($request->password){

            $request->user()->password = Hash::make($request->password);

        } else {
            //si no se ha cambiado la contraseña, mantenemos la actual
            $request->user()->password = $request->user()->password;
        }

        $imageNameOnly = $request->user()->id.'.jpg';
        if($request->file('image') != null){
            
            //si tiene imagen la eliminamos
            if (Storage::disk("imgperfil")->exists($imageNameOnly)) 
            {
                Storage::disk('imgperfil')->delete($imageNameOnly);
            }
            //subimos la nueva imagen
            if (!Storage::disk("imgperfil")->exists($imageNameOnly)) 
            {
                Storage::disk('imgperfil')->put($imageNameOnly, fopen($request->file('image'), 'r+'));
            }
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', __(trans('application_lang.app_lbl_action_update_correct')));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
