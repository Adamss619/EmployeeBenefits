<?php 


class benefits {
    
    private $baseEmployeeCost = 1000;
    private $baseDependentCost = 500;
    private $baseDiscount = .90;
    private $basePayCheck = 2000;
    private $basePayPeriods = 26;
    
    private $payTotalCost;
    private $dependentsList;
    private $name;
    
    
  public function __construct($name, array $dependentsList){
        $this->name = $name;
        $this->dependentsList = $dependentsList;
    }
    
    /**
    *Calculates dependents total cost for benefits
    */
    public function calculateDependentCost(){
        $cost = 0; 
        for ($i = 0; $i < sizeof($this->dependentsList); $i++) {
            if($this->checkFirstLetter($this->dependentsList[$i])){ //if first letter is A use discount rate
                //echo 'discount';
                $cost += ($this->baseDependentCost * $this->baseDiscount);
            }else{
                $cost += ($this->baseDependentCost); //first letter not A
            }
        }
        $this->addCost($cost); //Add to total cost
    }
    
    /**
    *Calculates employee cost for benefits
    */
    public function calculateEmployeeCost(){
        $cost = 0;
        if($this->checkFirstLetter($this->name)){
            $cost = ($this->baseEmployeeCost * $this->baseDiscount); //check first name A
        }else{
            $cost = $this->baseEmployeeCost;    
        }
        $this->addCost($cost);
    }
    
    /**
    *@return the total cost per pay period for the employee's benefits plan
    */
    public function getPayPerPeriod(){
        $totalCost = $this->payTotalCost; //var to make it easier to read
        $periodCost = $totalCost/$this->basePayPeriods; 
        return ($periodCost);
    }
    
    /**
    *helper function for keeping track of cost
    */
    private function addCost($cost){
        $this->payTotalCost += $cost;
    }
    
    /**
    *checks the first letter of name
    *
    *@param String name to check
    *@return if name's first letter is an A
    */
    private function checkFirstLetter($name){
        $FirstLetter = substr($name,0,1);
        if($FirstLetter == "A"){
            return true;    
        }else{
            return false;
        }
        
    }
    
}
    
?>