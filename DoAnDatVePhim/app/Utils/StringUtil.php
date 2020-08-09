<?php


namespace App\Utils;


class StringUtil
{
    public static function getParamValueOfQueryStringUrl(string $url, string $paramName ): string {
        $params = null;
        parse_str(parse_url($url)['query'], $params);
        return $params[$paramName];
    }

    public static function getUrlThumbnailVideoYoutube(string $videoId): string {
        return "https://img.youtube.com/vi/$videoId/hqdefault.jpg";
    }
}
