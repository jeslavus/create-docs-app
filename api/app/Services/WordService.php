<?php

namespace App\Services;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class WordService
{
    public function generateDocument($title, $date)
    {
        $phpWord = new PhpWord();

        $section = $phpWord->addSection();
        $section->addText("Название документа: $title");
        $section->addText("Дата создания: $date");

        $fileName = 'document_' . time() . '.docx';
        $filePath = storage_path("app/public/$fileName");

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);

        return $fileName;
    }
}
