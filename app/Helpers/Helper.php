<?php

use App\Models\Media;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

if (! function_exists('getUserId')) {
    /**
     * Get user id
     *
     * @return mixed
     */
    function getUserId() {

        return auth()->user()->id;
    }
}

if (!function_exists('current_user')) {
    /**
     * Get user authenticate
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function current_user()
    {
        return auth()->user();
    }
}

if (! function_exists('format_time')) {
    /**
     * Format time.
     *
     * @return mixed
     */
    function format_time($time) {
        return date_format($time, "Y/m/d");
    }
}

if (!function_exists('get_break_text')) {
    /**
     * Get add line breaks to a textarea
     * @param $text
     * @return string
     */
    function get_break_text($text)
    {
        return nl2br(htmlentities($text, ENT_QUOTES, 'UTF-8'));
    }
}


if(!function_exists('range_array_number')) {
    /**
     * Range array number
     *
     * @param $from
     * @param $to
     * @return array
     */
    function range_array_number($from, $to)
    {
        return range($from, $to);
    }
}

if (!function_exists('check_route_name')) {
    /**
     *Check route name current
     */
    function check_route_name($arrRoute)
    {
        if (in_array(Route::currentRouteName(), $arrRoute)) {
            return true;
        }

        return false;

    }
}

if (!function_exists('get_checked_checkbox')) {
    /**
     * Get checked checkbox
     *
     * @param $arr
     * @return false|string[]
     */
    function get_checked_checkbox($arr)
    {
        return explode(',', $arr);
    }
}

if (!function_exists('get_link_no_image')) {
    /**
     * Get link no image as string
     * @param $link
     * @return false|mixed|string
     */
    function get_link_no_image($link) {
        $result = explode( '/', $link);

        return end($result);
    }
}

if (!function_exists('format_datetime')) {
    /**
     * Format datetime.
     *
     * @throws Exception
     */
    function format_datetime($dateTime) {

        return date_format(date_create($dateTime), 'Y年m月d日') ?? '' ;
    }
}

if (!function_exists('format_timestamp_to_date_time_japan')) {
    /**
     * Handle format datetime to Japan
     *
     * @param $datetime
     * @return false|string
     */
    function format_timestamp_to_date_time_japan($datetime) {
        return date_format(date_create($datetime), 'Y年m月d日');
    }
}

if (!function_exists('url_detection')) {
    /**
     * Make clickable links from URLs in text.
     */
    function url_detection($text) {
        $regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';

        return preg_replace_callback($regex, function ($matches) {
            return "<a target='_blank' href=$matches[0]>{$matches[0]}</a>";
        }, $text);
    }
}

if (!function_exists('base64_image')) {
    /**
     * Handle base64 file image
     *
     * @param $referId
     * @param $referType
     * @param $name
     * @return string
     */
    function base64_image($referId, $referType)
    {
        $image = Media::where('refer_id', $referId)->where('refer_type', $referType)->first();
        $afterBase64 = '';

        if (!empty($image)) {
            $path = 'storage/' . $image->path;
            $file = file_get_contents($path);

            $afterBase64 = 'data:image/jpg;base64,' . base64_encode($file);
        }

        return $afterBase64;
    }
}


if (!function_exists('base64_document')) {
    /**
     * Handle base64 file document
     *
     * @param $referId
     * @param $referType
     * @param $name
     * @return string
     */
    function base64_document($referId, $referType)
    {
        $document = Media::where('refer_id', $referId)->where('refer_type', $referType)->first();
        $afterBase64 = '';

        if (!empty($document)) {
            $path = $document->path;
            $file = file_get_contents('storage/' . $path);
            $getMimeType = Storage::disk('public')->getMimeType($path);

            $afterBase64 = 'data:' . $getMimeType . ';base64,' . base64_encode($file);
        }

        return $afterBase64;
    }
}
