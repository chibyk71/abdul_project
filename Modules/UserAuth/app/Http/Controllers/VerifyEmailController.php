<?php

namespace Modules\UserAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
  /**
   * Mark the authenticated user's email address as verified.
   */
  public function __invoke(EmailVerificationRequest $request): RedirectResponse
  {
    if ($request->user()->hasVerifiedEmail()) {
      return redirect()->intended(RouteServiceProvider::home() . '?verified=1');
    }

    if ($request->user()->markEmailAsVerified()) {
      event(new Verified($request->user()));
    }

    return redirect()->intended(RouteServiceProvider::home() . '?verified=1');
  }
}
