<?php

use GGG\WordStore;

class WordStoreTest extends \PHPUnit_Framework_TestCase
{

	public $wordstore;
	private $dictionaryFile;
	
	public function __construct()
	{
		$this->dictionaryFile = __DIR__ . DIRECTORY_SEPARATOR . 'dict.json';
		$this->wordstore = new WordStore( __DIR__ . DIRECTORY_SEPARATOR . 'dict.json' );
		$this->assertFileExists( $this->dictionaryFile );
	}

	public function testAdd()
    {
		$this->wordstore->add( 'noun', 'friend', ['translation'=>'vuča','gender'=>'conditional'] );
		$word = $this->wordstore->find( 'friend' );
        $this->assertCount( 1, $word );
    }
	
	public function testFind()
    {
		$word = $this->wordstore->find( 'friend' );
		$actual = $word[ 0 ]->translation;
		$expected = 'vuča';
        $this->assertSame( $expected, $actual );
    }
	
	public function testUpdate()
    {
		$this->wordstore->update( 'buddy', 'friend' );
		$word = $this->wordstore->find( 'buddy' );
        $this->assertCount( 1, $word );
    }
	
	public function __destruct()
	{
		unlink( $this->dictionaryFile );
	}
	
}
