<?php 
error_reporting(0);
require_once('Calculator.class.php');
class CalculatorController{
    
   private $db;
   private $template;
   private $params;
   private $cmdList;

   public function __construct($params)
   {
      $this->db       = $params['db_link'];
      $this->cmdList  = $params['cmdList'];
   }

   public function run()
   {
      $cmd = $this->cmdList[1];

      switch ($cmd)
      {
         case 'list'  : $screen = $this->calculatorList();     break;
         case 'calculate_expression'  : $screen = $this->calculateExpression();     break;
         case 'cal_expression_app'  : $screen = $this->calculateExpressionApp();     break;
         default      : $screen = $this->calculatorList();
      }

      exit;
   }
   
   public function calculatorList($msg=null)
   {
        require_once LIST_TEMPLATE;
        exit;
   }
   
   public function calculateExpression()
   {
        $expression = trim($_POST['expression']);
       
        if(empty($expression)) {
            $error = 'Expression can not be null';
            require_once LIST_TEMPLATE;
            exit();
        }
        
        try {
            $CalculatorObj = new Calculator($expression);
            $result = $CalculatorObj->evaluteExpression();
        } catch(Exception $e){
            $error = $e->getMessage();
        }
        
        require_once LIST_TEMPLATE;
        exit();
   }
   
   public function calculateExpressionApp(){
        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);

        $expression = trim($_POST['expression']);

        $returnObj = array();
        $returnObj['success'] = true;
        try {
            $CalculatorObj = new Calculator($expression);
            $returnObj['result'] = $CalculatorObj->evaluteExpression();
        } catch(Exception $e){
            $returnObj['errorMessage'] = $e->getMessage();
            $returnObj['success'] = false;
        }
        ob_end_clean();
        echo json_encode_recursive($returnObj);
        exit();
   }
}

?>