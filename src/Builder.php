<?php

namespace GGG\WordStore;

class Builder
{

  private $dictionary_file;
  private $parts_of_speech = [
    'adjective',
    'adverb',
    'article',
    'interjection',
    'noun',
    'personalpronoun',
    'preposition',
    'punctuation',
    'verb'
  ];

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
      $dictionary->punctuations = [];
      $dictionary->verbs = [];
      $json = json_encode( $dictionary );
      file_put_contents( $file, $json );
      $this->beautify();
    }
  }

  public function __construct( $filename = 'dictionary.json' )
  {
    $this->dictionary_file = $filename;
    $this->init();
    return $this;
  }

  public function add( $part_of_speech, $new_word, $word_params )
  {
    $function = 'add_' . strtolower( $part_of_speech );
    $new_word = strtolower( $new_word );
    $this->$function( $new_word, $word_params );
  }

  private function get_dictionary( $format = 0 )
  {
    $json = file_get_contents( $this->dictionary_file );
    if( $format === 0 ) {
      $json = json_decode( $json );
    }
    if( $format === 1 ) {
      $json = json_decode( $json, TRUE );
    }
    return $json;
  }

  private function add_noun( $word, $params )
  {
    if(! $this->find( $word, 'noun' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->nouns, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function add_verb( $word, $params )
  {
    if(! $this->find( $word, 'verb' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->verbs, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function add_preposition( $word, $params )
  {
    if(! $this->find( $word, 'preposition' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->prepositions, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function add_adjective( $word, $params )
  {
    if(! $this->find( $word, 'adjective' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->adjectives, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function add_article( $word, $params )
  {
    if(! $this->find( $word, 'article' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->articles, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function add_personalpronoun( $word, $params )
  {
    if(! $this->find( $word, 'personalpronoun' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->personalpronouns, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function add_adverb( $word, $params )
  {
    if(! $this->find( $word, 'adverb' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->adverbs, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function add_interjection( $word, $params )
  {
    if(! $this->find( $word, 'interjection' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->interjections, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function add_punctuation( $word, $params )
  {
    if(! $this->find( $word, 'punctuation' ) ) {
      $dict = $this->get_dictionary();
      $newWord = new \stdClass();
      $newWord->word = strtolower( $word );
      foreach( $params as $prop => $val ) {
        $prop = strtolower( $prop );
        $newWord->$prop = $val;
      }
      array_push( $dict->punctuations, $newWord );
      $this->save( $dict );
    }
    return $this;
  }

  private function save( $updated_data )
  {
    $json = json_encode( $updated_data );
    file_put_contents( $this->dictionary_file, $json );
    $this->uglify()->beautify();
    return $this;
  }

  public function find( $value, $part_of_speech = NULL, $member = 'word' )
  {
    $found = [];
    $dict = $this->get_dictionary();
    if( $part_of_speech != NULL ) {
      $pos = strtolower( $part_of_speech );
      if( in_array( $pos, $this->parts_of_speech ) ) {
        $ppos = $pos . 's';
        $word = strtolower( $value );
        foreach($dict->$ppos as $k => $v) {
          if($v->$member == $word) {
            $found[$k] = $v;
          }
        }
      }
    }
    if( $part_of_speech == NULL ) {
      foreach( $this->parts_of_speech as $index => $pos ) {
        $ppos = $pos . 's';
        $word = strtolower( $value );
        foreach($dict->$ppos as $k => $v) {
          if($v->$member == $word) {
            $found[$k] = $v;
          }
        }
      }
    }
    if( count( $found ) ) {
      return $found;
    } else {
      return false;
    }
  }

  private function beautify()
  {
    $file = file_get_contents( $this->dictionary_file );
    $search = [ '{', '}', '[', ']', ',', ':' ];
    $replace = [ "{\r\n", "\r\n}", "[\r\n", "\r\n]", ",\r\n", ": " ];
    $new_content = str_replace( $search, $replace, $file );
    file_put_contents( $this->dictionary_file, $new_content );
    return $this;
  }

  private function uglify()
  {
    $file = file_get_contents( $this->dictionary_file );
    $search = [ "{\r\n", "\r\n}", "[\r\n", "\r\n]", ",\r\n", ": " ];
    $replace = [ '{', '}', '[', ']', ',', ':' ];
    $new_content = str_replace( $search, $replace, $file );
    file_put_contents( $this->dictionary_file, $new_content );
    return $this;
  }

}