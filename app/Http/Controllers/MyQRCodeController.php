<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class MyQRCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myqr()
    {
        $user = auth()->user();

        $url = url('/login?t=').time().'&u='.$user->id;

        $qr = new QrCode($url);
        $qr->setSize(700);
        $qr->setMargin(20);


        $src = (new Foo)->getImage($qr);
        $dest = imagecreatefromjpeg(resource_path('assets/img/ldbc.jpg'));

        imagecopy($dest, $src, 140, 2460, 0, 0, 740, 740);

        ob_start();
        imagejpeg($dest);
        $img = ob_get_clean();

        return view('qr', ['img' => 'data:image/jpeg;base64,'.base64_encode($img)]);
    }
}

class Foo extends PngWriter
{
    public function getImage(QrCode $qrCode)
    {
        $data = $this->getData($qrCode);

        $image = imagecreatetruecolor($data['outer_width'], $data['outer_height']);
        $foregroundColor = imagecolorallocatealpha($image, $qrCode->getForegroundColor()['r'], $qrCode->getForegroundColor()['g'], $qrCode->getForegroundColor()['b'], $qrCode->getForegroundColor()['a']);
        $backgroundColor = imagecolorallocatealpha($image, $qrCode->getBackgroundColor()['r'], $qrCode->getBackgroundColor()['g'], $qrCode->getBackgroundColor()['b'], $qrCode->getBackgroundColor()['a']);
        imagefill($image, 0, 0, $backgroundColor);

        foreach ($data['matrix'] as $row => $values) {
            foreach ($values as $column => $value) {
                if (1 === $value) {
                    $x = $data['margin_left'] + $data['block_size'] * $column;
                    $y = $data['margin_left'] + $data['block_size'] * $row;
                    imagefilledrectangle($image, $x, $y, $x + $data['block_size'], $y + $data['block_size'], $foregroundColor);
                }
            }
        }

        return $image;
    }
}
