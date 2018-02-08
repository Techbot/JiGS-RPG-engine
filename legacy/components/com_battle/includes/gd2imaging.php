<?php

/**
 * GD2 Imaging (part of Lotos Framework)
 *
 * Copyright (c) 2005-2011 Artur Graniszewski (aargoth@boo.pl)
 * All rights reserved.
 *
 * @category   Library
 * @package    Lotos
 * @subpackage Imaging
 * @copyright  Copyright (c) 2005-2011 Artur Graniszewski (aargoth@boo.pl)
 * @license    GNU LESSER GENERAL PUBLIC LICENSE Version 3, 29 June 2007
 * @version    1.7.1
 */

/**
 * Pixel shader class.
 */
class Shader
{
	/**
	 * Shader drawing mode: use integer values of imagecolorat() only (fastest mode)
	 */
	const USE_INT = 1;

	/**
	 * Shader drawing mode: calculate RGB values from integer returned by imagecolorat() (fast mode)
	 */
	const USE_RGB = 2;

	/**
	 * Shader drawing mode: calculate HSV values from integer returned by imagecolorat() (slowest mode)
	 * This mode enables USE_RGB automatically.
	 */
	const USE_HSV = 4;

	/**
	 * Shader drawing mode: Operate on alpha channel.
	 */
	const USE_ALPHA = 8;

	/**
	 * Shader instructions (PHP code).
	 *
	 * @var string
	 */
	protected $shaderContent = '';

	/**
	 * Shader drawing mode.
	 *
	 * @var int
	 */
	protected $shaderMode = self::USE_HSV;

	/**
	 * Shaders' active area.
	 *
	 * @var Point[]
	 */
	protected $area = null;

	/**
	 * Shader constructor
	 *
	 * @param mixed $shaderContent Shader instructions (PHP code).
	 * @return Shader
	 */
	public function __construct($shaderContent = '') {
		$this->shaderContent = $shaderContent;
	}

	/**
	 * Returns the drawing mode (bitmask) of this shader.
	 *
	 * @param int $shaderMode Shader drawing mode: Shader::USE_INT, Shader::USE_RGB, Shader::USE_HSV (default), etc.
	 * @return Shader
	 */
	public function setMode($shaderMode) {
		$this->shaderMode = $shaderMode;
		return $this;
	}

	/**
	 * Returns the drawing mode (bitmask) of this shader.
	 *
	 * @return int
	 */
	public function getMode() {
		return $this->shaderMode;
	}

	/**
	 * Sets the position of an active area (shader effects will be applied only to this area).
	 *
	 * @param Point $topLeftPosition Top left position of the area.
	 * @param Point $$bottomRightPosition Bottom right position of the area.
	 * @return Shader
	 */
	public function useArea(Point $topLeftPosition, Point $bottomRightPosition) {
		if($topLeftPosition->x > $bottomRightPosition->x) {
			$tmp = $topLeftPosition->x;
			$topLeftPosition->x = $bottomRightPosition->x;
			$bottomRightPosition->x = $tmp;
		}
		if($topLeftPosition->y > $bottomRightPosition->y) {
			$tmp = $topLeftPosition->y;
			$topLeftPosition->y = $bottomRightPosition->y;
			$bottomRightPosition->y = $tmp;
		}

		$this->area = array($topLeftPosition, $bottomRightPosition);
		return $this;
	}

	/**
	 * Returns the position of an active area (an array of two points: top left, and bottom right)
	 *
	 * @return Point[]
	 */
	public function getArea() {
		return $this->area;
	}

	/**
	 * Returns shader instructions (PHP code).
	 *
	 * @return string
	 */
	public function getInstructions() {
		return $this->shaderContent;
	}
}

/**
 * Stores point position.
 */
class Point
{
	/**
	 * Point X coordinate.
	 *
	 * @var int
	 */
	public $x;

	/**
	 * Point Y coordinate.
	 *
	 * @var int
	 */
	public $y;

	/**
	 * Creates Point instance.
	 *
	 * @param int $x Point X coordinate.
	 * @param int $y Point Y coordinate.
	 * @return Point
	 */
	public function __construct($x, $y) {
		$this->x = $x;
		$this->y = $y;
	}

	/**
	 * Returns position of the pixel.
	 *
	 * @return int[] X and Y coordinates of the pixel.
	 */
	public function getPosition() {
		return array($this->x, $this->y);
	}
}

/**
 * Describes image color.
 */
class Color
{
	const RED = 1;
	const GREEN = 2;
	const BLUE = 4;

	/**
	 * HSL color model.
	 */
	const HSL = 8;

	/**
	 * HSV color model.
	 */
	const HSV = 16;

	/**
	 * HSI color model.
	 */
	const HSI = 32;

	/**
	 * RGB value of the color.
	 *
	 * @var int
	 */
	public $rgb;

	/**
	 * Creates color instance.
	 *
	 * @param int $rgbOrRedValue Full RGB value or Red value (as int)
	 * @param mixed $greenValue Green value (if $rgbOrRedValue does not contain entire RGB value)
	 * @param mixed $blueValue Blue value (if $rgbOrRedValue does not contain entire RGB value)
	 * @return Color
	 */
	public function __construct($rgbOrRedValue, $greenValue = null, $blueValue = null) {
		if($greenValue === null && $blueValue === null) {
			$this->rgb = $rgbOrRedValue;
			return;
		}

		$this->rgb = ($rgbOrRedValue << 16) + ($greenValue << 8) + $blueValue;
	}

	/**
	 * Calculates a value of a red component of the RGB value.
	 *
	 * Note: should not be used for performance reasons (reason PHP < 5.4 functions overhead).
	 * @return int
	 */
	public function getRed($rgb) {
		return ($this->rgb >> 16) & 0xff;
	}

	/**
	 * Calculates a value of a green component of the RGB value.
	 *
	 * Note: should not be used for performance reasons (reason PHP < 5.4 functions overhead).
	 * @return int
	 */
	public function getGreen() {
		return ($this->rgb >> 8) & 0xff;
	}

	/**
	 * Calculates a value of a blue component of the RGB value.
	 *
	 * Note: should not be used for performance reasons (reason PHP < 5.4 functions overhead).
	 * @return int
	 */
	public function getBlue() {
		return $this->rgb & 0xff;
	}

	/**
	 * Returns color chroma.
	 *
	 * @return float
	 */
	public function getChroma() {
		$r = ($this->rgb >> 16) & 0xff;
		$g = ($this->rgb >> 8) & 0xff;
		$r = $this->rgb & 0xff;
		return (max($r, $g, $b) - min($r, $g, $b)) / 255;
	}
	/**
	 * Returns color hue.
	 *
	 * @return int Value in degrees (0 => 360).
	 */
	public function getHue() {
		$r = (($rgb >> 16) & 0xff) / 255;
		$g = (($rgb >> 8) & 0xff) / 255;
		$b = ($rgb & 0xff) / 255;
		$hue = rad2deg(atan2(1.7320508075688 /* = sqrt(3) */ * ($g - $b), 2 * $r - $g - $b));
		return $hue >= 0 ? $hue : 360 + $hue;
	}

	/**
	 * Returns color saturation.
	 *
	 * @param int $colorMode Color mode for saturation (use Color::HSV, Color::HSI or Color::HSL as the value), default is Color::HSL
	 * @return float
	 */
	public function getSaturation($colorMode = self::HSL) {
		$r = (($this->rgb >> 16) & 0xff) / 255;
		$g = (($this->rgb >> 8) & 0xff) / 255;
		$b = ($this->rgb & 0xff) / 255;
		$max = max($r, $g, $b);
		$min = min($r, $g, $b);
		if($max === 0) {
			return 0;
		}
		if($colorMode === self::HSL) {
			$diff = $max - $min;
			//$luminance = ($max + $min) / 2;
			if($diff < 0.5) {
				return $diff / ($max + $min);
			} else {
				return $diff / (2 - $max - $min);
			}
		} else if($colorMode === self::HSV) {
			return ($max - $min) / $max;
		} else if($colorMode === self::HSI) {
			if($max - $min === 0) {
				return 0;
			} else {
				return 1 - $min / (($r + $g + $b) / 3);
			}
		}

		throw new Exception('Unknown color mode');
	}

	/**
	 * Returns hexadecimal representation of the current color.
	 *
	 * @return string
	 */
	public function getHexValue() {
		return str_pad(dechex($this->rgb), 6, '0', STR_PAD_LEFT);
	}

