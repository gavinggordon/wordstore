<?php

use GGG\WordStore\Builder;

class BuilderTest extends \PHPUnit_Framework_TestCase
{

	public $builder;
	private $dictionaryFile;
	
	public function __construct()
	{
		$this->dictionaryFile = __DIR__ . DIRECTORY_SEPARATOR . 'dict.json';
		$this->builder = new Builder( __DIR__ . DIRECTORY_SEPARATOR . 'dict.json' );
		$this->assertFileExists( $this->dictionaryFile );
	}

	public function testAdd()
    {
		$this->builder->add( 'noun', 'friend', ['translation'=>'vuča','gender'=>'conditional'] );
		$word = $this->builder->find( 'friend' );
        $this->assertCount( 1, $word );
    }
	
	public function testFind()
    {
		$word = $this->builder->find( 'friend' );
		$actual = $word[ 0 ]->translation;
		$expected = 'vuča';
        $this->assertSame( $expected, $actual );
    }
	
	public function __destruct()
	{
		unlink( $this->dictionaryFile );
	}
	
}
