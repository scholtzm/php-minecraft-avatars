<?php
/*
    Minecraft Avatar Class
    https://github.com/scholtzm/php-minecraft-avatars
*/

require_once("base.class.php");

class Avatar extends Base {
    protected $BASE_SIZE = 8;

    /**
     * Class constructor
     */
    public function __construct($name, $size) {
        parent::__construct($name, $size);
    }

    /**
     * Concrete implementation of the CreateImage() method.
     */
    protected function createImage() {
        $size = $this->BASE_SIZE;

        imagesavealpha($this->skin, true);
        $this->image = imagecreatetruecolor($size, $size);

        // face
        imagecopyresampled($this->image, $this->skin, 0, 0, 8, 8, $size, $size, 8, 8);
        // face gear
        if($this->checkHatTransparency())
            imagecopyresampled($this->image, $this->skin, 0, 0, 40, 8, $size, $size, 8, 8);
    }
}
