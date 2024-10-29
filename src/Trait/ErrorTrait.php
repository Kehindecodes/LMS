<?php

namespace App\Trait;

trait ErrorTrait
{
    private function generateErrorHtml(array $errors): string
    {
        $html = '';
        foreach ($errors as $field => $error) {
            $html .= "<p id='{$field}-error' class='text-red-500 text-sm mt-1'>{$error}</p>";
        }
        return $html;
    }
}