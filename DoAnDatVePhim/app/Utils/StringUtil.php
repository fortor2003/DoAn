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


    /**
     * Trả về kết quả kiểm tra xem một ngày có hợp lệ không
     * @param string $date có dạng yyyy-mm-dd
     * @return bool
     */
    public static function isValidDate($date) {
        return $date ? (bool)strtotime($date) : false;
    }
}
