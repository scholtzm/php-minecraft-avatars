# Minecraft Avatars in PHP

This is a set of PHP classes which you can use to generate fine-looking avatars from Minecraft skins.

## Types

There are currently 4 different types available.

#### Avatar

Generates image from the face region of player's Minecraft skin.

![Avatar](img/avatar.png)

#### Skin

Generates image from the body region (front) of player's Minecraft skin.

![Skin](img/skin.png)

#### Combo

Generates image combining face and body region of player's Minecraft skin.

![Combo](img/combo.png)

#### Isometric

Generates 3D-like image from the head region of player's Minecraft skin.

![Isometric](img/isometric.png)

## Usage

All 4 classes are used in a very similar fashion.

```php
require_once("avatar.class.php");

// parameters: Minecraft username (case sensitive!), size
$avatar = new Avatar("The_HusKy", 64);
$avatar->show()
```

Combo class has 2 special methods `setX` and `setY` which allow you to move the full around.

## License

MIT. See `LICENSE`.
