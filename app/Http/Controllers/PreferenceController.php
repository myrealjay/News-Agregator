<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreferenceRequest;
use App\Traits\HasResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    use HasResponse;

    /**
     * Get user preferences.
     *
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        return $this->sendResponse(
            true,
            "Preferences fetched successfully",
            Auth::user()->preferences
        );
    }

    /**
     * Set user preferences.
     *
     * @param PreferenceRequest $request
     * @return JsonResponse
     */
    public function store(PreferenceRequest $request): JsonResponse
    {
        $user = Auth::user();
        $user->preferences()->updateOrCreate(
            ['user_id' => $user->id],
            $request->validated()
        );
        $user->refresh();

        return $this->sendResponse(
            true,
            'Preferences set successfully',
            $user->preferences
        );
    }
}
