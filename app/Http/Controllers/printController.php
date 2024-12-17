<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Corrected the casing

class printController extends Controller
{
    public function generate_pdf(Request $request)
    {
        $htmlContent = $request->input('htmlContent');
        if ($htmlContent) {
            $pdf = Pdf::loadHTML($htmlContent);
            return $pdf->download('Invoice.pdf');
        }
        return response()->json(['error' => 'No content provided'], 400);
    }
}

