<?php

namespace App\Helpers;

class ArabicTransliterator
{
    protected static array $charMap = [
        'ا' => 'a', 'أ' => 'a', 'إ' => 'a', 'آ' => 'aa',
        'ب' => 'b', 'ت' => 't', 'ث' => 'th',
        'ج' => 'g', 'ح' => 'h', 'خ' => 'kh',
        'د' => 'd', 'ذ' => 'th', 'ر' => 'r', 'ز' => 'z',
        'س' => 's', 'ش' => 'sh', 'ص' => 's', 'ض' => 'd',
        'ط' => 't', 'ظ' => 'z', 'ع' => 'a',
        'غ' => 'gh', 'ف' => 'f', 'ق' => 'q',
        'ك' => 'k', 'ل' => 'l', 'م' => 'm', 'ن' => 'n',
        'ه' => 'h', 'ة' => 'a', 'و' => 'ou', 'ي' => 'y',
        'ى' => 'a', 'ئ' => 'a', 'ء' => 'a',
        'پ' => 'p', 'چ' => 'ch', 'ژ' => 'zh',
        '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3',
        '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7',
        '٨' => '8', '٩' => '9',
        'ؤ' => 'ou', 'ـ' => '',
    ];

    protected static array $tashkeel = [
        'َ', 'ُ', 'ِ', 'ّ', 'ْ', 'ً', 'ٌ', 'ٍ',
    ];

    public static function toLatin(string $arabic): string
    {
        $arabic = trim($arabic);
        if (empty($arabic)) return '';

        $result = '';
        $chars = mb_str_split($arabic);

        $i = 0;
        while ($i < count($chars)) {
            $char = $chars[$i];
            $next = $chars[$i + 1] ?? '';

            if (in_array($char, self::$tashkeel)) {
                $i++;
                continue;
            }

            if ($char === 'ل' && ($next === 'ا' || $next === 'أ' || $next === 'آ' || $next === 'إ')) {
                $result .= 'la';
                $i += 2;
                continue;
            }

            if ($char === 'ا' && isset($chars[$i + 1]) && $chars[$i + 1] === 'ل') {
                $result .= 'al';
                $i += 2;
                continue;
            }

            if (isset(self::$charMap[$char])) {
                $result .= self::$charMap[$char];
            } elseif (strlen($char) === 1) {
                $result .= $char;
            }

            $i++;
        }

        $result = preg_replace('/\s+/', ' ', $result);
        $result = trim($result);

        $result = self::insertVowels($result);
        $result = self::fixCommonNames($result);

        $result = preg_replace_callback('/\b\w/', fn($m) => strtoupper($m[0]), $result);

        $result = preg_replace('/[^\x20-\x7E\s]/', '', $result);

        return $result;
    }

    protected static function insertVowels(string $s): string
    {
        $v = ['a', 'e', 'i', 'o', 'u'];
        $w = [' '];
        $nonLetters = array_merge($v, $w, ['0','1','2','3','4','5','6','7','8','9']);
        $dg = ['th', 'sh', 'kh', 'gh', 'ch', 'zh', 'ou'];
        $out = '';
        $len = strlen($s);

        for ($i = 0; $i < $len; $i++) {
            $c = $s[$i];
            $n1 = $s[$i + 1] ?? '';

            $out .= $c;

            if ($n1 === '' || in_array($c, $nonLetters)) continue;
            if (in_array($n1, $nonLetters)) continue;
            if (in_array($c . $n1, $dg)) continue;

            $n2 = $s[$i + 2] ?? '';
            $afterEnd = $n2 === '' || in_array($n2, $nonLetters);

            if ($i === 0 || ($i > 0 && in_array($s[$i - 1], $w))) {
                $out .= 'a';
            } elseif ($n1 === 'd' && $afterEnd) {
                $out .= 'e';
            } elseif (!$afterEnd && !in_array($n2, $v) && !in_array($n1 . $n2, $dg)) {
                $out .= 'a';
            }
        }

        return $out;
    }

    protected static function fixCommonNames(string $s): string
    {
        $fixes = [
            '/\bmahamad\b/i' => 'Mohamed',
            '/\bmahamed\b/i' => 'Mohamed',
            '/\bmahemed\b/i' => 'Mohamed',
            '/\bahamed\b/i' => 'Ahmed',
            '/\bahemed\b/i' => 'Ahmed',
        ];

        return preg_replace(array_keys($fixes), array_values($fixes), $s);
    }
}
