# WordStore v2.0

[![Build Status](https://travis-ci.org/gavinggordon/wordstore.svg?branch=master)](https://travis-ci.org/gavinggordon/wordstore)

## Synopsis

This PHP class ( GGG\WordStore ) is a CRUD compliant language data storage class. It provides the ability to create a language dictionary. All enteries you create are stored in the WordStore and can contain user-definited parameters, all of which can be: searched and retrieved; updated; and, deleted.

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
	// @param string $dictionary_file *optional* 
	// default value = 'dictionary.json'
	//  
	// );
	//
	// @return object
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
	// WordStore->addTo(
	//
	//	@param string $part_of_speech *required*
	// possible values =	
	// 'adjective' || 'adverb' || 'article' || 'interjection' ||
	// 'noun' || 'pronoun' || 'personalpronoun' || 
	// 'preposition' || 'punctuation' || 'verb'
	//
	//	@param string $word *required*
	//	possible values = *
	//
	//	@param array $params *required*
	//	possible values = *
	//
	// );
	//
	// @return object | FALSE
	//
	
	$wordstore->addTo( 'noun', 'vuča', [ 
		'translation' => 'friend',
		'pronounciation' => 'voo-cha' 
	] );
```

#### Finding a word...

```
	//
	// WordStore->find(
	//
	//	@param string $value *required*
	//	possible values = *
	//
	//	@param string $part_of_speech *optional*
	// default value = NULL
	// possible values =	
	// 'adjective' || 'adverb' || 'article' || 'interjection' ||
	// 'noun' || 'pronoun' || 'personalpronoun' || 
	// 'preposition' || 'punctuation' || 'verb'
	//
	//	@param string $param *optional*
	// default value = NULL
	//	possible values = *
	//
	// );
	//
	// @return array | FALSE;
	//
	
	$word = $wordstore->find( 'vuča' );
	print_r( $word );
	 
	//
	// Array
	// (
	//	  [0] => stdClass Object
	//	       (
	//              [translation] => friend
	//              [pronounciation] => voo-cha
	//        )
	// );
	//
```

#### Updating a word...

```
	//
	// WordStore->update(
	//
	//	@param string $newvalue *required*
	//	possible values = *
	//
	//	@param string $oldvalue *required*
	//	possible values = *
	//
	//	@param string $part_of_speech *optional*
	// default value = NULL
	// possible values = 
	// 'adjective' || 'adverb' || 'article' || 'interjection' ||
	// 'noun' || 'pronoun' || 'personalpronoun' || 
	// 'preposition' || 'punctuation' || 'verb'
	//
	//	@param string $param *optional*
	// default value = NULL
	//	possible values = *
	//
	// );
	//
	// @return object | FALSE
	//
	
	$wordstore->update( 'partner', 'vuča', 'noun', 'translation' );
	$word = $wordstore->find( 'buddy' );
	 
	//
	// Array
	// (
	//	  [0] => stdClass Object
	//	       (
	//              [translation] => partner
	//              [pronounciation] => voo-cha
	//        )
	// );
	//
```

#### Deleting a word...

```
	//
	// WordStore->delete(
	//
	//	@param string $newvalue *required*
	//	possible values = *
	//
	//	@param string $part_of_speech *optional*
	// default value = NULL
	// possible values = 
	// 'adjective' || 'adverb' || 'article' || 'interjection' ||
	// 'noun' || 'pronoun' || 'personalpronoun' || 
	// 'preposition' || 'punctuation' || 'verb'
	//
	// );
	//
	// @return object | FALSE
	//
	
	$wordstore->delete( 'vuča', 'noun' );
	$word = $wordstore->find( 'vuča' );
	 
	//
	// FALSE
	//
```

--------------

#### More Information

##### PHP Innovation Award

This [class](http://www.phpclasses.org/package/9724.html) has been nominated for a PHP Innovation Award, provided by [PHPClasses.org](http://www.phpclasses.org). If you found [this class](http://www.phpclasses.org/package/9724.html) to be at all interesting, helpful, particularly useful, or innovative in any way, please [vote](http://www.phpclasses.org/vote.html) for it, to show your support for [this](http://www.phpclasses.org/package/9724.html) or any other PHP classes accessible online via my [GitHub profile](https://github.com/gavinggordon) or [PHPClasses.org profile](http://www.phpclasses.org/browse/author/1348645.html).

--------------