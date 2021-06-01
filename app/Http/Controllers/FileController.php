<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProductModel;

class FileController extends Controller
{
    public function __construct()
    {
    }

    public function download(Request $request)
    {
        try {
            $file_name = $request->get('file_name', '');
            $file_path = $request->get('file_path', '');

            header('Content-Type: application/octet-stream; charset=utf-8');
            $user_agent = $request->header('User-Agent');
            if (preg_match('/MSIE/i', $user_agent) || preg_match('/Trident/i', $user_agent)) {
                $file_name_encode = url_encode_file_name($file_name, true);
                header("Content-Disposition: attachment; filename*=UTF-8''$file_name_encode");
            } else {
                $file_name_encode = url_encode_file_name($file_name, false);
                header('Content-Disposition: attachment; filename="' . $file_name_encode . '"');
            }
            header("Cache-Control: public");
            header("Pragma: public");
            if (readfile($file_path)) {
                unlink($file_path);
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

}
