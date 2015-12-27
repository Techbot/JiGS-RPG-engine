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
 * @version    1.0.0
 */

require_once('/var/www/www.eclecticmeme.com/components/com_battle/includes/gd2imaging.php');
/**
 * ASCII art generator class.
 */
 class BattleModelascii_art extends JModel
{




    /**
     * Image to convert
     *
     * @var Image
     */
    protected $image;

    /**
     * Color threshold.
     *
     * The higher the threshold, the smaller HTML document (and worse image accuracy).
     * @var int
     */
    protected $threshold = 100;

    /**
     * Background color.
     *
     * @var Color
     */
    protected $backgroundColor = 1;

    /**
     * Image CSS style in HTML mode
     *
     * @var mixed
     */
    protected $css = 'font-family: monospace; font-size: 12px;';

    /**
     * Creates ASCII art generator.
     *
     * @param string $fileName Image file name.
     * @return AsciiArt
     */
    public function __construct() {

    $fileName='/var/www/www.eclecticmeme.com/components/com_battle/images/sito/example.jpg';












        if(!ini_get('safe_mode') && strpos(ini_get('disabled_functions'), 'set_time_limit') === false) {
            set_time_limit(0);
        }
        $this->image = new Image($fileName);



        $this->backgroundColor = $this->image->getBackgroundColor();
    }

    /**
     * Sets the font size.
     *
     * @param int $size Font size in pixels.
     * @return AsciiArt
     */
    public function setFontSize($size) {
        $this->css = 'font-family: monospace; font-size: '.(int) $size.'px;';
        return $this;
    }

    /**
     * Sets the color threshold.
     *
     * The higher the threshold, the smaller HTML document (and worse image accuracy).
     *
     * @param int $value
     * @return AsciiArt
     */
    public function setColorThreshold($value) {
        $this->threshold = $value;
        return $this;
    }

    /**
     * Returns background color
     *
     * @return Color
     */
    public function getBackgroundColor() {
        return $this->backgroundColor;
    }

    /**
     * Displays ASCII art.
     *
     * @param string[] $charsList List of characters to use.
     * @param float $resizeFactor Image resize factor, for example: 2.0 = image resized to 50% of its orignal size, 0.5 = image resized by 100%
     * @param bool $useHtml Use HTML entities? Default: true
     * @param bool $useColor Use HTML colors? Default: true
     * @return AsciiArt
     */


    public function show($charsList, $resizeFactor = 1, $useHtml = false, $useColor = false) {




        if($useColor) {
            $useHtml = true;
        }
        $this->image->resize(($this->image->getWidth() - ($this->image->getWidth() % 8)) / $resizeFactor, ($this->image->getHeight() - ($this->image->getHeight() % 8)) / $resizeFactor);
        $colorImage = $this->image->getCopy();



        $fileName='/var/www/www.eclecticmeme.com/components/com_battle/images/sito/example.jpg';

        $charsImage = new Image($fileName);


        $width = $this->image->getWidth();


        $height = $this->image->getHeight();

        $allChars = implode('', range("a", "z")).implode('', range('A', 'Z')).implode('', range(0, 9)).'.,;!@#$%^&*()-= +[]\\{}:"<>?';
        $allChars = str_split($allChars, 1);


        foreach($allChars as $index => $char) {
            if(!in_array($char, $charsList)) {
                $allChars[$index] = null;
            }
        }

        $quantizator = new Quantizator();
        $charSize = new Dimensions(8, 11);





        foreach($allChars as $index => $char) {
            if(!$char) {
                continue;
            }



            var_dump(method_exists($charsImage,'getSubImage'));

        //	exit();

            // fetch an image of the given character
            $charImage = $charsImage->getSubImage(new Point($index * 8, 0), $charSize);




                    print_r($charImage);

            // add vector to the glyphs collection
            $quantizator->addGlyph($charImage->getVector(), $char);
        }

        $this->image->toGrayScale();
        $this->image->toBinary(false, true);
        $gd = $colorImage->getGd2Handle();

        if($useHtml) {
            echo '<div style="'.$this->css.'">';
        }
        $lastColor = -1;
        $r1 = -1000; $g1 = 0; $b1 = 0;



    //////////////////////////////////////////////////


        for($y = 0; $y < $height; $y += 11) {
            for($x = 0; $x < $width; $x += 8) {



            $stuff =	new Point($x, $y);


                $search = $this->image->getSubImage($stuff, $charSize)->getVector();



                $result = $quantizator->findNearestEuklid($search);
                $char = $result[0];
                /*
                if($useHtml) {
                    $char = htmlspecialchars($char);
                }
                if($useColor) {
                    $r = 0; $g = 0; $b = 0;
                    $hits = 0;
                    for($k = $x, $maxX = min($x + 8, $width); $k < $maxX; ++$k) {
                        for($l = $y, $maxY = min($y + 11, $height); $l < $maxY; ++$l) {
                            $rgb = imagecolorat($gd, $k, $l);
                            $r += ($rgb >> 16) & 0xff;
                            $g += ($rgb >> 8) & 0xff;
                            $b += $rgb & 0xff;
                            $hits++;
                        }
                    }
                    $r /= $hits;
                    $g /= $hits;
                    $b /= $hits;
                    $color = new Color($r, $g, $b);
                    $color = $color->getHexValue();
                    if($lastColor !== $color && (abs($r - $r1) > $this->threshold || abs($g - $g1) > $this->threshold || abs($b - $b1) > $this->threshold)) {
                        if($lastColor !== -1) {
                            $lastColor = $color;
                            echo '</span>';
                        } else {

                        }
$lastColor = $color;
                            $r1 = $r;
                            $g1 = $g;
                            $b1 = $b;
                        echo '<span style="color: #'.$color.'">';
                    }
                }
                */

                echo $char;

            }
            if($useHtml) {
                echo "<br />";
            } else {
                echo "\n";
            }
        }
        if($useColor) {
            echo '</span>';
        }
        if($useHtml) {
            echo "</div>";
        }



        return $this;
    }
}
