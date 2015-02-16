<?php
/*
    Minecraft Isometric Class
    https://github.com/scholtzm/php-minecraft-avatars
*/

require_once("base.class.php");

class Isometric extends Base {
    protected $BASE_SIZE = 256;

    /**
     * Class constructor
     */
    public function __construct($name, $size) {
        parent::__construct($name, $size);
    }

    /**
     * Concrete implementation of the CreateImage() method.
     */
    public function CreateImage() {
        $this->image = $this->CreateTransparentImage(256, 256);
        $trans = $this->CheckHatTransparency();

        // front
        for($i = 0; $i < 128; $i++) {
            for($j = 0; $j < 128; $j++) {
                $rgb = imagecolorsforindex($this->skin, imagecolorat($this->skin, 8+floor($j / 16), 8+floor($i / 16)));
                imagesetpixel($this->image, $j, 64+$i+((int)($j / 2)), imagecolorallocatealpha($this->image, $rgb["red"], $rgb["green"], $rgb["blue"], $rgb["alpha"]));
            }
        }

        // front gear
        if($trans) {
            for($i = 0; $i < 128; $i++) {
                for($j = 0; $j < 128; $j++) {
                    $rgb = imagecolorsforindex($this->skin, imagecolorat($this->skin, 40+floor($j / 16), 8+floor($i / 16)));
                    imagesetpixel($this->image, $j, 64+$i+((int)($j / 2)), imagecolorallocatealpha($this->image, $rgb["red"], $rgb["green"], $rgb["blue"], $rgb["alpha"]));
                }
            }
        }

        // side
        for($i = 0; $i < 128; $i++) {
            for($j = 0; $j < 128; $j++) {
                $rgb = imagecolorsforindex($this->skin, imagecolorat($this->skin, 16+floor($j / 16), 8+floor($i / 16)));
                imagesetpixel($this->image, 128+$j, 128+$i-((int)($j / 2)), imagecolorallocatealpha($this->image, $rgb["red"], $rgb["green"], $rgb["blue"], $rgb["alpha"]));
            }
        }

        // side gear
        if($trans) {
            for($i = 0; $i < 128; $i++) {
                for($j = 0; $j < 128; $j++) {
                    $rgb = imagecolorsforindex($this->skin, imagecolorat($this->skin, 48+floor($j / 16), 8+floor($i / 16)));
                    imagesetpixel($this->image, 128+$j, 128+$i-((int)($j / 2)), imagecolorallocatealpha($this->image, $rgb["red"], $rgb["green"], $rgb["blue"], $rgb["alpha"]));
                }
            }
        }

        // top
        for($i = 0; $i < 128; $i++) {
            for($j = 0; $j < 128; $j++) {
                $rgb = imagecolorsforindex($this->skin, imagecolorat($this->skin, 8+floor($j / 16), 0+floor($i / 16)));
                imagesetpixel($this->image, 128+$j-(floor($i/2)*2), $i+floor($j/2)-floor($i/2), imagecolorallocatealpha($this->image, $rgb["red"], $rgb["green"], $rgb["blue"], $rgb["alpha"]));
            }
        }

        // top gear
        for($i = 0; $i < 128; $i++) {
            for($j = 0; $j < 128; $j++) {
                $rgb = imagecolorsforindex($this->skin, imagecolorat($this->skin, 40+floor($j / 16), 0+floor($i / 16)));
                imagesetpixel($this->image, 128+$j-(floor($i/2)*2), $i+floor($j/2)-floor($i/2), imagecolorallocatealpha($this->image, $rgb["red"], $rgb["green"], $rgb["blue"], $rgb["alpha"]));
            }
        }
    }

    /**
     * Overriden resize method
     */
    protected function resize() {
        $imgResized = $this->CreateTransparentImage($this->size, $this->size);
        imagecopyresampled($imgResized, $this->image, 0, 0, 0, 0, $this->size, $this->size, $this->BASE_SIZE, $this->BASE_SIZE);
        imagedestroy($this->image);
        $this->image = $imgResized;
    }
}
