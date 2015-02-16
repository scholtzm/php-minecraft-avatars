<?php
/*
    Minecraft Combo Class
    https://github.com/scholtzm/php-minecraft-avatars
*/

require_once("base.class.php");

class Combo extends Base {
    protected $BASE_SIZE = 64;
    private $x           = 46;
    private $y           = 30;

    /**
     * Class constructor
     */
    public function __construct($name, $size) {
        parent::__construct($name, $size);
    }

    /**
     * Concrete implementation of the CreateImage() method.
     */
    public function createImage() {
        $size = $this->BASE_SIZE;
        $trans = $this->checkHatTransparency();

        imagesavealpha($this->skin, true);
        $this->image = imagecreatetruecolor($size, $size);

        // Background
        // face
        imagecopyresampled($this->image, $this->skin, 0, 0, 8, 8, $size, $size, 8, 8);
        // face gear
        if($trans)
            imagecopyresampled($this->image, $this->skin, 0, 0, 40, 8, $size, $size, 8, 8);

        // white shadow - start
        $head = imagecreate(10, 10);
        $white = imagecolorallocate($head, 255, 255, 255);
        imagecopyresampled($this->image, $head, $this->x+3, $this->y-1, 0, 0, 10, 10, 10, 10);
        imagecolordeallocate($head, $white);
        imagedestroy($head);

        $torso = imagecreate(18, 14);
        $white = imagecolorallocate($torso, 255, 255, 255);
        imagecopyresampled($this->image, $torso, $this->x-1, $this->y+7, 0, 0, 18, 14, 18, 14);
        imagecolordeallocate($torso, $white);
        imagedestroy($torso);

        $legs = imagecreate(10, 14);
        $white = imagecolorallocate($legs, 255, 255, 255);
        imagecopyresampled($this->image, $legs, $this->x+3, $this->y+19, 0, 0, 10, 14, 10, 14);
        imagecolordeallocate($legs, $white);
        imagedestroy($legs);
        // white shadow - end

        // Foreground
        // face
        imagecopyresampled($this->image, $this->skin, $this->x+4, $this->y, 8, 8, 8, 8, 8, 8);
        // face gear
        if($trans)
            imagecopyresampled($this->image, $this->skin, $this->x+4, $this->y, 40, 8, 8, 8, 8, 8);
        // body
        imagecopyresampled($this->image, $this->skin, $this->x+4, $this->y+8, 20, 20, 8, 12, 8, 12);
        // left arm
        imagecopyresampled($this->image, $this->skin, $this->x, $this->y+8, 44, 20, 4, 12, 4, 12);
        // right arm - must FLIP
        imagecopyresampled($this->image, $this->skin, $this->x+12, $this->y+8, 47, 20, 4, 12, -4, 12);
        // left leg
        imagecopyresampled($this->image, $this->skin, $this->x+4, $this->y+20, 4, 20, 4, 12, 4, 12);
        // right leg - must FLIP
        imagecopyresampled($this->image, $this->skin, $this->x+8, $this->y+20, 7, 20, 4, 12, -4, 12);
    }

    /**
     * Setters
     */
    public function setx($x) {
        $this->x = $x;
    }

    public function setY($y) {
        $this->y = $y;
    }
}
