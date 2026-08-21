<?php
if (!extension_loaded('gd')) {
    echo 'GD not available'; exit;
}

function createIcon($size) {
    $img = imagecreatetruecolor($size, $size);
    $blue = imagecolorallocate($img, 37, 99, 235);
    $white = imagecolorallocate($img, 255, 255, 255);
    imagefill($img, 0, 0, $blue);

    $s = $size / 512;

    // Draw upward chart line (thick white)
    $pts = [
        [80, 380], [180, 260], [280, 310], [420, 140]
    ];
    for ($t = -10; $t <= 10; $t++) {
        for ($i = 0; $i < count($pts) - 1; $i++) {
            imageline($img,
                (int)($pts[$i][0] * $s),
                (int)(($pts[$i][1] + $t) * $s),
                (int)($pts[$i+1][0] * $s),
                (int)(($pts[$i+1][1] + $t) * $s),
                $white
            );
        }
    }
    return $img;
}

$img = createIcon(192);
imagepng($img, __DIR__ . '/icon-192.png');
imagedestroy($img);

$img = createIcon(512);
imagepng($img, __DIR__ . '/icon-512.png');
imagedestroy($img);

echo 'Icons generated OK';
