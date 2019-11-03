<?php 
 require_once('benefits.php');
    if(isset($_GET['ename'])){
        $ename = $_GET['ename']; //set name
    }

    if(isset($_GET['dependentsnumber'])){
        $dependentsnumber = $_GET['dependentsnumber']; //set dependent number
    }

    $dependentArray = [];
    for ($i=0; $i<$dependentsnumber; $i++)
        { 
            $dependentArray[$i] = $_GET['dname'.$i]; //                     
        }
    $show = false; //if calculations are avaliable will change to true
if(isset($_GET['Calculate'])){
    $benefits = new benefits($ename,$dependentArray);
    $benefits->calculateDependentCost();
    $benefits->calculateEmployeeCost();
    $value = $benefits->getPayPerPeriod();
    $show = true;
    unset($_GET['Calculate']);
}
 ?>
<html>

<head>
    <link href="styles.css" type="text/css" rel="stylesheet" />
    <h1>Employee Benefits Calculator</h1>
</head>

<body>
    <div>
        <div class="container">
            <h3 class="information">Employee Name:</h3>
            <h3 class="information">Number of Dependents:</h3>
        </div>
        <form method="GET" action="index.php">
            <div>
                <input id="employee" type="text" placeholder="Employee Name" name="ename" value="<?php echo $ename ;?>" required>
                <select name="dependentsnumber" id="numberlist">
                    <?php
                        for ($i=0; $i<=100; $i++)
                        {
                            if($i == $dependentsnumber){
                                echo '<option selected="selected">' . $dependentsnumber . '</option>';
                            }else{

                                echo '<option value="'. $i .'">'. $i .'</option>';
                            }
                        }
                    ?>
                </select>
                <input name="Add" type="submit" value="Add">
                <?php
                    if($dependentsnumber>0){
                        echo '<h3>Dependent List:</h3>';
                    }
                        for ($i=0; $i<$dependentsnumber; $i++)
                        { $dname = 'dname'.$i;

                    echo '<input type="text" placeholder="Dependent Name" name="'. 'dname'.$i .'" value="'. $_GET[$dname].'">';

                        }
                    ?>

            </div>
            <input name="Calculate" type="submit" value="Calculate">
        </form>
    </div>
    <div id="cost">
        <?php
           if($show == true){
            echo '<h3>Cost Per Pay Period:</h3>';
            echo '$'.money_format('%(#10n', $value) ."\n";   
           }
        ?>
    </div>
</body>

</html>