	/**
	 * Returns color luminance.
	 *
	 * @param int $mode Luminance mode: 0 = fastest, 1 = Digital CCIR601, 2 = Digital ITU-R, 3 = HSP (best quality), Color::HSL = HSL (default), Color::HSV = HSV
	 * @return float
	 */
	public function getLuminance($mode = self::HSL) {
		$r = ($this->rgb >> 16) & 0xff;
		$g = ($this->rgb >> 8) & 0xff;
		$b = $this->rgb & 0xff;

		switch ($mode) {
			case 0:
				// fastest, but less accurate.
				return (($r + $r + $r + $b + $g + $g + $g + $g) >> 3) / 255;
				break;
			case 1:
				// Digital CCIR601
				return (int)(0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
				break;
			case 2:
				// Ditigal ITU-R
				return (int)(0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;
				break;
			case 3:
				// HSP algorithm
				return round(sqrt(0.299 * $r * $r + 0.587 * $g * $g + 0.114 * $b * $b)) / 255;
				break;
			case self::HSL:
				// HSL algorithm
				return (max($r, $g, $b) + min($r, $g, $b)) / (2 * 255);
				break;
			case self::HSV:
				// HSV algorithm
				return max($r, $g, $b) / 255;
				break;
			case self::HSI:
				// HSI algorithm
				return ($r + $g + $b) / (3 * 255);
				break;
			default:
				throw new Exception('Unknown color mode');
				break;
		}
	}
}

/**
 * Describes area dimensions.
 */
class Dimensions
{
	/**
	 * Width dimension.
	 *
	 * @var int
	 */
	public $width;

	/**
	 * Height dimension.
	 *
	 * @var int
	 */
	public $height;

	/**
	 * Stores area dimensions.
	 *
	 * @param int $width Width of the area.
	 * @param int $height Height of the area.
	 * @return Dimensions
	 */
	public function __construct($width, $height) {
		$this->width = $width;
		$this->height = $height;
	}

	/**
	 * Returns an array containing width and height of this area.
	 *
	 * @return int[]
	 */
	public function getSize() {
		return array($this->width, $this->height);
	}

	/**
	 * Multiplies width and height by a given values.
	 *
	 * @param int $x Value to multiply a width dimension.
	 * @param int $y Value to multiply a height dimension.
	 * @return Dimensions
	 */
	public function multiply($x, $y) {
		$this->width *= $x;
		$this->height *= $y;
		return $this;
	}

	/**
	 * Adds values to width and height respectively.
	 *
	 * @param int $x Value to add to a width dimension.
	 * @param int $y Value to add to a height dimension.
	 * @return Dimensions
	 */
	public function add($x = 0, $y = 0) {
		$this->width += $x;
		$this->height += $y;
		return $this;
	}

	/**
	 * Returns width of the diagonal line.
	 *
	 * @return double
	 */
	public function getDiagonalWidth() {
		return sqrt($this->width * $this->width + $this->height * $this->height);
	}

	/**
	 * Returns the size of area.
	 *
	 * @return int
	 */
	public function getAreaSize() {
		return $this->width * $this->height;
	}
}

/**
 * Describes color RGB channels.
 */
class Channel
{
	const RED = 1;
	const GREEN = 2;
	const BLUE = 4;
	const RGB = 7;
}

/**
 * Describes vector.
 */
class Vector
{
	/**
	 * An array of components of this vector.
	 *
	 * @var double[]
	 */
	protected $components = array();

	/**
	 * A dimension of this vector.
	 *
	 * @var int
	 */
	protected $dimension;

	/**
	 * An identifier of this vector.
	 *
	 * @var mixed
	 */
	protected $identifier = -1;

	/**
	 * A length of this vector.
	 *
	 * @var int
	 */
	protected $length = null;

	/**
	 * Creates new vector.
	 *
	 * @param int $dimension Dimension of this vector.
	 * @param mixed $identifier Identifier of this vector.
	 * @param double[] $components Components of this vector.
	 * @return Vector
	 */
	public function __construct($dimension, $identifier = -1, $components = null) {
		$this->dimension = $dimension;
		$this->identifier = $identifier;
		$this->components = is_array($components) ? $components : array_fill(0, $dimension, 0);
	}

	/**
	 * Adds noise to this vector.
	 *
	 * @param int $level Noise level.
	 * @return Vector
	 */
	public function addNoise($level) {
		$components = array();
		foreach($this->components as $component) {
			$components[] = $component + rand() * 2 * $level - $level;
		}
		$this->components = $components;
		return $this;
	}

	/**
	 * Returns the dimension of this vector.
	 *
	 * @return int
	 */
	public function getDimensions() {
		return $this->dimension;
	}

	/**
	 * Returns the identifier of this vector.
	 *
	 * @return mixed
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * Sets the identifier of this vector.
	 *
	 * @param string $name
	 * @return void
	 */
	public function setIdentifier($name) {
		$this->identifier = $name;
	}

	/**
	 * Returns components of this vector.
	 *
	 * @return double[]
	 */
	public function toArray() {
		return $this->components;
	}

	/**
	 * Returns a component of this vector.
	 *
	 * @param int $i Index of the component.
	 * @return double Value of the selected component.
	 */
	public function getValue($i) {
		if($i > $this->dimension) {
			throw new Exception();
		} else {
			return $this->components[$i];
		}
	}

	/**
	 * Adds two vectors.
	 *
	 * @param Vector $v A vector to add.
	 * @return Vector
	 */
	public function add(Vector $v) {
		if($this->dimension != $v->getDimensions()) {
			throw new Exception("Both vectors must have the same size");
		}

		$components = array();
		$otherComponents = $v->toArray();
		foreach($this->components as $i => $component) {
			$components[] = $component + $otherComponents[$i];
		}
		$this->components = $components;
		return $this;
	}

	/**
	 * Multiplies two vectors or by a given scalar value.
	 *
	 * @param mixed $v A vector or scalar value to multiply.
	 * @return Vector
	 */
	public function multiply($v) {
		$components = array();
		if(is_object($v)) {
			if(!($v instanceof Vector)) {
				throw new Exception('Unspupported data structure');
			}
			if($this->dimension != $v->getDimensions()) {
				throw new Exception("Both vectors must have the same size");
			}
			$otherComponents = $v->toArray();
			foreach($this->components as $i => $component) {
				$components[] = $component * $otherComponents[$i];
			}
		} else {
			foreach($this->components as $i => $component) {
				$components[] = $component * $v;
			}
		}
		$this->components = $components;
		return $this;
	}

	/**
	 * Negates this vector.
	 *
	 * @return Vector
	 */
	public function negate() {
		$components = array();
		foreach($this->components as $index => $component) {
			$components[$index] = -$component;
		}

		$this->components = $components;
		return $this;
	}

	/**
	 * Adds two vectors.
	 *
	 * @param Vector $v A vector to add.
	 * @return Vector
	 */
	public function substract(Vector $v) {
		if($this->dimension != $v->getDimensions()) {
			throw new Exception("Both vectors must have the same size");
		}

		$components = array();
		$otherComponents = $v->toArray();
		foreach($this->components as $i => $component) {
			$components[] = $component - $otherComponents[$i];
		}
		$this->components = $components;
		return $this;
	}

	/**
	 * Returns substracted length
	 *
	 * @param Vector $v A vector to substract
	 * @return float
	 */
	public function getSubstractedLength(Vector $v) {
		if($this->dimension != $v->getDimensions()) {
			throw new Exception("Both vectors must have the same size");
		}

		$j = 0;
		$otherComponents = $v->toArray();
		foreach($this->components as $i => $component) {
			$value = $component - $otherComponents[$i];
			$j += $value * $value;
		}

		return sqrt($j);
	}

	/**
	 * Compares two vectors.
	 *
	 * @param Vector $v
	 * @return bool True if vectors are equal, false otherwise.
	 */
	public function equals(Vector $v) {
		if($this->dimension != $v->getDimensions()) {
			throw new Exception("Both vectors must have the same size");
		}

		$otherComponents = $v->toArray();
		$ret = true;
		for($i = 0; $ret && $i < $this->dimension; ++$i) {
			$ret = ($this->components[$i] == $otherComponents[$i]);
		}
		return $ret;
	}

	/**
	 * Performs Vector normalization.
	 *
	 * @return Vector
	 */
	public function normalize() {
		$j = $this->getLength();
		if($j === 0) {
			throw new Exception('Cannot normalize zero length vector');
		}
		$j *= $j;
		$components = array();
		foreach($this->components as $component) {
			$components[] = sqrt(($component * $component) / $j);
		}
		$this->components = $components;
		return $this;
	}

   /*
	* Calculates pythagorean length of a Vector.
	*
	* @return int
	*/
	public function getLength() {
		if($this->length !== null) {
			return $this->length;
		}

		$j = 0;

		foreach($this->components as $component) {
			$j += $component * $component;
		}
		return ($this->length = sqrt($j));
	}

	/*
	 * Calculate sum of Vector components.
	 *
	 * @return int
	 */
	public function sum() {
		return array_sum($this->components);
	}

	/**
	 * Returns copy of this vector.
	 *
	 * @return Vector
	 */
	public function getCopy() {
		return new Vector($this->dimension, $this->identifier, $this->components);
	}
}

/**
 * Performs image quantization.
 */
class Quantizator
{
	/**
	 * An array of glyphs/vectors to compare with.
	 *
	 * @var Vector[]
	 */
	protected $glyphs = array();

	/**
	 * Adds vector to the vectors database.
	 *
	 * @param Vector $v Vector to add.
	 * @param mixed $identifier Vector identifier.
	 * @return Quantizator
	 */
	public function addGlyph(Vector $v, $identifier = null) {
		$v = $v->getCopy();
		$v->setIdentifier($identifier);
		$this->glyphs[] = $v;
		return $this;
	}

	/**
	 * Finds nearest euklid.
	 *
	 * @param Vector $v Vector to compare.
	 * @param int $noise Noise to add (default: 0 for no noise)
	 * @return mixed[] array containing ID of the similar vector, and it's distance to the compared vector.
	 */
	public function findNearestEuklid(Vector $v, $noise = 0) {
		$minDimension = 1000000;
		foreach($this->glyphs as $index => $w) {
			$w = $w->getCopy();
			if($noise) {
				$w = $w->addNoise($noise);
			}

			$dimension = $w->getSubstractedLength($v);

			if($dimension < $minDimension) {
				$ret = $w;
				$minDimension = $dimension;
			}
		}

		if(!$ret) {
			$ret = $w;
		}
		return array($ret->getIdentifier(), $minDimension);
	}
}

/**
 * Blender class.
 */
class Blender
{
	/**
	 * Blending mode: addition.
	 */
	const USE_ADDITION = 1;

	/**
	 * Blending mode: divide.
	 */
	const USE_DIVIDE = 2;

	/**
	 * Blending mode: subtract.
	 */
	const USE_SUBTRACT = 4;

	/**
	 * Blending mode: darken.
	 */
	const USE_DARKEN = 8;

	/**
	 * Blending mode: lighten.
	 */
	const USE_LIGHTEN = 16;

	/**
	 * Blending mode: dissolve.
	 */
	const USE_DISSOLVE = 32;

	/**
	 * Blending mode: difference.
	 */
	const USE_DIFFERENCE = 64;

	/**
	 * Blending mode: multiply.
	 */
	const USE_MULTIPLY = 128;

	/**
	 * Blending mode: opacity.
	 */
	const USE_OPACITY = 256;
}

/**
 * Allows advanced image processing.
 */
class Image
{

	/**
	 * A GD2 image resource.
	 *
	 * @var resource
	 */
	protected $image;

	/**
	 * A width of this image.
	 *
	 * @var int
	 */
	protected $width;

	/**
	 * A height of this image.
	 *
	 * @var int
	 */
	protected $height;

	/**
	 * Viewport's position in the parent image.
	 *
	 * @var mixed
	 */
	protected $position;

	/**
	 * Viewport's parent image [not implemented]
	 *
	 * @var Image
	 */
	protected $parentImage;

	/**
	 * Not implemented
	 *
	 * @var mixed
	 */
	protected $useBooster;

	/**
	 * Creates new Image.
	 *
	 * @param string $fileName Image file name.
	 * @param resource $image Image data.
	 * @return Image
	 */
	public function __construct($fileName, $image = null, Point $position = null, Dimensions $size = null) {
	
	//echo $fileName;
	
	$fileName = '/var/www/www.eclecticmeme.com/components/com_battle/images/sito/avatar2.jpg';
	
	
		if(!$image && $fileName) {
			$image = imagecreatefromstring(file_get_contents($fileName));
		}
		if($image && !$position) {
			$this->image = imagecreatetruecolor(imagesx($image), imagesy($image));
			imagecopy($this->image, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
		} else {
			$this->image = imagecreatetruecolor($size->width, $size->height);
			imagecopy($this->image, $image, 0, 0, $position->x, $position->y, $size->width, $size->height);
			$this->position = $position;
		}

		$this->getSize();
	}

	/**
	 * Not implemented.
	 *
	 * @param mixed $yes
	 */
	public function useBooster($yes = false) {
		$this->useBooster = (bool) $yes;
	}

	/**
	 * Returns next power of two representation of the given number.
	 *
	 * @param int $number Number to convert.
	 * @return int Power of two representation.
	 */
	protected function getNextPowerOfTwo($number) {
		$ret = 1;
		while($ret < $number) {
			$ret <<= 1;
		}

		return $ret;
	}

	/**
	 * Gets image width.
	 *
	 * @return int
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * Gets image height.
	 *
	 * @return int
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * Sets image gamma.
	 *
	 * @return Image
	 */
	public function setGamma($level) {
		imagegammacorrect($this->image, 1, $level);
		return $this;
	}

	/**
	 * Resizes this image.
	 *
	 * @param mixed $widthOrDimensions New width (or Dimensions) of the this image.
	 * @param int $height New height of this image (used only if $widthOrDimensions is not an instance of Dimensions class)
	 * @param bool Use resampling? Default: true (slower)
	 * @return Image
	 */
	public function resize($widthOrDimensions, $height = null, $useResampling = true) {
		if(is_object($widthOrDimensions) && $widthOrDimensions instanceof Dimensions) {
			$y = $widthOrDimensions->height;
			$x = $widthOrDimensions->width;
		} else {
			$x = $widthOrDimensions;
			$y = $height;
		}
		$newImage = imagecreatetruecolor($x, $y);
		if($useResampling) {
			imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $x, $y, $this->width, $this->height);
		} else {
			imagecopyresized($newImage, $this->image, 0, 0, 0, 0, $x, $y, $this->width, $this->height);
		}
		$this->image = $newImage;
		$this->getSize();
		return $this;
	}

	/**
	 * Resizes this image and keeps the image aspect.
	 *
	 * @param mixed $widthOrDimensions New width (or Dimensions) of the this image.
	 * @param int $height New height of this image (used only if $widthOrDimensions is not an instance of Dimensions class)
	 * @param bool Use resampling? Default: true (slower)
	 * @return Image
	 */
	public function resizeAndKeepAspect($widthOrDimensions, $height = null, $useResampling = true) {
		if(is_object($widthOrDimensions) && $widthOrDimensions instanceof Dimensions) {
			$y = $widthOrDimensions->height;
			$x = $widthOrDimensions->width;
		} else {
			$x = $widthOrDimensions;
			$y = $height;
		}

		$originalAspect = $this->width / $this->height;
		$newAspect = $x / $y;

		if($originalAspect !== $newAspect) {
			if($originalAspect > $newAspect) {
				$ratio = $x / $this->width;
				$y = $ratio * $this->height;
			} else {
				$ratio = $y / $this->height;
				$x = $ratio * $this->width;
			}
		}

		return $this->resize($x, $y, $useResampling);
	}

	/**
	 * Scales this image.
	 *
	 * @return Image
	 */
	public function rescale($x, $y) {
		if(is_object($x) && $x instanceof Dimensions) {
			$y = $x->height;
			$x = $x->width;
		}
		$newImage = imagecreatetruecolor($this->width * $x, $this->height * $y);
		$x = imagesx($newImage);
		$y = imagesy($newImage);
		imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $x, $y, $this->width, $this->height);
		$this->image = $newImage;
		$this->getSize();
		return $this;
	}

	/**
	 * Returns a RGB value of the pixel at the X,Y coordinates.
	 *
	 * @param int $x X-coordinate of the pixel to check.
	 * @param int $y Y-coordinate of the pixel to check.
	 * @return int RGB value of the pixel.
	 */
	public function getPixelRgb($x, $y) {
		return imagecolorat($this->image, $x, $y);
	}

	/**
	 * Returns a color of the pixel at the X,Y coordinates.
	 *
	 * @param int $x X-coordinate of the pixel to check.
	 * @param int $y Y-coordinate of the pixel to check.
	 * @return Color Object describing the color of the pixel.
	 */
	public function getPixelColor($x, $y) {
		return new Color(imagecolorat($this->image, $x, $y));
	}

	/**
	 * Returns a RGB value of the pixel at the coordinates described in the Point object.
	 *
	 * @param Point $position Position of the pixel to check.
	 * @return int RGB value of the pixel.
	 */
	public function getPointRgb(Point $position) {
		return imagecolorat($this->image, $position->x, $position->y);
	}

	/**
	 * Returns a color of the pixel at the coordinates described in the Point object.
	 *
	 * @param Point $position Position of the pixel to check.
	 * @return Color Object describing the color of the pixel.
	 */
	public function getPointColor(Point $position) {
		return new Color(imagecolorat($this->image, $position->x, $position->y));
	}

	/**
	 * Sets a color of the pixel at the coordinates described in the Point object.
	 *
	 * @param Point $position Position of the pixel to set.
	 * @return Image
	 */
	public function setPointColor(Position $position, Color $color) {
		imagesetpixel($this->image, $position->x, $position->y, $color->rgb);
		return $this;
	}

	/**
	 * Sets a RGB value of the pixel at the coordinates described in the Point object.
	 *
	 * @param Point $position Position of the pixel to set.
	 * @return Image
	 */
	public function setPointRgb(Position $position, $rgb) {
		imagesetpixel($this->image, $position->x, $position->y, $rgb);
		return $this;
	}

	/**
	 * Sets a color of the pixel at the X,Y coordinates.
	 *
	 * @param int $x X-coordinate of the pixel to set.
	 * @param int $y Y-coordinate of the pixel to set.
	 * @return Image
	 */
	public function setPixelColor($x, $y, Color $color) {
		imagesetpixel($this->image, $x, $y, $color->rgb);
		return $this;
	}

	/**
	 * Sets a RGB value of the pixel at the X,Y coordinates.
	 *
	 * @param int $x X-coordinate of the pixel to set.
	 * @param int $y Y-coordinate of the pixel to set.
	 * @return Image
	 */
	public function setPixelRgb($x, $y, $rgb) {
		imagesetpixel($this->image, $x, $y, $rgb);
		return $this;
	}

	/**
	 * Returns copy of this image.
	 *
	 * @return Image
	 */
	public function getCopy() {
		return new Image(null, $this->image, null, $this->getDimensions());
	}

	/**
	 * Converts this image to grayscale.
	 *
	 * @return Image
	 */
	public function toGrayScale() {
		imagefilter($this->image, IMG_FILTER_GRAYSCALE);
		return $this;
	}

	/**
	 * Returns a sub image of this image.
	 *
	 * @param Point $position
	 * @param Dimensions $size
	 * @return Image
	 */
	public function getSubImage(Point $position, Dimensions $size) {
		return new Image(null, $this->image, $position, $size);
	}

	/**
	 * Creates a vector from a part of an image.
	 *
	 * @param Point $position X,Y-coordinates of the left upper-most point of the image.
	 * @param Dimensions $size Width and height of the image.
	 * @param bool $round Round the values?
	 * @param int $colorMask Color bitmask.
	 * @return Vector
	 */
	public function getVector(Point $position = null, Dimensions $size = null, $round = false, $colorMask = 0) {
		if($position === null) {
			$position = new Point(0, 0);
		}
		if($size === null) {
			$size = $this->getDimensions();
		}
		$x = $position->x;
		$y = $position->y;
		$width = $size->width;
		$height = $size->height;

		$components = array();
		$d = 0;
		$maxX = $x + $width;
		$maxY = $y + $height;

		for($i = $y; $i < $maxY && $i < $this->height; ++$i) {
			for($j = $x; $j < $maxX && $j < $this->width; ++$j) {
				$rgb = imagecolorat($this->image, $j, $i);
				if($colorMask === 0) {
					$pixel = ($rgb >> 16) & 0xff;
					$pixel += ($rgb >> 8) & 0xff;
					$pixel += $rgb & 0xff;
					$d = $pixel / 768;
				} else {
					$count = $d = 0;

					if(($colorMask & Channel::RED) > 0) {
						$d += ($rgb >> 16) & 0xff;
						++$count;
					}

					if(($colorMask & Channel::GREEN) > 0) {
						$d += ($rgb >> 8) & 0xff;
						++$count;
					}

					if(($colorMask & Channel::BLUE) > 0) {
						$d += $rgb & 0xff;
						++$count;
					}

					$d /= (256 * $count);
				}
				if($round === false) {
					$components[] = 1 - $d;
				} else {
					$components[] = 1 - round($d);
				}
			}
		}

		return new Vector(count($components), -1, $components);
	}

	/**
	 * Returns viewport's position.
	 *
	 * @return Position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Rotates image by a given angle.
	 *
	 * @param int $angle Angle in degrees (not radians).
	 * @param int $backgroundColor Backround color used to fill empty spaces after rotation (or -1 for autodetection).
	 * @return Image
	 */
	public function rotate($angle, $backgroundColor = -1) {
		if($backgroundColor === -1) {
			$backgroundColor = $this->getBackgroundColor()->getHexValue();
		}
		$this->image = imagerotate($this->image, $angle, $backgroundColor);
		$this->getSize();
		return $this;
	}

	/**
	 * Finds different shapes in the image.
	 *
	 * @param int $sortMode
	 * @return Image[]
	 */
	public function findObjects($sortMode = 1) {
		$image = $this->getCopy();
		$image->toBinary();
		$gd = $image->getGd2Handle();
		$objects = array();

		do {
			$object = imagecreatetruecolor($this->width, $this->height);
			imagefill($object, 0, 0, 0xffffff);

			$stop = false;
			for($y = 0; $y <$this->height && !$stop; ++$y) {
				for($x = 0; $x < $this->width && !$stop; ++$x) {
					if(imagecolorat($gd, $x, $y) > 0) {
						imagesetpixel($gd, $x, $y, 0);
						imagesetpixel($object, $x, $y, 0xff0000);
						$minX = $x;
						$minY = $y;
						$maxX = $x;
						$maxY = $y;
						$stop = true;
					}
				}
			}

			if(!$stop) {
				continue;
			}

			do {
				$colors = 0;
				for($x = ($minX > 0 ? $minX : 0); $x < ($maxX + 1 < $this->width ? $maxX + 1 : $this->width); ++$x) {
					for($y = ($minY > 0 ? $minY : 0); $y < ($maxY + 1 < $this->height ? $maxY + 1 : $this->height); ++$y) {
						if(imagecolorat($object, $x, $y) === 0xff0000) {
							++$colors;
							$found = false;
							for($i = ($x - 1 < 0 ? 0 : $x - 1), $maxI = ($x + 2 < $this->width ? $x + 2 : $this->width); $i < $maxI; ++$i) {
								for($j = ($y - 1 < 0 ? 0 : $y - 1), $maxJ = ($y + 2 < $this->height ? $y + 2: $this->height); $j < $maxJ; ++$j) {
									if(imagecolorat($gd, $i, $j) > 0) {
										imagesetpixel($gd, $i, $j, 0);
										imagesetpixel($object, $i, $j, 0xff0000);
										if($i < $minX) {
											$minX = $i;
											$x = ($minX - 1 > 0 ? $minX - 1 : 0);
										} else if($i > $maxX) {
											$maxX = $i;
										}
										if($j < $minY) {
											$minY = $j;
											$y = $x = ($minY - 1 > 0 ? $minY - 1 : 0);
										} else if($j > $maxY) {
											$maxY = $j;
										}

										$found = true;
									}
								}
							}
							if(!$found) {
								imagesetpixel($object, $x, $y, 0x00ff00);
							}
						}
					}
				}
			} while($colors > 0);

			$image = new Image(null, $object, new Point($minX, $minY), new Dimensions(1 + $maxX - $minX, 1 + $maxY - $minY));
			$image = $image->toBinary();
			if($sortMode === 1) {
				$objects[$minX * 100000 + $minY] = $image;
			} else {
				$objects[$minY * 100000 + $minX] = $image;
			}
		} while($stop);

		ksort($objects, SORT_NUMERIC);
		$results = array();
		foreach($objects as $object) {
			$results[] = $object;
		}
		return $results;
	}

	/**
	 * Returns image dimensions.
	 *
	 * @return Dimensions
	 */
	public function getDimensions() {
		$this->getSize();
		return new Dimensions($this->width, $this->height);
	}

	/**
	 * Crops current image.
	 *
	 * @param Point $position Position of the upper left point of the area to crop.
	 * @param Dimensions $dimensions Size of the area to crop.
	 * @return Image
	 */
	public function crop(Point $position, Dimensions $dimensions) {
		$newImage = imagecreate($dimensions->width, $dimensions->height);
		imagecopy($newImage, $this->image, 0, 0, $position->x, $position->y, $dimensions->width, $dimensions->height);
		$this->image = $newImage;
		$this->getSize();
		$this->position = $position;
		return $this;
	}

	/**
	* Experimental functionality, do not use!.
	*
	* @param Image $otherImage
	* @param mixed $minAngle
	* @param mixed $maxAngle
	* @param mixed $backgroundColor
	* @param mixed $minDimension
	*/
	private function tiltAndCompare(Image $otherImage, $minAngle = -20, $maxAngle = 20, $backgroundColor = 0xffffff, &$minDimension) {
		if($minAngle > $maxAngle) {
			$tmp = $maxAngle;
			$maxAngle = $minAngle;
			$minAngle = $tmp;
		}

		$quantization = new Quantization();
		$vector = $otherImage->getVector(new Point(0, 0), $otherImage->getDimensions(), false, 0);
		//$vector->normalize();
		$quantization->addGlyph($vector, 1);
		$otherImageDimensions = $otherImage->getDimensions();

		$foundObject = $this;
		$minDimension = 1000000000000;

		for($angle = $minAngle; $angle <= $maxAngle; $angle += 1) {
			$copy = $this->getCopy();
			$copy->rotate($angle, $backgroundColor);
			// find object in object - this is a smart autocropping of binary images.
			//$objects = $copy->findObjects();
			$objects[0] = $copy;
			// we want only the first detected object (only one should be detected anyway!;)
			list($width, $height) = $objects[0]->getSize();
			// object must be resized before quantization in order to match the other image dimensions.
			$objects[0]->resize($otherImageDimensions, null, false)->toBinary();
			$vector = $objects[0]->getVector(new Point(0, 0), $otherImageDimensions, false, 0);
			//$vector->normalize();
			$result = $quantization->findNearestEuklid($vector);
			if($result[1] < $minDimension) {
				$minDimension = $result[1];
				$foundObject = $objects[0];
			}
		}
		return $foundObject;
	}

	/**
	 * Reverses all colors of the image.
	 *
	 * @return Image
	 */
	public function toNegative() {
		imagefilter($this->image, IMG_FILTER_NEGATE);
		return $this;
	}

	/**
	 * Returns a number of bytes used to store a single row of the image binary buffer.
	 *
	 * For example:
	 *    128 pixels = 16 bytes,
	 *    127 pixels = 16 bytes (127 bits of image + 1 bits of padding),
	 *    129 pixels = 17 bytes (129 bits of image + 7 bits of padding)
	 *
	 * @return int Number of bytes per image row.
	 */
	protected function getByteWidth() {
		return (int)(($this->width + 7) / 8);
	}

	/**
	 * Displays the image.
	 *
	 * @param bool $die Die after displaying an image? Default: false
	 * @return Image
	 */
	public function show($die = false) {
		header('Content-Type: image/png');
		imagepng($this->image);
		if($die) {
			die();
		}
		return $this;
	}

	/**
	 * Saves this image to the disk.
	 *
	 * @param string $fileName File name.
	 * @return Image
	 */
	public function saveAsPng($fileName) {
		imagepng($this->image, $fileName);
		return $this;
	}

	/**
	 * Saves this image to the disk.
	 *
	 * @param string $fileName File name.
	 * @return Image
	 */
	public function saveAsGif($fileName) {
		imagegif($this->image, $fileName);
		return $this;
	}

	/**
	 * Saves this image to the disk.
	 *
	 * @param string $fileName File name.
	 * @return Image
	 */
	public function saveAsJpeg($fileName) {
		imagejpeg($this->image, $fileName);
		return $this;
	}

	/**
	 * Deskews the image.
	 *
	 * @param int $backgroundColor Color of the background to use, or -1 (default) to use auto detection.
	 * @param bool $turboMode Set true to enable turbo mode (may be less accurate).
	 * @param bool $debugMode Set true to enable the debug mode.
	 * @return Image
	 */
	public function deskew($backgroundColor = -1, $turboMode = true, $debugMode = false) {
		// detect the background color
		if($backgroundColor < 0) {
			$backgroundColor = $this->getBackgroundColor(1, $turboMode)->getHexValue();
		}

		// calculate a Hough matrix and get the skew angle
		$angles = $this->getSkewAngle($debugMode ? 1 : 8, 128, $debugMode);

		$this->rotate($angles[0]['degrees'], $backgroundColor);
		return $this;
	}

	/**
	 * Calculates the size of this image.
	 *
	 * @return int[] An array containing a width and height of this image.
	 */
	public function getSize() {
		list($this->width, $this->height) = $result = array(imagesx($this->image), imagesy($this->image));
		return $result;
	}

	/**
	 * Detects the skew angle of this image using the Hough normal transform.
	 *
	 * @param int $numberOfSamples Number of different angles to detect (sorted by a number of votes).
	 * @param int $matrixSize Size of the pixel matrix used for detection, bigger matrix = slower, more accurate detection.
	 * @param bool $debugMode Draw detected Hough lines on this image? Works only in $returnMode = 1, default: false
	 * @param int $returnMode Return mode: 1 = array of detected angles (default), 2 = rendered transform results (Image instance), 3 = array of transform results
	 * @return resource
	 */
	public function getSkewAngle($numberOfSamples = 1, $matrixSize = 128, $debugMode = false, $returnMode = 1) {
		// make a copy of the original image
		if(!$debugMode) {
			$copy = imagecreatetruecolor($this->width, $this->height);
			imagecopy($copy, $this->image, 0, 0, 0, 0, $this->width, $this->height);
		}

		// create a cache of sinus and cosinus values.
		static $sin = array();
		static $cos = array();

		// initialize Hough matrix
		$matrix = array();

		// initialize angle deviation
		$maxDeviation = 2;

		// initialize byte offset in the image frame buffer
		$offset = -1;

		// initialize bits offset in the image frame buffer
		$bits = -8;

		// get binary buffer of this image
		$bin = $this->createImageMatrix($matrixSize, $ratio, $debugMode);

		// get size of binary buffer
		$length = strlen($bin) - 1;

		// calculate padding of this image
		$padding = $this->getNextPowerOfTwo($this->width);

		// get the centre of this image.
		$sizeX2 = (int)($this->width / 2);
		$sizeY2 = (int)($this->height / 2);

		if(!$debugMode) {
			$this->image = $copy;
		}

		// calculate the maximal distance from the centre of this image.
		$rMax = (int) sqrt($sizeX2 * $sizeX2 + $sizeY2 * $sizeY2);
		$rMin = -$rMax;

		// create an empty row used to fill (initialize) all rows in Hough matrix.
		$emptyRow = array_fill(0, $rMax + 1, 0);

		// initialize (fill) Hough matrix with empty values and precalculate sinus/cosinus values if necessary.
		for($i = 0; $i < 180; ++$i) {
			// loop is unwinded for performance reasons (it is 30% faster, than $i < 360)
			$matrix[$i] = $emptyRow;
			$matrix[180 + $i] = $emptyRow;

			// precalculate sinus/cosinus only when necessary
			if(!isset($sin[$i])) {
				// calculate a sinus value in the first half of the circle
				$sin[$i] = sin(deg2rad($i));
				// calculate a cosinus value using the fast conversion from sinus
				if($i >= 90) {
					$cos[$i - 90] = $sin[$i];
				} else {
					$cos[$i + 90] = -$sin[$i];
				}
			}
		}

		// create Hough matrix
		do {
			$bits += 8;
			// ignore null bytes in the framebuffer (there are no pixels inside of them)
			// this allows us to quickly skip 8 iterations every time the null byte was detected.
			if($bin[++$offset] === "\0") {
				continue;
			}

			// calculate current x,y position in the image frame buffer.
			$y = (int)($bits / $padding);
			$x = $bits - $padding * $y;

			// precalculate some variables used in the next loop.
			$y2 = $sizeY2 - $y;
			$x1 = $x;

			// get the 8bit representation of the current byte in framebuffer.
			$byte = ord($bin[$offset]);

			// check every bit in the current byte of framebuffer.
			// every byte in framebuffer stores the information about 8 neighbouring pixels in the image.
			// bit test: 0 - background, 1 = pixel is set.
			do {
				// use the bit mask to check if the selected bit is set.
				if($mask = ($byte & 0x80 >> $x - $x1)) {
					// bit is set, remove it from the byte, so this loop can end as soon as no more bits are present.
					$byte ^= $mask;

					// precalculate some variables used in the next loop.
					$x2 = $sizeX2 - $x;
					$i = -1;

					// count votes for every angle (0->360') generated at this point (x2,y2).
					do {
						// loop is unwinded for performance reasons (it is 60% faster, than $i < 360)
						// we are making four different tests instead of one during every loop iteration
						// what's more, we are using only 50% less index lookups in the sin/cos arrays.
						$r = $x2 * $cos[++$i] + $y2 * $sin[$i];
						if($r >= $rMin && $r <= 0) {
							++$matrix[$i][(int)($r - $rMin)];
						} else if($r <= $rMax && $r >= 0){
							++$matrix[180 + $i][(int)($rMax - $r)];
						}

						$r = $x2 * $cos[++$i] + $y2 * $sin[$i];
						if($r >= $rMin && $r <= 0) {
							++$matrix[$i][(int)($r - $rMin)];
						} else if($r <= $rMax && $r >= 0){
							++$matrix[180 + $i][(int)($rMax - $r)];
						}
					} while($i < 179);
				}
				++$x;
			} while($byte);

		} while ($offset < $length);

		// mode #3: return Hough matrix as an array
		if($returnMode === 3) {
			return $matrix;
		}

		// mode #2: return Hough matrix as a rendered image.
		if($returnMode === 2) {
			$image = imagecreatetruecolor($rangeOfTheta, $rMax + 1);
			for($i = 0; $i < $rangeOfTheta; ++$i) {
				for($r = 0; $r < $rMax; ++$r) {
					imagesetpixel($image, $i, $ratio * $r, $matrix[$i][$r]);
				}
			}
			return new Image(false, $image);
		}

		// mode #1 (default): return an array of angles and their distances.
		if($returnMode === 1) {
			$results = array();
			// get size of the matrix.
			$width = count($matrix);
			$height = count($matrix[0]);

			// calculate angles
			for($i = 0; $i < $numberOfSamples; ++$i) {
				$val = -1;
				// find the brightest point on the Hough matrix.
				for($l = 0; $l < $width; ++$l) {
					for($m = 0; $m < $height; ++$m) {
						if($val < $matrix[$l][$m]) {
							$val = $matrix[$l][$m];
							$x = $l;
							$y = $m;
						}
					}
				}

				if($val === -1) {
					// there is nothing left (rather strange case).
					break;
				}

				// calculate distance.
				$r = -($y - $rMax);

				// add this sample to the results array
				$results[$i] = array('degrees' => $x, 'radians' => deg2rad($x), 'distance' => $r);

				// draw Hough lines if necessary
				if($debugMode) {
					$this->drawHoughLine($results[$i]['distance'], $results[$i]['degrees']);
				}

				if($numberOfSamples > 1) {
					// clear the matrix around and the brightest point.
					// so they wont be detected the during next iteration
					$maxK = min($x + 10, $width - 1);
					$maxJ = min($y + 10, $height - 1);
					for ($k = max($x - 10, 0); $k <= $maxK; ++$k){
						for($j = max($y - 10, 0); $j <= $maxJ; ++$j){
							$matrix[$k][$j] = 0;
						}
					}
				}
			}

			return $results;
		}
	}

	/**
	 * Draws the Hough line.
	 *
	 * @param int $distance Distance from the origin.
	 * @param int $theta Angle in degrees.
	 * @return Image
	 */
	protected function drawHoughLine($distance, $theta, $color = 111111) {
		if($theta === 0 || $theta === 360) {
			return $this;
		}
		$theta = deg2rad($theta);
		$sizeX2 = $this->width / 2;
		$sizeY2 = $this->height / 2;
		for($x = 0; $x< $this->width; ++$x)    {
			$y1 = (int)($distance / sin($theta) - ($x - $sizeX2) * (cos($theta) / sin($theta)) + $sizeY2);
			$x1 = (int)($distance / cos($theta) - ($x - $sizeX2) * tan($theta) + $sizeY2);

			if($x > 0 && $x < $this->width && $y1 > 0 && $y1 < $this->height) {
				imageline($this->image, $x, $y1, $x, $y1, $color);
			}

			if($x1 > 0 && $x1 < $this->width) {
				imageline($this->image, $x1, $x, $x1, $x, $color);
			}
		}
		return $this;
	}

	/**
	 * Returns binary frame buffer of the current image.
	 *
	 * In case of color/grayscale images, use Image::toBinary() first.
	 *
	 * @param resource $image Image to binarize.
	 * @return string String of chars.
	 */
	protected function getBinaryBuffer() {
		// catch the GD2 output
		ob_start();

		// convert a (probably) color/greyscale image to the monochrome counterpart.
		imagewbmp($this->image);

		// catch contents of the WBMP file.
		$wbmp = ob_get_clean();

		// ignore 2 bytes of WBMP file header
		$i = 2;

		// ignore 2 VLQ's (variable-length quantities) describing WBMP resolution.
		for($j = 0; $j < 2; ++$j) {
			do {
				$test = ord($wbmp[$i]) & 0x80;
				++$i;
			} while($test);
		}

		// return binary buffer as a string of chars (bytes)
		return substr($wbmp, $i);
	}

	/**
	 * Detects if the binary buffer of this image is empty after conversion to two-colors mode.
	 *
	 * Empty buffer may mean that the conversion failed.
	 *
	 * @param double $threshold The threshold.
	 * @return bool True if empty, false otherwise.
	 */
	public function isBinaryBufferEmpty($threshold = 0.01) {
		$bin = $this->getBinaryBuffer();
		// delete all empty bytes
		if(strlen(trim($bin, chr(255))) / strlen($bin) < $threshold || strlen(trim($bin, chr(0))) / strlen($bin) < $threshold) {
			// something is wrong, image is filled (almost) solid color.
			return true;
		}
		return false;
	}

	/**
	 * Returns GD2 resource handle of this image.
	 *
	 * @return resource
	 */
	public function getGd2Handle() {
		return $this->image;
	}

	/**
	 * Reduces color palette of this image to two colors (1 = pixel set, 0 = background).
	 *
	 * @param bool $useEdgeDetection Use edge detection before converting to two colors?
	 * @param bool $useDithering Use dithering? Default: false
	 * @return Image
	 */
	public function toBinary($useEdgeDetection = false, $useDithering = false) {
		// convert to 2 colors
		if($useEdgeDetection) {
			$image = imagecreate($this->width, $this->height);
			imagecopy($image, $this->image, 0, 0, 0, 0, $this->width, $this->height);
			imagefilter($this->image, IMG_FILTER_EDGEDETECT);
			if($this->toBinary(false)->isBinaryBufferEmpty()) {
				// conversion failed, we lost too much data, further results would be inconclusive
				// try again, without edge detection
				$this->image = $image;
				$this->toBinary(false);
				return $this;
			}
		}
		imagetruecolortopalette($this->image, $useDithering, 2);
		imagecolorset($this->image, 0, 0, 0, 0);
		imagecolorset($this->image, 1, 255, 255, 255);
		return $this;
	}

	/**
	 * Generate histogram data.
	 *
	 * @param int $channels Channels to draw, possibilities: Channel::RGB (default), Channel::RED, Channel::GREEN, Channel::BLUE
	 * @param int $colorMode Color mode for saturation (use Color::HSV, Color::HSI or Color::HSL as the value), default is Color::HSL
	 * @return int[] Histogram data
	 */
	public function getHistogramData($channels, $colorMode = Color::HSL) {
		$colors = array_fill(0, 256, 0);
		for($y = 0; $y < $this->height; ++$y) {
			for($x = 0; $x < $this->width; ++$x) {
				$rgb = imagecolorat($this->image, $x, $y);
				$r = ($rgb >> 16) & 0xff;
				$g = ($rgb >> 8) & 0xff;
				$b = $rgb & 0xff;
				switch ($channels) {
					case Channel::RGB:
						switch($colorMode) {
							case Color::HSL:
								// HSL algorithm
								$luminescence = (max($r, $g, $b) + min($r, $g, $b)) / 2;
								break;
							case Color::HSV:
								// HSV algorithm
								$luminescence = max($r, $g, $b);
								break;
							case Color::HSI:
								// HSI algorithm
								$luminescence = ($r + $g + $b) / 3;
								break;
							default:
								// fastest
								$luminescence = ($r + $r + $r + $b + $g + $g + $g + $g) >> 3;
								break;
						}
						break;
					case Channel::RED:
						$luminescence = $r;
						break;
					case Channel::GREEN:
						$luminescence = $g;
						break;
					case Channel::BLUE:
						$luminescence = $b;
						break;
				}
				++$colors[$luminescence];
			}
		}

		return $colors;
	}

	/**
	 * Creates an image histogram.
	 *
	 * @param int $channels Channels to draw, possibilities: Channel::RGB (default), Channel::RED, Channel::GREEN, Channel::BLUE
	 * @param int $color Foreground color.
	 * @param int $backgroundColor Background color.
	 * @param bool $turboMode Use turbo mode (less accurate).
	 * @return Image A histogram image
	 */
	public function getHistogram($channels = Channel::RGB, $color = 0, $backgroundColor = 0xffffff, $turboMode = false) {
		$colors = $colors2 = $this->getHistogramData($channels, $turboMode ? null : Color::HSL);
		sort($colors2, SORT_NUMERIC);
		$min = $colors2[0];
		$max = $colors2[255];
		$diff = $max - $min;
		$ratio = 255 / $colors2[255];

		$histogram = imagecreatetruecolor(256, 128);
		imagefill($histogram, 0, 0, $backgroundColor);
		foreach($colors as $gray => $value) {
			imageline($histogram, $gray, 255, $gray, 128 - ($colors[$gray] - $min) * 128 / $diff, $color);
		}
		return new Image(null, $histogram);
	}

	/**
	 * Changes the hue of an image.
	 *
	 * @param int $angle The hue value in degrees (0 - 360')
	 * @return Image
	 */
	public function setHue($angle) {
		if($angle % 360 === 0) {
			// full circle, do nothing
			//return $this;
		}

		return $this->changeHsl($angle % 360, 1, 1);
	}

	/**
	 * Changes (multiplies) the saturation of the image by a given factor.
	 *
	 * @param float $factor The saturation factor (1 = no change, 0.5 = 50% of original saturation, 2 = 200% saturation, etc.)
	 * @return Image
	 */
	public function setSaturation($factor) {
		return $this->changeHsl(0, $factor, 1);
	}

	/**
	 * Changes (multiplies) the luminosity of the image by a given factor.
	 *
	 * @param float $factor The luminosity factor (1 = no change, 0.5 = 50% of original luminosity, 2 = 200% luminosity, etc.)
	 * @return Image
	 */
	public function setLuminance($factor) {
		return $this->changeHsl(0, 1, $factor);
	}

	/**
	 * Blends two images together.
	 *
	 * @param Image $otherImage Other image to blend.
	 * @param Point $position X, Y coordinates of the destination point.
	 * @param int $blendingMode Blending mode, for example: Blender::USE_ADDITION [is used as default]
	 * @param float $opacity Opacity factor [0...1], used only in the Blender::USE_TRANSPARENCY blending mode
	 * @return Image
	 */
	public function useBlender(Image $otherImage, Point $position, $blendingMode = Blender::USE_ADDITION, $opacity = null) {
		$image = $otherImage->getGd2Handle();
		$mode = Shader::USE_RGB;
		switch($blendingMode) {
			case Blender::USE_ADDITION:
				$ops = '$r += $r2; $g += $g2; $b += $b2;';
				break;
			case Blender::USE_SUBTRACT:
				$ops = '$r -= $r2; $g -= $g2; $b -= $b2;
				$r = $r < 0 ? 0 : $r;
				$g = $g < 0 ? 0 : $g;
				$b = $b < 0 ? 0 : $b;
				';
				break;
			case Blender::USE_DIVIDE:
				$ops = '
				$r = $r2 / ($r + 0.001);
				$g = $g2 / ($g + 0.001);
				$b = $b2 / ($b + 0.001);
				';
				break;
			case Blender::USE_LIGHTEN:
				$ops = '$luminance2 = ($g2 >= $b2 ? ($r2 >= $g2 ? $r2 : $g2) : ($r2 >= $b2 ? $r2 : $b2));
				$luminance = ($g >= $b ? ($r >= $g ? $r : $g) : ($r >= $b ? $r : $b));
				if($luminance < $luminance2) {
					$r = $r2; $g = $g2; $b = $b2;
				}
				';
				break;
			case Blender::USE_DARKEN:
				$ops = '$luminance2 = ($g2 >= $b2 ? ($r2 >= $g2 ? $r2 : $g2) : ($r2 >= $b2 ? $r2 : $b2));
				$luminance = ($g >= $b ? ($r >= $g ? $r : $g) : ($r >= $b ? $r : $b));
				if($luminance > $luminance2) {
					$r = $r2; $g = $g2; $b = $b2;
				}
				';
				break;
			case Blender::USE_DIFFERENCE:
				$ops = '$r -= $r2; $g -= $g2; $b -= $b2;
				$r = $r < 0 ? -$r : $r;
				$g = $g < 0 ? -$g : $g;
				$b = $b < 0 ? -$b : $b;
				';
				break;
			case Blender::USE_MULTIPLY:
				$ops = '$r *= 255; $g *=255; $b *= 255;
				$r2 *= 255; $g2 *=255; $b2 *= 255;
				$r = ($r * $r2) / 65025;
				$g = ($g * $g2) / 65025;
				$b = ($b * $b2) / 65025;
				';
				break;
			case Blender::USE_OPACITY:
				$alpha = 1 - $opacity;
				$mode = Shader::USE_INT | Shader::USE_ALPHA;
				$ops = '$r = $r2; $g = $g2; $b = $b2; $a = '.$alpha.';';
				break;
			default:
				throw new Exception('Unsupported blending mode');
				break;
		}

		$shader = new Shader('
			$rgb2 = imagecolorat($args[0], $x - $args[1], $y - $args[2]);
			$r2 = (($rgb2 >> 16) & 0xff) / 255;
			$g2 = (($rgb2 >> 8) & 0xff) / 255;
			$b2 = ($rgb2 & 0xff) / 255;
			'.$ops);
		$shader->setMode($mode);
		$shader->useArea($position, new Point($otherImage->getWidth() + $position->x, $otherImage->getHeight() + $position->y));

		$this->useShader($shader, array($image, $position->x, $position->y));
		return $this;
	}

	/**
	 * Creates and runs a new shader (HSV mode).
	 *
	 * Shader is a set of PHP operations performed on each pixel of the image.
	 * Currently you can alter the luminance, saturation and hue of every single pixel of the image.
	 *
	 * In order to do so, you have a read-only access to these variables:
	 * $r [0...1], $g[0...1], $b[0...1]
	 * $x, $y,
	 * $width, $height, $image [gd resource]
	 *
	 * and full read/write access to:
	 * $luminance [0...1], $saturation [0...1], $hue [0...360],
	 *
	 * @param mixed $shaderContent Shader content.
	 * @param mixed[] $args Arguments array passed to the shader.
	 * @return Image
	 */
	public function useShader($shaderContent, $args = array()) {
		$width = $this->width;// 'imagesx($image)';
		$height = $this->height;// 'imagesy($image)';
		$x = $y = 0;
		$mode = Shader::USE_HSV;

		if(is_object($shaderContent) && $shaderContent instanceof Shader) {
			$area = $shaderContent->getArea();
			if($area) {
				$x = max($area[0]->x, 0);
				$y = max($area[0]->y, 0);
				$width = min($area[1]->x, $this->width);
				$height = min($area[1]->y, $this->height);
			}
			$mode = $shaderContent->getMode();
			$shaderContent = $shaderContent->getInstructions();
		}

		$shader = '
			$hits = 0;
			$width = '.$width.';
			$height = '.$height.';
			for($y = '.$y.'; $y < $height; ++$y) {
				for($x = '.$x.'; $x < $width; ++$x) {
					$rgb = imagecolorat($image, $x, $y);
					$r = (($rgb >> 16) & 0xff) / 255;
					$g = (($rgb >> 8) & 0xff) / 255;
					$b = ($rgb & 0xff) / 255;

					'.($mode & Shader::USE_HSV ?
					// --- HSV MODE START
					'
					// equivalent of $min = min($r, $g, $b), etc (loop is 10% faster)
					$min = ($g <= $b ? ($r <= $g ? $r : $g) : ($r <= $b ? $r : $b));
					$luminance = ($g >= $b ? ($r >= $g ? $r : $g) : ($r >= $b ? $r : $b));
					$diff = $luminance - $min;

					if($luminance > $min) {
						$saturation = $diff / $luminance;
						$hue = ((($r === $min ? 3.0 : ($g === $min ? 5 : 1)) - ($r === $min ? $g - $b : ($g === $min ? $b - $r : $r - $g)) / $diff) * 60) / 360;
					} else {
						$saturation = 0.0;
						$hue = 0.0;
					}
					'
					:
					null
					// --- HSV MODE END
					)
					.
					$shaderContent
					.
					($mode & Shader::USE_HSV ?
					// --- HSV MODE START
					'

					if($saturation === 0.0) {
						$r = $luminance;
						$g = $luminance;
						$b = $luminance;
					} else {
						$tH = $hue * 6.0;
						$tI = (int)$tH;
						$t1 = $luminance * (1.0 - $saturation);
						$t2 = $luminance * (1.0 - $saturation * ($tH - $tI));
						$t3 = $luminance * (1.0 - $saturation * (1.0 - ($tH - $tI)));

						switch($tI) {
							case 0:
								$r = $luminance;
								$g = $t3;
								$b = $t1;
								break;
							case 1:
								$r = $t2;
								$g = $luminance;
								$b = $t1;
								break;
							case 2:
								$r = $t1;
								$g = $luminance;
								$b = $t3;
								break;
							case 3:
								$r = $t1;
								$g = $t2;
								$b = $luminance;
								break;
							case 4:
								$r = $t3;
								$g = $t1;
								$b = $luminance;
								break;
							default:
								$r = $luminance;
								$g = $t1;
								$b = $t2;
								break;
						}
					}
					'
					:
					null
					// --- HSV MODE END
					).
					($mode & Shader::USE_ALPHA ?
					'
					imagesetpixel($image, $x, $y, (($a * 127) << 24) | (($r < 1 ? ($r * 255) << 16 : 16711680)) | (($g < 1 ? ($g * 255) << 8 : 65280)) | ($b < 1 ? $b * 255 : 255));
					'
					:
					'
					imagesetpixel($image, $x, $y, (($r < 1 ? ($r * 255) << 16 : 16711680)) | (($g < 1 ? ($g * 255) << 8 : 65280)) | ($b < 1 ? $b * 255 : 255));
					'
					)
					.'
				}
			}
		';

		$run = create_function('$image, $args', $shader);
		if($mode & Shader::USE_ALPHA) {
			imagealphablending($this->image, true);
		}
		$run($this->image, $args);
		if($mode & Shader::USE_ALPHA) {
			imagealphablending($this->image, false);
		}

		return $this;
	}

	/**
	 * Gaussian blur (unoptimized, eats memory like hell)
	 *
	 * Experimental, do not use. Will be added in further versions of library.
	 *
	 * @param int $distance Blur distance.
	 * @return Image
	 */
	public function useBlur($distance) {
		$size = ($distance * 2 + 1) * ($distance * 2 + 1);
		$img = array();
		for ($x = 0; $x < $this->width; ++$x) {
			$img[$x] = array();
			for ($y = 0; $y < $this->height; ++$y) {
				$img[$x][$y] = imagecolorat($this->image, $x, $y);
			}
		}

		for ($x = 0; $x < $this->width; ++$x) {
			for ($y = 0; $y < $this->height; ++$y) {
				$r = 0;
				$g = 0;
				$b = 0;
				$color = $img[$x][$y];

				for($maxX = $x + $distance, $k = $x - $distance; $k <= $maxX; ++$k) {
					for ($maxY = $y + $distance, $l = $y - $distance; $l <= $maxY; ++$l) {
						if (isset($img[$k][$l])) {
							$color = $img[$k][$l];
							$r += ($color >> 16) & 0xff;
							$g += ($color >> 8) & 0xff;
							$b += $color & 0xff;
							continue;
						}
						$r += ($color >> 16) & 0xff;
						$g += ($color >> 8) & 0xff;
						$b += $color & 0xff;
					}
				}

				$r /= $size;
				$g /= $size;
				$b /= $size;
				$img[$x][$y] = $r << 16 | $g << 8 | $b;
				imagesetpixel($this->image, $x, $y, $img[$x][$y]);
			}
		}
		return $this;
	}

	/**
	 * Changes HSL values.
	 *
	 * @param mixed $value
	 * @return Image
	 */
	public function changeHsl($hueAngle = 0, $saturationFactor = 1, $luminanceFactor = 1) {
		$hueAngle /= 360;
		$this->useShader('
			$hue += $args[0];
			$saturation *= $args[1];
			$luminance *= $args[2];
		', array($hueAngle, $saturationFactor, $luminanceFactor));
		return $this;
	}

	/**
	 * Creates simulated HDR image (still in beta version).
	 *
	 * @param float $threshold Luminance threshold (0...1), the higher, the darker image.
	 * @return Image
	 */
	public function toHdr($threshold = 0.80) {
		if($threshold > 1 || $threshold < 0) {
			throw new Exception('Invalid threshold, should be between 0 and 1');
		}

		$emboss = $this->getCopy();
		$gd = $emboss->getGd2Handle();
		imagefilter($gd, IMG_FILTER_EMBOSS);
		imagefilter($gd, IMG_FILTER_GAUSSIAN_BLUR);
		$emboss->toGrayScale();

		//$this->image = $light;
		$this->useShader('
			$alpha = ((imagecolorat($args[0], $x, $y) & 0xff) / 255);
			if($luminance < '.$threshold.') {
				$dd = ($luminance/ '.$threshold.');
				$luminance *= 0.9 * $dd;
				$saturation *= 2 - $dd;
				if($saturation > 1) {
					$saturation = 1;
				}
			} else {
				if($alpha < 0.9) {
					$luminance *= (1 - $alpha / 8);
					$saturation *= 1.3 * (1 - $alpha / 8);
				} else {
					$dd = 1 - (($luminance - '.$threshold.') / '.(1 - $threshold).');
					$saturation *= 1.8 * $dd;
				}
			}
		', array($gd));

		//$this->image = $gd;
		return $this;
	}

	/**
	 * Uses median filter to reduce image noise.
	 *
	 * @param int $maskWidth Width of the median mask (default: 3)
	 * @param int $maskHeight Height of the median mask (default: 3)
	 * @return Image This image.
	 */
	public function useMedian($maskWidth = 3, $maskHeight = 3) {
		// initialize scanline buffer
		$scanLines = array();

		// precalculate some variables for better performance
		$maskWidth2 = (int)($maskWidth / 2);
		$maskHeight2 = (int)($maskHeight / 2);
		$maskMiddle = (int)(($maskWidth * $maskHeight) / 2);
		$maxY = $this->height - $maskHeight2;
		$maxX = $this->width - $maskWidth2;

		// scan every line of the image
		for($y = $maskHeight2; $y < $maxY; ++$y) {
			$medianY = $y + $maskHeight2;
			$maxI = $y + $maskHeight2 + 1;
			$minI = $y <= $maskHeight2 ? 0 : $y + 1;
			// cache few image lines in advance, to speed up further access.
			for($i = $minI; $i < $maxI; ++$i) {
				for($j = 0; $j < $this->width; ++$j) {
					$scanLines[$i][$j] = imagecolorat($this->image, $j, $i);
				}
			}
			// unset old image lines from the cache.
			unset($scanLines[$medianY - $maskHeight]);

			for($x = $maskWidth2; $x < $maxX; ++$x) {
				$medianX = $x + $maskWidth2;
				$median = array();
				for($n = 0; $n < $maskHeight; ++$n) {
					for($m = 0; $m < $maskWidth; ++$m) {
						$median[] = $scanLines[$medianY - $n][$medianX - $m];
					}
				}
				sort($median, SORT_NUMERIC);
				imagesetpixel($this->image, $x, $y, $median[$maskMiddle]);
			}
		}
		return $this;
	}

	/**
	 * (Fast) Detects the background color of this image.
	 *
	 * @param int $numberOfSampes Number of detected colors (sorted by the propability).
	 * @param bool $turboMode Set true to use faster alghoritm (slightly less accurate).
	 * @return mixed RGB representation of the color, array of samples: array(rgb => propability), or an instance of Color class if one sample selected.
	 */
	public function getBackgroundColor($numberOfSamples = 1, $turboMode = false) {
		$colors = array();

		if($turboMode && ($this->width > 256 || $this->height > 256)) {
			// create a thumbnail for the computations
			if($this->width > $this->height) {
				$ratio = 256 / $this->width;
				$width = 256;
				$height = (int)($ratio * $this->width);
			} else {
				$ratio = 256 / $this->height;
				$height = 256;
				$width = (int)($ratio * $this->width);
			}
			$image = imagecreatetruecolor($width, $height);
			imagecopyresized($image, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
		} else {
			$image = $this->image;
			$width = $this->width;
			$height = $this->height;
		}

		// this is a quick test only, may be inaccurate
		// two image samples per one iteration (better performance)
		for($x = 0; $x < $width; ++$x) {
			$rgb = imagecolorat($image, $x, 0);
			if(isset($colors[$rgb])) {
				++$colors[$rgb];
			} else {
				$colors[$rgb] = 1;
			}

			$rgb = imagecolorat($image, $x, $height - 1);
			if(isset($colors[$rgb])) {
				++$colors[$rgb];
			} else {
				$colors[$rgb] = 1;
			}
		}

		// two image samples per one iteration (better performance)
		for($y = 0; $y < $height; ++$y) {
			$rgb = imagecolorat($image, 0, $y);
			if(isset($colors[$rgb])) {
				++$colors[$rgb];
			} else {
				$colors[$rgb] = 1;
			}
			$rgb = imagecolorat($image, $width - 1, $y);
			if(isset($colors[$rgb])) {
				++$colors[$rgb];
			} else {
				$colors[$rgb] = 1;
			}
		}

		arsort($colors, SORT_NUMERIC);

		if($numberOfSamples === 1) {
			reset($colors);
			return new Color(key($colors));
		}

		return array_slice($colors, 0, 10);
	}

	/**
	 * Creates the image buffer used by the skew functions.
	 *
	 * @param int $size Size of the matrix.
	 * @param int $ratio Rescale ratio of this image (value is returned by this method)
	 * @return string Binary frame buffer
	 */
	protected function createImageMatrix($size = 0, &$ratio) {
		// create two-color image
		$this->toBinary(true);

		// rescale if necessary (for performance reasons)
		if($size > 0 && ($this->width > $size || $this->height > $size)) {
			if($this->width > $this->height) {
				$ratio = $size / $this->width;
			} else {
				$ratio = $size / $this->height;
			}
			$width = (int)($ratio * $this->width);
			$height = (int)($ratio * $this->height);
			$image = imagecreate($width, $height);
			imagecopyresized($image, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
		} else {
			$ratio = 1;
			$image = imagecreate($this->width, $this->height);
			imagecopy($image, $this->image, 0, 0, 0, 0, $this->width, $this->height);
			list($width, $height) = $this->getSize();
		}

		$this->image = $image;

		// find the background color (fast approximation)
		$colors = array();
		$bin = $this->getBinaryBuffer();

		for($i = 0, $max = strlen($bin); $i < $max; ++$i) {
			if(!isset($colors[$bin[$i]])) {
				$colors[$bin[$i]] = 1;
			} else {
				++$colors[$bin[$i]];
			}
		}

		arsort($colors, SORT_NUMERIC);
		reset($colors); // HipHop for PHP compatibility.
		$backgroundColor = key($colors);

		// make colors negation if necessary, 0's should be used for background.
		if($backgroundColor === chr(255)) {
			imagefilter($this->image, IMG_FILTER_NEGATE);
		}

		$image = imagecreatetruecolor($size, $size);
		imagefill($image, 0, 0, 0);
		imagecopy($image, $this->image, ($size - $width) / 2, ($size - $height) / 2, 0, 0, $width, $height);
		$this->image = $image;

		$bin = $this->getBinaryBuffer();

		$this->getSize();
		return $bin;
	}
}

