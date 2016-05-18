<?php

require_once 'Color.class.php';

class Vertex
{
	private 		$_x;
	private 		$_y;
	private 		$_z;
	private 		$_w = 1.0;
	private 		$_color;
	public static	$verbose = FALSE;

	public function __construct(array $kwargs)
	{
		$this->setX($kwargs['x']);
		$this->setY($kwargs['y']);
		$this->setZ($kwargs['z']);
		if (array_key_exists('w', $kwargs))
			$this->setW($kwargs['w']);
		if (array_key_exists('color', $kwargs))
			$this->setColor($kwargs['color']);
		else 
			$this->setColor(new Color(array('red' => 255, 'green' => 255, 'blue' =>   255)));
		if (self::$verbose)
			echo $this->_verbose() . ' constructed' . PHP_EOL;

	}

	public function getX() {return $this->_x;}
	public function getY() {return $this->_y;}
	public function getZ() {return $this->_z;}
	public function getW() {return $this->_w;}
	public function getColor() {return $this->_color;}

	public function setX($x)
	{
		$this->_x = $x;
	}

	public function setY($y)
	{
		$this->_y = $y;
	}

	public function setZ($z)
	{
		$this->_z = $z;
	}

	public function setW($w)
	{
		$this->_w = $w;
	}

	public function setColor(Color $color)
	{
		$this->_color = $color;
	}

	public function __toString()
	{
		return $this->_verbose();
	}

	private function _verbose()
	{
		if (self::$verbose)
	        return sprintf("Vertex( x: %4.2f, y: %4.2f, z:%4.2f, w:%4.2f, %s )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
        return sprintf("Vertex( x: %4.2f, y: %4.2f, z:%4.2f, w:%4.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
	}

	public static function doc()
	{
		if (file_exists('Vertex.doc.txt'))
			return file_get_contents('Vertex.doc.txt') . PHP_EOL;
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo $this->_verbose() . ' destructed' . PHP_EOL;
	}
}
?>
