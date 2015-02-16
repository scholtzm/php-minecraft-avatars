<?php
/*
	Minecraft Skin Class
	https://github.com/scholtzm/php-minecraft-avatars
*/

require_once("base.class.php");

class Skin extends Base {
	protected $BASE_SIZE = 32;

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
		imagesavealpha($this->skin, true);

		$this->image = $this->createTransparentImage($this->BASE_SIZE / 2, $this->BASE_SIZE);

		// face
		imagecopyresampled($this->image, $this->skin, 4, 0, 8, 8, 8, 8, 8, 8);
		// face gear
		if($this->checkHatTransparency())
			imagecopyresampled($this->image, $this->skin, 4, 0, 40, 8, 8, 8, 8, 8);
		// body
		imagecopyresampled($this->image, $this->skin, 4, 8, 20, 20, 8, 12, 8, 12);
		// left arm
		imagecopyresampled($this->image, $this->skin, 0, 8, 44, 20, 4, 12, 4, 12);
		// right arm - must FLIP
		imagecopyresampled($this->image, $this->skin, 12, 8, 47, 20, 4, 12, -4, 12);
		// left leg
		imagecopyresampled($this->image, $this->skin, 4, 20, 4, 20, 4, 12, 4, 12);
		// right leg - must FLIP
		imagecopyresampled($this->image, $this->skin, 8, 20, 7, 20, 4, 12, -4, 12);
	}

	/**
	 * Overriden resize method
	 */
	protected function resize() {
		$imgResized = $this->CreateTransparentImage($this->size / 2, $this->size);
		imagecopyresampled($imgResized, $this->image, 0, 0, 0, 0, $this->size / 2, $this->size, $this->BASE_SIZE / 2, $this->BASE_SIZE);
		imagedestroy($this->image);
		$this->image = $imgResized;
	}
}