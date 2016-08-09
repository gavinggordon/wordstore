<?php

namespace GGG;

class WordStore
{

  const VERSION = '2.0.4';
  private $dictionary_file;
  private $parts_of_speech = [
    'adjective',
    'adverb',
    'article',
    'interjection',
    'noun',
    'personalpronoun',
    'preposition',
	'pronoun',
    'punctuation',
    'verb'
  ];

 /*
  * @return void 
  */
  private function init()
  {
    if(! file_exists( $this->dictionary_file ) ) {
      $file = $this->dictionary_file;
      $dictionary = new \stdClass();
      $dictionary->adjectives = [];
      $dictionary->adverbs = [];
      $dictionary->articles = [];
      $dictionary->interjections = [];
      $dictionary->nouns = [];
      $dictionary->personalpronouns = [];
      $dictionary->prepositions = [];
	  $dictionary->pronouns = [];
      $dictionary->punctuations = [];
      $dictionary->verbs = [];
      $this->save( $dictionary );
    }
  }

 /*
  * @param string $filename  ( optional )
  *
  * @return object 
  */
  public function __construct( $filename = 'dictionary.json' )
  {
    $this->dictionary_file = $filename;
    $this->init();
    return $this;
  }

 /*
  * @param string $part_of_speech
  * @param string $new_word
  * @param array $word_params
  *
  * @return object | FALSE 
  */
  public function addto( $part_of_speech, $new_word, $word_params = [] )
  {
    if( in_array( $part_of_speech, $this->parts_of_speech ) ) {
      if(! $this->find( $new_word, $part_of_speech ) ) {
        $dict = $this->get_dictionary( 1 );
        $new_word = trim( $new_word );
        $ppos = $part_of_speech . 's';
        foreach( $word_params as $prop => $val ) {
          $prop = strtolower( $prop );
          $dict[ $ppos ][ $new_word ][ $prop ] = $val;
        }
        $this->save( $dict );
        return $this;
      }
    }
    return FALSE;
  }

 /*
  * @param string $part_of_speech
  * @param string $new_word
  * @param array $word_params
  *
  * @return object | array 
  */
  public function add( $part_of_speech, $new_word, $word_params = [] )
  {
    $function = 'add_' . strtolower( $part_of_speech );
    $new_word = trim( $new_word );
    $this->$function( $new_word, $word_params );
  }

