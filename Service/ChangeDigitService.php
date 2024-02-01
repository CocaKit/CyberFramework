<?php 

namespace Service;

class ChangeDigitService
{
    public function main($text, $operation, $nm)
    {
        $action = function ($number) use ($operation, $nm) { 
            return $operation === 'plus' ? $number + $nm : $number - $nm; 
        };

        preg_match_all('/\[[\d,]+\]/', $text, $matches);

        foreach ($matches[0] as $match) {
            $numbers = explode(',', str_replace(['[', ']'], '', $match));
            $new_numbers = array_map($action, $numbers);
            $new_match = '[' . implode(',', $new_numbers) . ']';
            $text = str_replace($match, $new_match, $text);
        }

        return $text;
    }
}