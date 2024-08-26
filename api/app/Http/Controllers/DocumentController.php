<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WordService;

class DocumentController extends Controller
{
    protected $wordService;

    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $fileName = $this->wordService->generateDocument($request->title, $request->date);

        return response()->json([
            'file_url' => asset("storage/$fileName")
        ]);
    }
}