 /*
  * @param integer $return_obj  ( optional ) 
  *
  * @return object | array 
  */
  private function get_dictionary( $return_obj = 0 )
  {
    if( $return_obj === 0 ) {
      return json_decode( file_get_contents( $this->dictionary_file ) );
    }
    if( $return_obj === 1 ) {
      return json_decode( file_get_contents( $this->dictionary_file ), TRUE );
    }
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_noun( $word, $params )
  {
    if(! $this->find( $word, 'noun' ) ) {
      $dict = $this->get_dictionary( 1 );
      $word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $dict['nouns'][ $word ][ $prop ] = $val;
      }
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }
  
 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_pronoun( $word, $params )
  {
    if(! $this->find( $word, 'pronoun' ) ) {
      $dict = $this->get_dictionary( 1 );
      $word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $dict['pronouns'][ $word ][ $prop ] = $val;
      }
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_verb( $word, $params )
  {
    if(! $this->find( $word, 'verb' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->verbs, $newWord );
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_preposition( $word, $params )
  {
    if(! $this->find( $word, 'preposition' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->prepositions, $newWord );
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_adjective( $word, $params )
  {
    if(! $this->find( $word, 'adjective' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->adjectives, $newWord );
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_article( $word, $params )
  {
    if(! $this->find( $word, 'article' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->articles, $newWord );
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_personalpronoun( $word, $params )
  {
    if(! $this->find( $word, 'personalpronoun' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->personalpronouns, $newWord );
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_adverb( $word, $params )
  {
    if(! $this->find( $word, 'adverb' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->adverbs, $newWord );
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_interjection( $word, $params )
  {
    if(! $this->find( $word, 'interjection' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->interjections, $newWord );
      $this->save( $dict );
      return $this;
    }
    return FALSE;;
  }

 /*
  * @param string $word 
  * @param array $params
  *
  * @return object | FALSE 
  */
  private function add_punctuation( $word, $params )
  {
    if(! $this->find( $word, 'punctuation' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = trim( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->punctuations, $newWord );
      $this->save( $dict );
      return $this;
    }
    return FALSE;
  }

 /*
  * @param array $updated_data 
  *
  * @return object | FALSE 
  */
  private function save( $updated_data )
  {
    $json = json_encode( $updated_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    if( file_put_contents( $this->dictionary_file, $json ) ) {
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word
  * @param string $part_of_speech  ( optional )
  * @param string $param  ( optional )
  *
  * @return array | FALSE 
  */
  public function find( $word, $part_of_speech = NULL, $param = NULL )
  {
    $found = [];
    $word = trim( $word );
    $dict = $this->get_dictionary( 1 );
    if( $part_of_speech !== NULL ) {
      $pos = strtolower( $part_of_speech );
      if( in_array( $pos, $this->parts_of_speech ) ) {
        $ppos = $pos . 's';
        if( $param !== NULL && (! empty( $param ) ) && is_string( $param ) && isset( $dict[ $ppos ][ $word ][ $param ] ) ) {
          $found = $dict[ $ppos ][ $word ][ $param ];
        }
        if( $param === NULL && isset( $dict[ $ppos ][ $word ] ) ) {
          $found = $dict[ $ppos ][ $word ];
        }
      }
    }
    if( $part_of_speech === NULL ) {
      foreach( $dict as $prop => $val ) {
        if( $param !== NULL && (! empty( $param ) ) && is_string( $param ) && isset( $dict[ $prop ][ $word ][ $param ] ) ) {
          $found = $dict[ $prop ][ $word ][ $param ];
        }
        else if( $param === NULL && isset( $dict[ $prop ][ $word ] ) ) {
          $found = $dict[ $prop ][ $word ];
        }
      }
    }
    if( ( is_array( $found ) && count( $found ) ) || ( is_string( $found ) && strlen( $found ) > 1 ) ) {
      return $found;
    } else {
      return FALSE;
    }
  }

 /*
  * @param string $newvalue
  * @param string $oldvaluekey
  * @param string $part_of_speech  ( optional )
  * @param string $param  ( optional )
  *
  * @return object | FALSE 
  */
  public function update( $newvalue, $oldvaluekey, $part_of_speech = NULL, $param = NULL )
  {
    $newvalue = trim( $newvalue );
    $oldvaluekey = trim( $oldvaluekey );
    $dict = $this->get_dictionary( 1 );
    if( $part_of_speech !== NULL ) {
      $pos = strtolower( $part_of_speech );
      if( in_array( $pos, $this->parts_of_speech ) ) {
        $ppos = $pos . 's';
        if( $param !== NULL && (! empty( $param ) ) && is_string( $param ) && isset( $dict[ $ppos ][ $oldvaluekey ][ $param ] ) ) {
          $dict[ $ppos ][ $oldvaluekey ][ $param ] = $newvalue;
        }
        if( $param === NULL && isset( $dict[ $ppos ][ $oldvaluekey ] ) ) {
          $dict[ $ppos ][ $oldvaluekey ] = $newvalue;
        }
      }
    }
    if( $part_of_speech === NULL ) {
      foreach( $dict as $prop => $val ) {
        if( $param !== NULL && (! empty( $param ) ) && is_string( $param ) && isset( $dict[ $prop ][ $oldvaluekey ][ $param ] ) ) {
          $dict[ $prop ][ $oldvaluekey ][ $param ] = $newvalue;
        }
        else if( $param === NULL && isset( $dict[ $prop ][ $oldvaluekey ] ) ) {
          $dict[ $prop ][ $oldvaluekey ] = $newvalue;
        }
      }
    }
    if( $this->save( $dict ) ) {
      return $this;
    }
    return FALSE;
  }

 /*
  * @param string $word
  * @param string $part_of_speech  ( optional )
  *
  * @return object | FALSE 
  */
  public function delete( $word, $part_of_speech = NULL )
  {
    $dict = $this->get_dictionary( 1 );
    $word = trim( $word );
    if( $part_of_speech !== NULL ) {
      $pos = strtolower( $part_of_speech );
      if( in_array( $pos, $this->parts_of_speech ) ) {
        $ppos = $pos . 's';
        if( isset( $dict[ $ppos ][ $word ] ) ) {
          $dict[ $ppos ][ $word ] = NULL;
          unset( $dict[ $ppos ][ $word ] );
        }
      }
    }
    if( $part_of_speech === NULL ) {
      foreach( $dict as $prop => $val ) {
        if( isset( $dict[ $prop ][ $word ] ) ) {
          $dict[ $prop ][ $word ] = NULL;
          unset( $dict[ $prop ][ $word ] );
        }
      }
    }
    if( $this->save( $dict ) ) {
      return $this;
    }
    return FALSE;
  }

}