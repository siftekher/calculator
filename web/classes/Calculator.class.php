<?php

class Calculator {
    private $expression;
    private $expressionArray;

    public function __construct($expression)
    {
        $this->expression = $expression;
    }
    
    public function getExpressionLength()
    {
        return count($this->expressionArray);
    }

    public function evaluteExpression()
    {
        $this->expressionArray = preg_split( '~(-?\d+|[()*/+-])~', $this->expression, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );
        
        $tmpArray = $this->expressionArray;
        $data = array_flip($tmpArray);

        while (in_array('(', $tmpArray)) {
            $lastOccuranceStart = $data['('];
            
            if(in_array(')', $tmpArray)) {
                $lastOccuranceEnd  = $data[')'];
            } else {
                $lastOccuranceEnd = count($tmpArray);
            }
            
            $innerArray = array_slice($tmpArray , $lastOccuranceStart+1, $lastOccuranceEnd-$lastOccuranceStart-1);
            $result = $this->doOperation($innerArray);

            $tmpArray[$lastOccuranceStart] = $result;
            for($i=$lastOccuranceStart+1; $i<=$lastOccuranceEnd; $i++){
                 unset($tmpArray[$i]);
            }

            $data = array_flip($tmpArray);
        }

        while (in_array('[', $tmpArray)) {
            $lastOccuranceStart = $data['['];
            if(in_array(']', $tmpArray)) {
                $lastOccuranceEnd  = $data[']'];
            } else {
                $lastOccuranceEnd = count($tmpArray);
            }
            
            $innerArray = array_slice($tmpArray, $lastOccuranceStart+1, $lastOccuranceEnd-$lastOccuranceStart-1 );

            $result = $this->doOperation($innerArray);
            $tmpArray[$lastOccuranceStart] = $result;
            for($i=$lastOccuranceStart+1; $i<=$lastOccuranceEnd; $i++){
                 unset($tmpArray[$i]);
            }
            $data = array_flip($tmpArray);
        }
        
        return $this->doOperation($tmpArray );
    }
    
    public function doOperation($array, $lastOccuranceStart = 0, $lastOccuranceEnd = 0)
    {
        $result = 0;
        $operator = '+';
        for($i=0; $i<count($array); $i++){
            if(isset($array[$i])) {
                $elm = $array[$i];
                if (preg_match('/^\d*$/i', $elm)) {
                    $secondArgument = $array[$i];
                    $result = $this->doBasicOperation($result , $operator, $secondArgument);
                } else if(preg_match('/[+*\/\-]/', $elm)){
                    $operator = $elm;
                }
            }
        }
        return $result;
    }
    
    public function doBasicOperation($operand1 , $operator, $operand2)
    {
        switch ($operator)
        {
           case '+'  : $result = $operand1 + $operand2;     break;
           case '-'  : $result = $operand1 - $operand2;     break;
           case '*'  : $result = $operand1 * $operand2;     break;
           case '/'  : $result = $operand1 / $operand2;     break;
           default   :  throw new Exception("Invalid Operator");
        }
        
        return $result;
    }
    
}
?>