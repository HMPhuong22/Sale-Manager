<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovertString extends Model
{
    use HasFactory;
    public function generateCodeColor($string)
    {
        // Chuyển đổi các ký tự tiếng Việt có dấu sang không dấu
        $vietnameseCharacters = [
            'A' => ['à', 'á', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ắ', 'ẳ', 'ẵ', 'ặ', 'â', 'ầ', 'ấ', 'ẩ', 'ẫ', 'ậ'],
            'E' => ['è', 'é', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ề', 'ế', 'ể', 'ễ', 'ệ'],
            'I' => ['ì', 'í', 'ỉ', 'ĩ', 'ị'],
            'O' => ['ò', 'ó', 'ỏ', 'õ', 'ọ', 'ô', 'ồ', 'ố', 'ổ', 'ỗ', 'ộ', 'ơ', 'ờ', 'ớ', 'ở', 'ỡ', 'ợ'],
            'U' => ['ù', 'ú', 'ủ', 'ũ', 'ụ', 'ư', 'ừ', 'ứ', 'ử', 'ữ', 'ự'],
            'Y' => ['ỳ', 'ý', 'ỷ', 'ỹ', 'ỵ'],
            'D' => ['đ', 'Đ']
        ];

        foreach ($vietnameseCharacters as $nonDiacritic => $diacritics) {
            $string = str_replace($diacritics, $nonDiacritic, $string);
        }

        // Chuyển về chữ hoa
        $string = strtoupper($string);

        // Xóa ký tự khoảng trắng và ký tự đặc biệt
        $string = preg_replace('/[^A-Z0-9]/', '', $string);

        return $string;
    }
}
