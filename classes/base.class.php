<?php
/*
    Minecraft Avatars Base Class
    https://github.com/scholtzm/php-minecraft-avatars
*/

abstract class Base {
    protected $CACHE     = "cache/base/";
    protected $BASE_URL  = "http://skins.minecraft.net/MinecraftSkins/";

    protected $name;         // player's name
    protected $size;         // image height
    protected $url;          // base skin url

    protected $skin;         // skin source
    protected $lastModified; // cache control
    protected $image;        // final image

    /**
     * Class constructor
     */
    protected function __construct($name, $size) {
        $this->name = $name;
        $this->size = $size;
        $this->url = $this->BASE_URL . $name . ".png";
    }

    /**
     * Execute all methods
     */
    public function show() {
        $skinExists = $this->loadSkin();

        // Check cache...
        $headers = getallheaders();
        if(isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == $this->lastModified)) {
            header("Last-Modified: " . gmdate("D, d M Y H:i:s", $this->lastModified) . " GMT", true, 304);
            if($skinExists) imagedestroy($this->skin);
            return true;
        }

        if($skinExists) {
            $this->createImage();

            if($this->BASE_SIZE != $this->size)
                $this->resize();

            $this->output();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Load the skin
     */
    protected function loadSkin() {
        if($this->name === NULL)
            return false;

        $path = $this->CACHE . $this->name . ".png";

        if(!file_exists($path)) {
            $this->skin = @imagecreatefrompng($this->url);

            if($this->skin === false)
                return false;

            imagesavealpha($this->skin, true);
            imagepng($this->skin, $path);
            $this->lastModified = time();
        } else {
            $this->skin = @imagecreatefrompng($path);
            $this->lastModified = filemtime($path);
        }

        return true;
    }

    /**
     * Output into browser
     */
    protected function output() {
        header("Content-type: image/png");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", $this->lastModified) . " GMT");

        imagepng($this->image);
        imagedestroy($this->image);
        imagedestroy($this->skin);
    }

    /**
     * Resize method
     */
    protected function resize() {
        $imgResized = imagecreatetruecolor($this->size, $this->size);
        imagecopyresampled($imgResized, $this->image, 0, 0, 0, 0, $this->size, $this->size, $this->BASE_SIZE, $this->BASE_SIZE);
        imagedestroy($this->image);
        $this->image = $imgResized;
    }

    /**
     * Helper method to detect transparent hats
     */
    protected function checkHatTransparency() {
        for($i = 0; $i < 8; $i++) {
            for($j = 0; $j < 8; $j++) {
                $rgb = imagecolorsforindex($this->skin, imagecolorat($this->skin, 40+$j, 8+$i));
                if($rgb["alpha"] == 127) {
                    return true;
                    break;
                }
            }
        }
        return false;
    }

    /**
     * Helper method to create transparent image
     */
    protected function createTransparentImage($width, $height) {
        $image = imagecreatetruecolor($width, $height);

        imagealphablending($image, true);
        $color = imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
        imagefill($image, 0, 0, $color);
        imagesavealpha($image, true);

        return $image;
    }

    /**
     * Method to create image
     * This method needs to be implemented by the inheriting class
     */
    abstract protected function createImage();
}
