<?php


namespace App\Utils;


class StringUtil
{
    public static function getParamValueOfQueryStringUrl($url, $paramName ) {
        if ($url) {
            $params = null;
            parse_str(parse_url($url)['query'], $params);
            return $params[$paramName];
        }
        return null;
    }

    public static function getUrlThumbnailVideoYoutube($videoId) {
        if ($videoId) {
            return "https://img.youtube.com/vi/$videoId/hqdefault.jpg";
        }
        return null;
    }
}
