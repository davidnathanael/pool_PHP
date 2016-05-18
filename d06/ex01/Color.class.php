<?php
class Color
{
    public $red = 0;
    public $green = 0;
    public $blue = 0;
    public static $verbose = FALSE;

    public function __construct(array $kwargs)
    {
        if (array_key_exists('rgb', $kwargs))
        {
            $this->red = (int)(($kwargs['rgb'] >> 16) & 0xFF);
            $this->green = (int)(($kwargs['rgb'] >> 8) & 0xFF);
            $this->blue = (int)($kwargs['rgb'] & 0xFF);
        }
        else
        {
            $this->red = (int)$kwargs['red'];
            $this->green = (int)$kwargs['green'];
            $this->blue = (int)$kwargs['blue'];
        }
        if (self::$verbose)
            echo $this->_verbose() . ' constructed.' . PHP_EOL;
    }

    public function add(Color $instance)
    {
        return new Color(array(
            'red' => $this->red + $instance->red,
            'green' => $this->green + $instance->green,
            'blue' => $this->blue + $instance->blue));
    }

    public function sub(Color $instance)
    {
        return new Color(array(
            'red' => $this->red - $instance->red,
            'green' => $this->green - $instance->green,
            'blue' => $this->blue - $instance->blue));
    }

    public function mult($factor)
    {
        return new Color(array(
            'red' => $this->red * $factor,
            'green' => $this->green * $factor,
            'blue' => $this->blue * $factor));
    }

    public static function doc()
    {
    	return file_get_contents('Color.doc.txt') . PHP_EOL;
    }

    public function __toString()
    {
        return $this->_verbose();
    }

    private function _verbose()
    {
        return sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue);
    }

    public function __destruct()
    {
        if (self::$verbose)
            echo $this->_verbose() . ' destructed.' . PHP_EOL;
    }
}
?>