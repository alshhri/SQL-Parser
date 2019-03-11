<?php
/*
 * copy[left] :) to hassan alshhri (alshhri@msn.com)
// * SQL parser Class for Select Statment
 * start 15-Dec-2010
 * end not yet 
 */

class select
{
    public $r_words    = array("select","from","where");
    public $statment;
    public $array;
    public $array_first;
    public $field;


    public  function spliting()
    {        
        $this->statment    =    strtolower($this->statment);
        $this->array[0]    =    stristr($this->statment," from ", 1);
        $this->array[1]    =    stristr($this->statment," from ");
        if(preg_match("/where/i",$this->array[1]))
        {
            $this->array[1]    = stristr($this->array[1],"where",1);
            $this->array[2]    = stristr($this->statment,"where");
    
        }        
    }
    public function first_cat()
    {
        if(preg_match("/[*]/",$this->array[0]))
        {
            //this is select if user select all by using *
            $x = str_ireplace(" ","",$this->array[0]);
            if($x == "select*")
            {
                print "First is OK";
            }
            else
            {
                print "ERROR";
                exit();
            }
        }
        else
        {
            ///// this is select if the user spcefiy a field [field1],[field]
            //6-4-2011
            if(preg_match("/select/i",  $this->array[0]))
            {
                $temp           =   str_ireplace(" ","",$this->array[0]);
                $temp           =   preg_split("/^select/i", $temp);
                $this->field    =   preg_split("[,]", $temp[1]);
                foreach ($this->field as $key => $value) {
                    if(!empty($value))
                    {
                       $this->field[$key]    = $value;
                       $this->check_field($value);
                    }
                    else
                    {
                       print "ERROR";
                       exit();
                    }
                }
                $this->printr2($this->field);
            }
            else
            {
                print "ERROR";
                exit();
            }
        }
    }
/*
    
	public function second_cat()
    {
        
    }
*/
    public function check_field($val)
    {
        // check if there are ( ` ) or not 
		if((preg_match("/^[`]/", $val))and(preg_match("/[`]$/", $val)))
        {
            //with (`) you can use r_words
            $val    =   preg_replace("/^[`]/","", $val);
            $val    =   preg_replace("/[`]$/","", $val);
            //agg functions with (`)
            if(preg_match("/^(max[(]|min[(]|sum[(]|avg[(]|count[(])/", $val)and (preg_match("/[)]$/", $val)))
            {
                $val    =   preg_replace("/^(max[(]|min[(]|sum[(]|avg[(]|count[(])/","", $val);
                $val    =   preg_replace("/[)]$/", "", $val);
                //for check the field name
            }
			elseif(preg_match("/[(]|[)]/", $val))
			{
				print "ERROR";
                exit();
			}
        }
        else
        {
            //agg functions with (`)
            if(preg_match("/^(max[(]|min[(]|sum[(]|avg[(]|count[(])/", $val)and (preg_match("/[)]$/", $val)))
            {
                $val    =   preg_replace("/^(max[(]|min[(]|sum[(]|avg[(]|count[(])/","", $val);
                $val    =   preg_replace("/[)]$/", "", $val);
                //for check the field name
            }
			elseif(preg_match("/[(]|[)]/", $val))
			{
				print "ERROR";
                exit();
			}
            if(in_array($val,$this->r_words))
            {
                print "ERROR";
                exit();
            }
        }
    }
    public function printr2($val)
    {
        echo '<pre>';
        print_r($val);
        echo  '</pre>';
    }
}
?>
