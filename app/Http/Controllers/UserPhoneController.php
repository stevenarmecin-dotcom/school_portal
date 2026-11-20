<?php

namespace App\Http\Controllers;

use App\Models\UserPhone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPhoneController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $phoneRecordData = $request->validate([
            'contact_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($phoneRecordData) {
            $userPhone = UserPhone::create([
                'name' => $phoneRecordData['contact_name'],
            ]);

            $userPhone->phones()->create([
                'phone_number' => $phoneRecordData['phone_number'],
            ]);
        });

        return redirect()->route('dashboard');
    }
}
