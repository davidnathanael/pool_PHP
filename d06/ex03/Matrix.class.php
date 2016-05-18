<?php


require_once 'Vertex.class.php';
require_once 'Vector.class.php';

class Matrix{

	const			IDENTITY	= 0;
	const			SCALE		= 1;
	const			RX			= 2;
	const			RY			= 3;
	const			RZ			= 4;
	const			TRANSLATION	= 5;
	const			PROJECTION	= 6;

	private			$_matrix;

	public static	$verbose = FALSE;

	public function	__construct(array $kwargs)
	{
		$_preset = $kwargs['preset'];

		if ($_preset == self::IDENTITY)
			$this->_createIdentityMatrix();
		else if ($_preset == self::SCALE)
		{
			if (array_key_exists('scale', $kwargs))
				$this->_createScaleMatrix($kwargs['scale']);
		}
		else if ($_preset == self::RX)
		{
			if (array_key_exists('angle', $kwargs))
				$this->_createRotXMatrix($kwargs['angle']);
		}
		else if ($_preset == self::RY)
		{
			if (array_key_exists('angle', $kwargs))
				$this->_createRotYMatrix($kwargs['angle']);
		}
		else if ($_preset == self::RZ)
		{
			if (array_key_exists('angle', $kwargs))
				$this->_createRotZMatrix($kwargs['angle']);
		}
		else if ($_preset == self::TRANSLATION)
		{
			if (array_key_exists('vtc', $kwargs))
				$this->_createTranslationMatrix($kwargs['vtc']);
		}
		else if ($_preset == self::PROJECTION)
		{
			if (array_key_exists('fov', $kwargs)		&& array_key_exists('ratio', $kwargs)
				&& array_key_exists('near', $kwargs)	&& array_key_exists('far', $kwargs)   )
				$this->_createProjectionMatrix($kwargs['fov'], $kwargs['ratio'], $kwargs['near'], $kwargs['far']);
		}	
	}

	private function	_createIdentityMatrix()
	{
		$this->_matrix = array(
			array( 1, 0, 0, 0 ),
			array( 0, 1, 0, 0 ),
			array( 0, 0, 1, 0 ),
			array( 0, 0, 0, 1 )
		);
		if (self::$verbose)
			print('Matrix IDENTITY instance constructed' . PHP_EOL);
	}

	private function	_createTranslationMatrix($vtc)
	{
		$this->_matrix = array(
			array( 1,	0,	0,	$vtc->getX()	),
			array( 0,	1,	0,	$vtc->getY()	),
			array( 0,	0,	1,	$vtc->getZ()	),
			array( 0,	0,	0,	1				)
		);
		if (self::$verbose)
			print('Matrix TRANSLATION preset instance constructed' . PHP_EOL);
	}

	private function	_createScaleMatrix($s)
	{
		$this->_matrix = array(
			array( $s,	0,	0,	0 ),
			array( 0,	$s,	0,	0 ),
			array( 0,	0,	$s,	0 ),
			array( 0,	0,	0,	1 )
		);
		if (self::$verbose)
			print('Matrix SCALE preset instance constructed' . PHP_EOL);
	}

	private function	_createRotXMatrix($angle)
	{
		$cos = cos($angle);
		$sin = sin($angle);


		$this->_matrix = array(
			array( 1,	0,		0,		0 ),
			array( 0,	$cos,	-$sin,	0 ),
			array( 0,	$sin,	$cos,	0 ),
			array( 0,	0,		0,		1 )
		);
		if (self::$verbose)
			print('Matrix Ox ROTATION preset instance constructed' . PHP_EOL);
	}

	private function	_createRotYMatrix($angle)
	{
		$cos = cos($angle);
		$sin = sin($angle);


		$this->_matrix = array(
			array( $cos,	0,		$sin,	0 ),
			array( 0,		1,		0,		0 ),
			array( -$sin,	0,		$cos,	0 ),
			array( 0,		0,		0,		1 )
		);
		if (self::$verbose)
			print('Matrix Oy ROTATION preset instance constructed' . PHP_EOL);
	}

