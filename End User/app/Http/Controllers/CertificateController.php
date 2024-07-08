<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Test;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $certificatesQuery = $user->certificates(); //This code work but it show red underline

        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $certificatesQuery = $certificatesQuery->where('title', 'like', '%' . $searchTerm . '%');
        }

        $certificates = $certificatesQuery->get();

        return view('certificate.main_certificate', compact('certificates'));
    }


    public function download(Certificate $certificate)
    {
        $certificates = Auth::user()->certificates;
        $otherCertificates = $certificate->where('id', '!=', $certificate->id)->get();



        return view('certificate.download_certificate', compact('certificate', 'otherCertificates'));
    }



}
