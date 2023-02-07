<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit($id): View
    {
        $user = User::find($id);

        if ($user->id !== Auth()->user()->id) {
            abort(403);
        }

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, $id): RedirectResponse
    {
        $user = User::find($id);

        if ($user->id !== Auth()->user()->id) {
            abort(403);
        }

        $user->fill($request->safe()->except('avatar'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($request->has('avatar')) {
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $name = pathinfo($request->file('avatar')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = Str::slug($name) . '.' . $extension;

            $request->file('avatar')->storeAs('images', $fileName, 'public');
            $user->avatar = $fileName;
            $user->save();
        }



        return Redirect::route('profile.edit', ['id' => $user->id])->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = User::find($id);

        if ($user->id !== Auth()->user()->id) {
            abort(403);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
