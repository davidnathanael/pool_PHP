<?php

require_once 'Vertex.class.php';

class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;
	public static $verbose = FALSE;

	public function __construct(array $kwargs)
	{
		$dest = $kwargs['dest'];

		$this->_x = $dest->getX();
		$this->_y = $dest->getY();
		$this->_z = $dest->getZ();

		if (array_key_exists('orig', $kwargs))
			$orig = $kwargs['orig'];
		else
			$orig = new Vertex(array('x' => 0, 'y' => 0, 'z'=> 0));

		$this->_x = $dest->getX() - $orig->getX();
		$this->_y = $dest->getY() - $orig->getY();
		$this->_z = $dest->getZ() - $orig->getZ();

		if (self::$verbose)
			echo $this->_verbose() . ' constructed' . PHP_EOL;
	}

	public function	magnitude()
	{
		return sqrt(pow($this->getX(), 2) + pow($this->getY(), 2) + pow($this->getZ(), 2));
	}

	public function normalize()
	{
		$m = $this->magnitude();
		if ($m != 1)
		{
			$vertex = new Vertex(array(
						'x' => $this->getX() / $m,
						'y' => $this->getY() / $m,
						'z' => $this->getZ() / $m));
			return new Vector(array('dest' => $vertex));
		}
		return clone $this;
	}

	public function add(Vector $rhs)
	{
		$vertex = new Vertex(array(
					'x' => $this->getX() + $rhs->getX(),
					'y' => $this->getY() + $rhs->getY(),
					'z' => $this->getZ() + $rhs->getZ()));
		return new Vector(array('dest' => $vertex));
	}

	public function sub(Vector $rhs)
	{
		$vertex = new Vertex(array(
					'x' => $this->getX() - $rhs->getX(),
					'y' => $this->getY() - $rhs->getY(),
					'z' => $this->getZ() - $rhs->getZ()));
		return new Vector(array('dest' => $vertex));
	}

	public function opposite()
	{
		$vertex = new Vertex(array(
					'x' => -$this->getX(),
					'y' => -$this->getY(),
					'z' => -$this->getZ()));
		return new Vector(array('dest' => $vertex));
	}

	public function scalarProduct($k)
	{
		$vertex = new Vertex(array(
					'x' => $this->getX() * $k,
					'y' => $this->getY() * $k,
					'z' => $this->getZ() * $k));
		return new Vector(array('dest' => $vertex));
	}

	public function dotProduct(Vector $rhs)
	{
		return 	$this->getX() * $rhs->getX()
			+	$this->getY() * $rhs->getY()
			+	$this->getZ() * $rhs->getZ();
	}

	public function dotProductWithW(Vector $rhs)
	{
		return 	$this->getX() * $rhs->getX()
			+	$this->getY() * $rhs->getY()
			+	$this->getZ() * $rhs->getZ()
			+	$this->getW() * $rhs->getW();
	}

	public function cos(Vector $rhs)
	{
		$magProduct = $this->magnitude() * $rhs->magnitude();
		$dotProduct = $this->dotProduct($rhs);

		return ($dotProduct / $magProduct); 
	}

	public function crossProduct(Vector $rhs)
	{
		$x = $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY();
		$y = $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ();
		$z = $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX();
		$vertex = new Vertex(array(
					'x' => $x,
					'y' => $y,
					'z' => $z));
		return new Vector(array('dest' => $vertex));
	}

	/***** SPECIAL FUNCTIONS *****/

	public function __toString()
	{
		return $this->_verbose();
	}

	public static function doc()
	{
		if (file_exists('Vector.doc.txt'))
			return file_get_contents('Vector.doc.txt') . PHP_EOL;
	}

	private function _verbose()
	{
        return sprintf("Vector( x:%4.2f, y:%4.2f, z:%4.2f, w:%4.2f )", $this->getX(), $this->getY(), $this->getZ(), $this->_w);
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo $this->_verbose() . ' destructed' . PHP_EOL;
	}

	/***** ACCESSORS *****/

	public function getX()
	{
		return $this->_x;
	}
	public function getY()
	{
		return $this->_y;
	}
	public function getZ()
	{
		return $this->_z;
	}
	public function getW()
	{
		return $this->_w;
	}

}