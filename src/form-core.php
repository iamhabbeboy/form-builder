<?php

/**
 * Form Generator - A Tiny PHP Library For Form Generator
 *
 * @package  FormCore
 * @author   Azeez Abiodun <azeez@megafusetech.com>
 */

namespace FormGen;

class FormCore
{

  private $g;
  private $setFileName;
  private $status;

  /**
   * @var return String
   */

  public function __construct( )
  {
    # code..
    $html = "<!DOCTYPE HTML>\n<html lang=\"en\">\n<head>\n";
    $html .= "<title>Form Generator </title>\n";
    $html .= "</head>\n";
    $html .= "<body>\n";
    $this->g = $html;
    $this->g .= "<h4>Form Generator</h4>\n\t<form method=\"post\"><br>\n\n";
  }


 /**
  * @var return Method
  */

  public function create( $params )
  {
    if ( count( $params ) > 1 ) {
     foreach ($params as $key => $value) {
       # code...
       if ( $key > 1 )
       {
         $this->forms($value);
         $this->status = true;
       } else if ( $key === 1 and !(preg_match('/:/', $value) ) )
       {
         $this->setFileName = $value;
       } else {
         #echo "File Name is required !";
       }
     }
   } else {
     #print "one or more form parameters is required !";
     $this->helper();
     $this->status = false;
   }
  }

  /**
   * @var return String
   * Form component
   */

  private function forms( $form_params )
  {
     $explode = explode(':', $form_params);
     $form_name = trim($explode[0]);
     $form_type = $explode[1];

     if ( $form_type === 'text' )
     {
       $this->g .= $this->text($form_name, $form_type);

     } else if ( $form_type === 'textarea' )
     {
       $this->g .= $this->textarea( $form_name, $form_type);

     } else if ( $form_type === 'checkbox' )
     {
       $this->g .= $this->checkbox( $form_name, $form_type);

     } else if ( $form_type === 'radio' )
     {
       $this->g .= $this->radio( $form_name, $form_type);

     } else if ( $form_type === 'file' )
     {
       $this->g .= $this->file( $form_name, $form_type);

     } else if ( $form_type === 'password' )
     {
       $this->g .= $this->password( $form_name, $form_type);

     } else if ( $form_type === 'number' )
     {
       $this->g .= $this->number( $form_name, $form_type);

     } else if ( $form_type === 'range' )
     {
       $this->g .= $this->range( $form_name, $form_type);

     } else if ( $form_type === 'date' )
     {
       $this->g .= $this->_date( $form_name, $form_type);

     } else if ( $form_type === 'select' )
     {
       $this->g .= $this->select( $form_name, $form_type);
     }
  }

  private function text($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type='text' name='".$name."'><br><br>\n\n";
    return $generator;
  }

  private function textarea($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<textarea name='".$name."'></textarea><br><br>\n\n";
    return $generator;
  }

  private function checkbox($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type=\"checkbox\" name='".$name."'><br><br>\n\n";
    return $generator;
  }

  private function radio($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type=\"radio\" name='".$name."'><br><br>\n\n";
    return $generator;
  }

  private function file($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type=\"file\" name='".$name."'><br><br>\n\n";
    return $generator;
  }

  private function password($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type=\"password\" name='".$name."'><br><br>\n\n";
    return $generator;
  }

  private function number($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type=\"number\" name='".$name."'><br><br>\n\n";
    return $generator;
  }

  private function range($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type=\"range\" name='".$name."'><br><br>\n\n";
    return $generator;
  }

  private function _date($name, $string)
  {
    $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type=\"date\" name='".$name."'><br><br>\n\n";
    return $generator;
  }

  private function select($name, $string)
  {
    //$generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t<input type=\"date\" name='".$name."'><br><br>\n\n";
    if ( preg_match('/-/', $name))
    {
      $explode = explode('-', $name);
      $html = "<select name=\"$name\">\n";
      foreach($explode as $option )
      {
        $html .= "\t<option value=\"$option\">".$option."</option>\n";
      }
      $html .= "</select><br><br>\n\n";
      $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t".$html;

    } else if ( preg_match('/../', $name) )
    {
      $explode = explode('_', $name);
      $html   = "<select name=\"$name\">\n";
      $start  = $explode[1];
      $number = explode('..', $start );
      $first  = $number[0];
      $to     = $number[1];

      for( $i = $first; $i <= $to; $i+=1 )
      {
          $html .= "\t<option value=\"$i\">". $i."</option>\n";
      }
      $html .= "</select><br><br>\n\n";
      $generator = "\t<label>". ucfirst( str_replace('_', ' ', $name) ) ."</label><br>\n\t".$html;

    }
    return $generator;
  }

  public function export()
  {

    if ( $this->status == true )
    {
        $this->g .= "\t<input type='submit' name='form-generator' value='Submit'>\n\t</form>\n\n";
        $this->g .= "</body>\n</html>";
        $rename = 1;
        $renameFileName = "generator".$rename.".html";

        if ( file_exists( "exports/" . $this->setFileName ) )
        {
          echo "[Error: ] File Name Exist !\n";
        } else {
          $open_file = fopen( "exports/" . $this->setFileName, "w+");
          fwrite($open_file, $this->g);
          fclose($open_file);
          print "\n\t *** Thanks for using Form Generator *** \n";
       }
    } else {

    }
  }

  public function helper()
  {
    $config = "\n\n\t[ Welcome to PHP Form-Generator ]\n";
    $config .= "\t This is a helper library that help you generate your form \n";
    $config .= "\t Form Type: \n";
    $config .= "\t text represent input text\n";
    $config .= "\t textarea represent textarea \n\n";
    $config .= "\t checkbox represent input checkbox\n";
    $config .= "\t radio represent input radio \n";
    $config .= "\t File represent input file \n";
    $config .= "\t Password represent input password \n";
    $config .= "\t Number represent input number \n";
    $config .= "\t Select represent select option\n";
    $config .= "\t Range represent input range\n";
    $config .= "\t Date represent input date\n\n";
    $config .= "\t [Select Option Usage:]\n";
    $config .= "\t php index.php filename.html age_18..25:select\n";
    $config .= "\t OR php index.php filename.html age-male-female\n";
    $config .= "\t Example:  php index.php save_as.html first_name:text last_name:text phone:text address:string\n\n";
    print $config;
  }

}
