# TableGenerator

[![DUB](https://img.shields.io/dub/l/vibe-d.svg)](./LICENSE.md)

Object Oriented PHP library to generate HTML tables

### Requirements

 * PHP 5.3+

### Installation

```cli
 $ composer require lasyntez/table-generator
```

### Basic usage

AndroidBitmapGenerator is the wrapper that allows Android developers to generate bitmaps of every density (mdpi - hdpi - xhdpi - xxhdpi - xxxhdpi) on the fly just by providing the original image path. Two drivers are supported GD (by default) and Imagick. The Imagick driver seems to be more efficient when the output format is png but multiple combinations are possible to optimize the output.

```php
<?php

require 'vendor/autoload.php';

use ImageFactory\Android\Density\AndroidBitmapGenerator;

$generator = new AndroidBitmapGenerator('images/neptune.jpg');
$generator->execute();

/* CHANGE THE DRIVER IF NEEDED */
$generator->setDriver(ImageGeneratorInterface::DRIVER_IMAGICK)->execute();
```

This is as simple as that, the files will be generated in the same directory as the source image with the same name suffixed with the relative density. (e.g. neptune-mdpi.jpg).

A different name can be given to the generated files either via the constructor as the second argument or by calling the appropriate method
```php
<?php

$generator = new AndroidBitmapGenerator('images/neptune.jpg');
$generator->setOutputPath('output/saturn.jpg')
		  ->execute();

/* OR */

$generator = new AndroidBitmapGenerator('images/neptune.jpg', 'output/saturn.jpg');
$generator->execute();

```

According to the [documentation](http://developer.android.com/guide/practices/screens_support.html#xxxhdpi-note), bitmaps for xxxhdpi should only be generated for launcher icons otherwise the highest density should be xxhdpi for regular bitmaps. By default the bitmap type is set to regular in order to generate 4 files instead of 5 for a launcher icon.

```php
<?php

use ImageFactory\Android\Density\AndroidBitmapGenerator;

$generator->setBitmapType(AndroidBitmapGenerator::BITMAP_TYPE_ICON_LAUNCHER);
          //->setBitmapType(AndroidBitmapGenerator::BITMAP_TYPE_REGULAR); (default)


```

The reference size which refers to the highest density can be set either via the constructor or by calling the appropriate setters. Otherwise it will be equivalent to the original image size by default.
```php
<?php

$generator = new AndroidBitmapGenerator('images/neptune.jpg', null, 400, 300);
$generator->execute();

/* OR */

$generator = new AndroidBitmapGenerator('images/neptune.jpg');
$generator->setReferenceWidth(400)
          ->setReferenceHeight(300)
          //->setReferenceSize(400, 300)
		  ->execute();
```


To define a new reference size when the source image has changed, make sure to call *setReferenceSize* (or *setReferenceWidth* and/or *setReferenceHeight*) after *setImagePath* to override the previous one.

```php
<?php

$generator = new AndroidBitmapGenerator('images/neptune.jpg');
$generator->setImagePath(__DIR__.'/images/mars.jpg')
		  ->setReferenceSize(400, 300)
          //->setReferenceWidth(400)
          //->setReferenceHeight(300)
		  ->execute();
```

Two compression types are supported :
- png (default one)
- jpeg

It only has to be set when the output format is jpeg given that the default compression type is png. The *setCompression* method takes two arguments, the first one is the type (png or jpeg) and the second one is its value.
The default compression level for png files is 7 (a value from 0 to 9 is required) whereas 75 is the default one for jpeg files (its value should be between 0 and 100).

```php
<?php

use ImageFactory\Image\ImageGeneratorInterface;

$generator = new AndroidBitmapGenerator('/images/neptune.jpg');
	$generator
	          ->setCompression(ImageGeneratorInterface::COMPRESSION_JPEG, ImageGeneratorInterface::COMPRESSION_JPEG_DEFAULT_LEVEL)
  			  ->execute();
```


### Roadmap

 * Animated gif support


### License

MIT License. See the [file](./LICENSE.md)
