# WordStore

[![Build Status](https://travis-ci.org/gavinggordon/wordstore.svg?branch=master)](https://travis-ci.org/gavinggordon/wordstore)

This class (GGG\WordStore\Builder) allows one to create a language dictionary, by adding words and their translations, both of which can be searched for and retrieved after adding, in addition to custom parameters. 

## Installation

	composer require gavinggordon/wordstore

## Examples

#### Instantiation:

	include_once( __DIR__ . '/vendor/autoload.php' );
	
	// Define location a location and json filename for dictionary
	$json_dictionary_file = __DIR__ . DIRECTORY_SEPARATOR . 'dictionary.json';
	
	$wordstore = new \GGG\WordStore\Builder( $json_dictionary_file );

#### Adding:

	// \GGG\WordStore\Builder->add(
	//
	//	@var $part_of_speech String (required)
	// possible values =	'adjective',
	//								'adverb',
	//								'article',
	//								'interjection',
	//								'noun',
	//								'personalpronoun', 
	//								'preposition', 
	//								'punctuation',
	//								'verb'
	//
	//	@var $word String (required)
	//	possible values = *
	//
	//	@var $params Array (required)
	//	possible values = *
	//
	// );
	//
	// return $self;
	//
	
	$wordstore->add( 'noun', 'friend', ['translation'=>'vuča','gender'=>'conditional'] );

#### Finding:

	// \GGG\WordStore\Builder->find(
	//
	//	@var $value String (required)
	//	possible values = *
	//
	//	@var $part_of_speech String (optional)
	// default value = NULL
	// possible values =	'adjective',
	//								'adverb',
	//								'article',
	//								'interjection',
	//								'noun',
	//								'personalpronoun', 
	//								'preposition', 
	//								'punctuation',
	//								'verb'
	//
	//	@var $param String (optional)
	// default value = 'word'
	//	possible values = *
	//
	// );
	//
	// return $found Array || FALSE;
	//
	
	$word = $wordstore->find( 'friend' );
	print_r( $word );
	 
	// Array
	// (
	//	  [0] => stdClass Object
	//	       (
	//              [word] => friend
	//              [translation] => vuča
	//              [gender] => conditional
	//        )
	// );

