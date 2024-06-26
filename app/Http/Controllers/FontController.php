<?php

namespace App\Http\Controllers;

use App\Model\Font;
use App\Model\FontDownload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use ZipArchive;

class FontController extends Controller {

    public function index() {
        $fonts = Font::with('images', 'files', 'category', 'author')
            ->whereHas('images')
            ->whereHas('files')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('fonts', ['fonts' => $fonts]);
    }

    public function recent() {
        $fonts = Font::with('images', 'files', 'category', 'author')
            ->whereHas('images')
            ->whereHas('files')
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->paginate(20);
        return view('fonts', ['fonts' => $fonts]);
    }

    public function top() {
        $fonts = Font::with('images', 'files', 'category', 'author')
            ->whereHas('images')
            ->whereHas('files')
            ->withCount('downloads')
            ->orderBy('downloads_count', 'desc')
            ->limit(100)
            ->paginate(20);

        return view('fonts', ['fonts' => $fonts]);
    }

    public function get($slug) {
        $font = Font::with('images', 'files', 'category', 'author', 'downloads')
            ->where('slug', $slug)
            ->first();

        $fontSize = null;
        try {
            $zipName = str_replace(" ", "_", $font->name).".zip";
            $zipPath = public_path("/files/zip/");
            $fontSize = filesize($zipPath.$zipName);
        } catch (\Exception $ignored) {}

        $fontTypes = [];
        foreach($font->files as $fontFile) {
            $type = explode('.', $fontFile->source)[1];
            if ($type == 'ttf') {
                $fontType = "TrueType (.ttf)";
            } elseif ($type == 'otf') {
                $fontType = "OpenType (.otf)";
            }
            if (isset($fontType) && !in_array($fontType, $fontTypes)) {
                $fontTypes[] = $fontType;
            }
        }

        return view('font', ['font' => $font, 'fontSize' => $fontSize, 'fontTypes' => implode(', ', $fontTypes)]);
    }

    public function download($slug) {
        $font = Font::where('slug', $slug)->first();
        $fontDownload = new FontDownload();
        $fontDownload->font_id = $font->id;
        $fontDownload->user_id = !is_null(Auth::user()) ? Auth::user()->id : null;
        $fontDownload->ip = Request::ip();
        $fontDownload->save();

        $zip = new ZipArchive();
        $zipName = "{$font->slug}.zip";
        $zipPath = public_path("/files/zip/");
        if ($zip->open($zipPath . $zipName, ZipArchive::CREATE) === true) {
            foreach($font->files as $fontFile) {
                $fileName = $fontFile->source;
                $filePath = public_path("/files/fonts/");
                $zip->addFile($filePath.$fileName, $fileName);
            }
            // Add random.txt file to zip and rename it to newfile.txt
            //$zip->addFile('random.txt', 'newfile.txt');
            // Add a file new.txt file to zip using the text specified
            //$zip->addFromString('new.txt', 'text to be added to the new.txt file');
            $zip->close();
        }

        header('Content-Type: application/zip');
        return response()->download($zipPath.$zipName);
    }

}
