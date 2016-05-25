# WordStore v1.1.1

[![Build Status](https://travis-ci.org/gavinggordon/wordstore.svg?branch=master)](https://travis-ci.org/gavinggordon/wordstore)

## Synopsis

This class (GGG\WordStore) allows one to create a language dictionary, by adding words and their translations, both of which can be searched for and retrieved after adding, in addition to custom parameters. 

## How to use 'WordStore'

### Install via Composer...

```
	composer require gavinggordon/wordstore
```

### Include autoload.php...

```
	include_once( __DIR__ . '/vendor/autoload.php' );
```

### Create new instance...

```
	//
	// new WordStore( 
	// 
	// @var string $dictionary_file *optional* 
	// default value = 'dictionary.json'
	//  
	// );
	//
	// returns $self;
	// 
	
	$json_dictionary_file = __DIR__ . '/myDictionary.json';
	// optionally, override the default name to be used for the .json
	// dictionary file, where all the related word data will be stored
	
	$wordstore = new GGG\WordStore( $json_dictionary_file );
	// creates dictionary file, if it doesn't already exist
```

#### Adding a word...

```
	//
	// WordStore->add(
	//
	//	@var string $part_of_speech *required*
	// possible values =	
	// 'adjective' || 'adverb' || 'article' || 'interjection' ||
	// 'noun' || 'pronoun' || 'personalpronoun' || 
	// 'preposition' || 'punctuation' || 'verb'
	//
	//	@var string $word *required*
	//	possible values = *
	//
	//	@var array $params *required*
	//	possible values = *
	//
	// );
	//
	// returns $self;
	//
	
	$wordstore->add( 'noun', 'friend', ['translation'=>'vuča','gender'=>'conditional'] );
```

#### Finding a word...

```
	//
	// WordStore->find(
	//
	//	@var string $value *required*
	//	possible values = *
	//
	//	@var string $part_of_speech *optional*
	// default value = NULL
	// possible values =	
	// 'adjective' || 'adverb' || 'article' || 'interjection' ||
	// 'noun' || 'pronoun' || 'personalpronoun' || 
	// 'preposition' || 'punctuation' || 'verb'
	//
	//	@var string $param *optional*
	// default value = 'word'
	//	possible values = *
	//
	// );
	//
	// returns $found Array || FALSE;
	//
	
	$word = $wordstore->find( 'friend' );
	print_r( $word );
	 
	//
	// Array
	// (
	//	  [0] => stdClass Object
	//	       (
	//              [word] => friend
	//              [translation] => vuča
	//              [gender] => conditional
	//        )
	// );
	//
```

#### Updating a word...

```
	//
	// WordStore->update(
	//
	//	@var string $newvalue *required*
	//	possible values = *
	//
	//	@var string $oldvalue *required*
	//	possible values = *
	//
	//	@var string $part_of_speech *optional*
	// default value = NULL
	// possible values = 
	// 'adjective' || 'adverb' || 'article' || 'interjection' ||
	// 'noun' || 'pronoun' || 'personalpronoun' || 
	// 'preposition' || 'punctuation' || 'verb'
	//
	//	@var string $param *optional*
	// default value = 'word'
	//	possible values = *
	//
	// );
	//
	// returns $self;
	//
	
	$wordstore->update( 'buddy', 'friend' );
	$word = $wordstore->find( 'buddy' );
	 
	//
	// Array
	// (
	//	  [0] => stdClass Object
	//	       (
	//              [word] => buddy
	//              [translation] => vuča
	//              [gender] => conditional
	//        )
	// );
	//
```
