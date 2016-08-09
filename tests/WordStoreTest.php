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
		$this->wordstore->add( 'noun', 'vuča', [
			'translation' => 'friend',
			'pronounciation' => 'voo-cha'
		] );
		$word = $this->wordstore->find( 'vuča', 'noun' );
		$actual = $word['translation'];
		$expected = 'friend';
        $this->assertSame( $expected, $actual );
    }
	
	public function testFind()
    {
		$word = $this->wordstore->find( 'vuča', 'noun' );
		$actual = $word['translation'];
		$expected = 'friend';
        $this->assertSame( $expected, $actual );
    }
	
	public function testUpdate()
    {
		$this->wordstore->update( 'partner', 'vuča', 'noun', 'translation' );
		$actual = $this->wordstore->find( 'vuča', 'noun', 'translation' );
        $expected = 'partner';
        $this->assertSame( $expected, $actual );
    }
	
	public function testDelete()
    {
		$this->wordstore->delete( 'vuča', 'noun' );
		$word = $this->wordstore->find( 'vuča' );
        $this->assertCount( 0, $word );
    }
	
	public function __destruct()
	{
		unlink( $this->dictionaryFile );
	}
	
}