	private function	_createRotZMatrix($angle)
	{
		$cos = cos($angle);
		$sin = sin($angle);


		$this->_matrix = array(
			array( $cos,	-$sin,	0,		0 ),
			array( $sin,	$cos,	0,		0 ),
			array( 0,		0,		1,		0 ),
			array( 0,		0,		0,		1 )
		);
		if (self::$verbose)
			print('Matrix Oz ROTATION preset instance constructed' . PHP_EOL);
	}

	private function	_createProjectionMatrix($fov, $ratio, $near, $far)
	{
		$f = 1 / tan (deg2rad($fov / 2));

		$this->_matrix = array(
			array( $f / $ratio,	0,		0,									0 ),
			array( 0,			$f,		0,									0 ),
			array( 0,			0,		($far + $near) / ($near - $far),	(2 * $far * $near) / ($near - $far) ),
			array( 0,			0,		-1,									0 )
		);
		if (self::$verbose)
			print('Matrix PROJECTION preset instance constructed' . PHP_EOL);
	}

	public function mult(Matrix $rhs)
	{
		$ret = clone $this; 
		for ($i=0; $i < 4; $i++)
		{ 
			for ($j=0; $j < 4; $j++)
				$ret->_matrix[$i][$j] = $this->_getVectorRow($i)->dotProductWithW($rhs->_getVectorColumn($j));
		}
		return $ret;
	}

	private function _getVectorRow($i)
	{
		$vertex = new Vertex( array( 'x' => $this->_matrix[$i][0],
								     'y' => $this->_matrix[$i][1],
								     'z' => $this->_matrix[$i][2],
								     'w' => $this->_matrix[$i][3]) );
		return (new Vector( array( 'dest' => $vertex)));
	}

	private function _getVectorColumn($j)
	{
		$vertex = new Vertex( array( 'x' => $this->_matrix[0][$j],
								     'y' => $this->_matrix[1][$j],
								     'z' => $this->_matrix[2][$j],
								     'w' => $this->_matrix[3][$j]) );
		return new Vector( array( 'dest' => $vertex));
	}



	public function transformVertex(Vertex $vtx) {

			$x = $this->_getVectorRow(0)->dotProductWithW( new Vector( array('dest' => $vtx ) ) );
			$y = $this->_getVectorRow(1)->dotProductWithW( new Vector( array('dest' => $vtx ) ) );
			$z = $this->_getVectorRow(2)->dotProductWithW( new Vector( array('dest' => $vtx ) ) );
			$w = $this->_getVectorRow(3)->dotProductWithW( new Vector( array('dest' => $vtx ) ) );

			return ( new Vertex (array( 'x' => $x, 'y' => $y, 'z' => $z, 'w' => $w) ) );	
	}

	public function	__toString()
	{
		$ret  = sprintf	("M | vtcX | vtcY | vtcZ | vtxO" . PHP_EOL);
		$ret .= sprintf	("-----------------------------" . PHP_EOL);
		$ret .= sprintf	("x | %.2f | %.2f | %.2f | %.2f" . PHP_EOL, $this->_matrix[0][0],
						$this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3]);
		$ret .= sprintf	("y | %.2f | %.2f | %.2f | %.2f" . PHP_EOL, $this->_matrix[1][0],
						$this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3]);
		$ret .= sprintf	("z | %.2f | %.2f | %.2f | %.2f" . PHP_EOL, $this->_matrix[2][0],
						$this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3]);
		$ret .= sprintf	("w | %.2f | %.2f | %.2f | %.2f", $this->_matrix[3][0],
						$this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3]);
		return $ret;
	}

	public static function doc()
	{
		return file_get_contents('Matrix.doc.txt');
	}

	public function __destruct()
	{
		if (self::$verbose)
			print('Matrix instance destructed' . PHP_EOL);
	}
}

?>