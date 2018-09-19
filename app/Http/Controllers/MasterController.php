<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    static function getWebInformations(){
        $web_info = DB::table('options')->where('autoload', 'y')->get();
        foreach ($web_info as $info) {
            $options[$info->option_name] = $info->option_value;
        }
        return $options;
    }

    static function getWebMetas(){
        $web_metas = DB::table('metas')->get();
        return $web_metas;
    }

    static function substr_text_only($string, $limit, $end='...')
    {
        $with_html_count = strlen($string);
        $without_html_count = strlen(strip_tags($string));
        $html_tags_length = $with_html_count-$without_html_count;

        return str_limit($string, $limit+$html_tags_length, $end);
    }
}
