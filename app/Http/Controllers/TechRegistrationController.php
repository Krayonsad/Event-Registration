<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TechRegistration;

class TechRegistrationController extends Controller
{
    public function getForm(Request $request)
    {
        $event = urldecode($request->query('event'));
        $response = @file_get_contents('https://restcountries.com/v3.1/all?fields=name,idd');
        $countries = [];

        if ($response) {
            $data = json_decode($response, true);

            foreach ($data as $country) {
                $name = $country['name']['common'] ?? null;
                $root = $country['idd']['root'] ?? null;
                $suffixes = $country['idd']['suffixes'][0] ?? null;

                if ($name && $root && $suffixes) {
                    $countries[] = [
                        'name' => $name,
                        'code' => $root . $suffixes,
                    ];
                }
            }
            usort($countries, fn($a, $b) => strcmp($a['name'], $b['name']));
        }

        return view('register_form', compact('event', 'countries'));
    }

    public function postForm(Request $request)
    {
        $validated = $request->validate([
            'event_name'           => 'required|string|max:255',
            'full_name'            => 'required|string|max:255',
            'email'                => 'required|email:rfc,dns|max:255|unique:tech_registrations,email',
            'contact_country_code' => 'required|string|max:10',
            'contact_number'       => 'required|string|max:20',
            'address_line'         => 'required|string|max:255',
            'city'                 => 'required|string|max:100',
            'state'                => 'required|string|max:100',
            'country'              => 'required|string|max:100',
            'zipcode'              => 'required|string|max:20',
            'company_name'         => 'required|string|max:255',
            'designation'          => 'nullable|string|max:255',
            'industries'           => 'required|array',
            'industries.*'         => 'string|max:255',
            'message'              => 'nullable|string|max:1000',
        ]);

        $validated['industry'] = implode(', ', $validated['industries']);
        unset($validated['industries']);

        $validated['order_id'] = $this->generateOrderId($validated['event_name']);

        TechRegistration::create($validated);

        return redirect()->route('events')->with('success', '✅ Registration successful for ' . $request->event_name . '!');
    }

    private function generateOrderId(string $eventName): string
    {
        $words = preg_split('/\s+/', $eventName);
        $prefix = '';

        foreach ($words as $word) {
            if (ctype_alpha($word[0])) {
                $prefix .= strtoupper($word[0]);
            }
        }

        $uniqueNumber = time();
        return $prefix . $uniqueNumber;
    }
}
