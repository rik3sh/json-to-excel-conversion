<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    /**
     * Redirect the user to the home page.
     *
     * @return \Inertia\Response
     */
    public function welcome(): \Inertia\Response 
    {
        return Inertia::render('Welcome');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('github')
            ->scopes(['read:user'])
            ->redirect();
    }

    /**
     * Handle the callback from GitHub.
     *
     * @return RedirectResponse
     */
    public function callback(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')->user();
 
        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => !empty($githubUser->name) ? $githubUser->name : $githubUser->nickname,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
     
        Auth::login($user);
     
        return redirect(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('welcome'));
    }
}
