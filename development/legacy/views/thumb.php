<?

$img = $_GET['img'];

$fmt = formatoImg($img);

if (($fmt == "jpg")) {
    header("Content-type: image/jpeg");
    $tmpname = "imgcache/" . md5($img . $_GET["w"] . $_GET["h"]);
    if (file_exists($tmpname)) {
        echo file_get_contents($tmpname);
        die;
    } else {
        $im = imagecreatefromjpeg($img);
    }
}

if (($fmt == "png")) {
    $im = imagecreatefrompng($img);
    header("Content-type: image/png");
}

if (($fmt == "bmp")) {
    $im = imagecreatefromwbmp($img);
    header("Content-type: image/jpeg");
}


if (($fmt == "gif")) {
    $im = imagecreatefromgif($img);
    header("Content-type: image/gif");
}

$wid = (int) $_GET["w"];
$hei = (int) $_GET["h"];

if (($wid <> 0) || ($hei <> 0)) {
    $w = imagesx($im);
    $h = imagesy($im);

    $w1 = $w / $wid;
    if ($hei == 0) {
        $h1 = $w1;
        $hei = $h / $w1;
    } else {
        $h1 = $h / $hei;
    }
    // echo "$h1 - $w1";
    $min = min($w1, $h1);

    $xt = $min * $wid;
    $x1 = ($w - $xt) / 2;
    $x2 = $w - $x1;

    $yt = $min * $hei;
    $y1 = ($h - $yt) / 2;
    $y2 = $h - $y1;

    $x1 = (int) $x1;
    $x2 = (int) $x2;
    $y1 = (int) $y1;
    $y2 = (int) $y2;

    $im2 = imagecreatetruecolor($wid, $hei);

    $img = NULL;

    $img = imagecreatetruecolor($wid, $hei);
    imagecolorallocate($img, 255, 255, 255);

    $c = imagecolorallocate($img, 255, 255, 255);
    $c1 = imagecolorallocate($img, 0, 0, 0);

    for ($i = 0; $i <= $hei; $i++) {
        imageline($img, 0, $i, $wid, $i, $c);
    }

    imagecopyresampled($img, $im, 0, 0, $x1, $y1, $wid, $hei, $x2 - $x1, $y2 - $y1);

    $w = $wid;
    $h = $hei;
} else {
    $img = &$im;
    $w = imagesx($im);
    $h = imagesy($im);
}

if (($fmt == "jpg")) {
    imagejpeg($img, $tmpname, 80);
    echo file_get_contents($tmpname);
}

if (($fmt == "png")) {
    imagepng($img);
}

if (($fmt == "bmp")) {
    imagejpeg($img);
}

if (($fmt == "gif")) {
    imagegif($img);
}

function getMimeType($file_path) {
    $mtype = '';
    if (function_exists('mime_content_type')) {
        $mtype = mime_content_type($file_path);
    } else if (function_exists('finfo_file')) {
        $finfo = finfo_open(FILEINFO_MIME);
        $mtype = finfo_file($finfo, $file_path);
        finfo_close($finfo);
    }
    if ($mtype == '') {
        $mtype = "application/force-download";
    }
    return $mtype;
}

function formatoImg($img) {
    $mime = getMimeType($img);

    if (strpos("@" . $mime, "jpeg"))
        return "jpg";
    if (strpos("@" . $mime, "gif"))
        return "gif";
    if (strpos("@" . $mime, "png"))
        return "png";
    if (strpos("@" . $mime, "bmp"))
        return "bmp";

    if (file_exists($img))
        $fp = fopen($img, "r");

    if ($fp) {
        $cabec = fread($fp, 10);

        if (strpos("@" . $cabec, "JFIF"))
            return "jpg";
        if (strpos("@" . $cabec, "GIF89"))
            return "gif";
        if (strpos("@" . $cabec, "PNG"))
            return "png";
        if (strpos("@" . $cabec, "BM"))
            return "bmp";
    }

    return "jpg";
}

?>
