<?php

function is_valid_date($date = '', $format = 'Y-m-d')
{
    try {

        if ($date == '')
            return false;

        $format_check_list = ['Y-m-d', 'Y/m/d', 'Y-m-d H:i:s'];
        if (!in_array($format, $format_check_list))
            return false;

        switch ($format) {
            case 'Y-m-d':

                $date_detail = explode('-', $date);
                if (sizeof($date_detail) != 3)
                    return false;

                $Y = $date_detail[0];
                $m = $date_detail[1];
                $d = $date_detail[2];

                if (4 < mb_strlen($Y) || mb_strlen($Y) < 4 || is_numeric($Y) == false)
                    return false;

                if (2 < mb_strlen($m) || is_numeric($m) == false)
                    return false;

                if (2 < mb_strlen($d) || is_numeric($d) == false)
                    return false;

                return checkdate($m, $d, $Y);
                break;
            case 'Y/m/d':

                $date_detail = explode('/', $date);
                if (sizeof($date_detail) != 3)
                    return false;

                $Y = $date_detail[0];
                $m = $date_detail[1];
                $d = $date_detail[2];

                if (4 < mb_strlen($Y)
                    || mb_strlen($Y) < 4
                    || is_numeric($Y) == false)
                    return false;

                if (2 < mb_strlen($m) || is_numeric($m) == false)
                    return false;

                if (2 < mb_strlen($d) || is_numeric($d) == false)
                    return false;

                return checkdate($m, $d, $Y);
                break;
            case 'Y-m-d H:i:s':

                $date_tmp = explode(' ', $date);
                $date_detail = explode('-', $date_tmp[0]);
                $time_detail = explode(':', $date_tmp[1]);

                if (sizeof($date_detail) != 3 || sizeof($time_detail) != 3)
                    return false;

                $Y = $date_detail[0];
                $m = $date_detail[1];
                $d = $date_detail[2];

                if (4 < mb_strlen($Y)
                    || mb_strlen($Y) < 4
                    || is_numeric($Y) == false)
                    return false;

                if (2 < mb_strlen($m) || is_numeric($m) == false)
                    return false;

                if (2 < mb_strlen($d) || is_numeric($d) == false)
                    return false;

                $is_valid_date = checkdate($m, $d, $Y);
                if ($is_valid_date == false)
                    return false;

                if (24 < intval($time_detail[0])
                    || 2 < mb_strlen($time_detail[0])
                    || is_numeric($time_detail[0]) == false
                    || intval($time_detail[0]) < 0)
                    return false;

                if (60 < intval($time_detail[1])
                    || 2 < mb_strlen($time_detail[1])
                    || is_numeric($time_detail[1]) == false
                    || intval($time_detail[0]) < 0)
                    return false;

                if (60 < intval($time_detail[2])
                    || 2 < mb_strlen($time_detail[2])
                    || is_numeric($time_detail[2]) == false
                    || intval($time_detail[2]) < 0)
                    return false;
                return true;
                break;
            default:
                return false;
                break;
        }
    } catch (\Throwable $e) {
        throw $e;
    }
}

function format_date($date = '', $format_from = DATE_FORMAT, $format_to = DATE_FORMAT)
{
    try {

        if ($date == '')
            return date($format_to);

        if (is_valid_date($date, $format_from) == false)
            return $date;

        return date($format_to, strtotime($date));

    } catch (\Throwable $e) {
        throw $e;
    }

}

function paginator($page, $limit, $total, $event)
{
    try {
        $links = 3;
        if ($total == 0) {
            return;
        }
        $min = ($page - 1) * $limit + 1;
        if ($min > $total) {
            $min = $total;
        }

        $max = ($page - 1) * $limit + $limit;
        if ($max > $total) {
            $max = $total;
        }
        $pages = ceil($total / $limit) > 0 ? ceil($total / $limit) : 1;

        $first = 1;
        $prev = $page - 1;
        if ($prev <= 0) {
            $prev = $page;
        }
        $last = $pages;
        $next = $page + 1;
        if ($next > $pages) {
            $next = $pages;
        }

        $start = $page - $links > 0 ? $page - $links : 1;
        $end = $page + $links < $pages ? $page + $links : $pages;

        $arrBtn = range($start, $end);

        return view(
            "components.paging",
            [
                "min" => $min,
                "max" => $max,
                "total" => $total,
                "first" => $first,
                "prev" => $prev,
                "next" => $next,
                "last" => $last,
                "page" => $page,
                "pages" => $pages,
                "event" => $event,
                "arrBtn" => $arrBtn,
            ]
        )->render();
    } catch (\Throwable $e) {
        throw $e;
    }
}

function export_to_csv($data)
{
    try {
        $file_tmp = "/tmp/tmpfile." . date('Ymdhis') . ".csv";
        $file = fopen($file_tmp, 'w');

        //add BOM to fix UTF-8 in Excel
        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        $delimiter = ",";
        foreach ($data as $item) {
            fputcsv($file, $item, $delimiter);
        }
        fclose($file);

        return $file_tmp;
    } catch (\Throwable $e) {
        throw $e;
    }
}

function url_encode_file_name($file_name, $utf_8 = true)
{
    try {
        if ($file_name == "") {
            return "";
        }

        if ($utf_8 == true) {
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $base_file_name = mb_substr($file_name, 0, mb_strlen($file_name, "UTF-8") - (mb_strlen($ext, "UTF-8") + 1), "UTF-8");
            $file_name_encode = urlencode($base_file_name) . "." . $ext;
        } else {
            $file_name_encode = mb_convert_kana($file_name, "KV", "UTF8");
            $file_name_encode = htmlspecialchars($file_name_encode);
            $file_name_encode = str_replace("\\\\", "\\", $file_name_encode);
            $file_name_encode = str_replace("\\\"", "\"", $file_name_encode);
            $file_name_encode = str_replace("\\'", "'", $file_name_encode);
            $file_name_encode = str_replace("\\&", "&", $file_name_encode);
        }
        return $file_name_encode;
    } catch (\Throwable $e) {
        throw $e;
    }
}
