<?php 
    // Database connection
    try{
     $connection = new PDO('mysql:host=46.32.240.43;dbname=u1476-h4w-u-199454', 'u1476-h4w-u-199454', 'Bongletree3?');
    }
    catch (PDOException $exception) 
    {
        echo "Oh no, there was a problem. Error: " . " " . $exception->getMessage();
    }
    // Table outputs
    
    // -------------------------------------------------------------------------------------------
    // monster

    // Select query
    $allMonstersQuery = "SELECT * FROM monster";
    $monsterResultset = $connection->query($allMonstersQuery);
    
    // output
    $monsterOutput = "<table>
        <thead>
            <tr>
                <td>monster_id</td>
                <td>name</td>
                <td>level</td>
                <td>image</td>
                <td>attack</td>
                <td>defence</td>
                <td>card_text</td>
                <td>fk_attribute_id</td>
                <td>fk_monster_type_id</td>
            </tr>
        </thead>
        <tbody>";
    while ($monster = $monsterResultset->fetch()) {
        $monsterOutput .= "<tr>"."<td>".$monster["monster_id"]."</td>".
            "<td>".$monster["name"]."</td>".
            "<td>".$monster["level"]."</td>".
            "<td>".$monster["image"]."</td>".
            "<td>".$monster["attack"]."</td>".
            "<td>".$monster["defence"]."</td>".
            "<td>".$monster["card_text"]."</td>".
            "<td>".$monster["fk_attribute_id"]."</td>".
            "<td>".$monster["fk_monster_type_id"]."</td>".
            "<td>"."</tr>";
    }
    $monsterOutput .= "</table";
    
    // -------------------------------------------------------------------------------------------
    // attribute

    // Select query
    $allAttributeQuery = "SELECT * FROM attribute";
    $attributeResultset = $connection->query($allAttributeQuery);
    
    // output
    $attributeOutput = "<table>
        <thead>
            <tr>
                <td>attribute_id</td>
                <td>attribute_name</td>
            </tr>
        </thead>
        <tbody>";
    while ($attribute = $attributeResultset->fetch()) {
        $attributeOutput .= "<tr>"."<td>".$attribute["attribute_id"]."</td>".
            "<td>".$attribute["attribute_name"]."</td>".
            "<td>"."</tr>";
    }
    $attributeOutput .= "</table";

    // -------------------------------------------------------------------------------------------
    // monster_type

    // Select query
    $allMonsterTypeQuery = "SELECT * FROM monster_type";
    $monsterTypeResultset = $connection->query($allMonsterTypeQuery);
    
    // output
    $monsterTypeOutput = "<table>
        <thead>
            <tr>
                <td>monster_type_id</td>
                <td>monster_type_name</td>
            </tr>
        </thead>
        <tbody>";
    while ($monsterType = $monsterTypeResultset->fetch()) {
        $monsterTypeOutput .= "<tr>"."<td>".$monsterType["monster_type_id"]."</td>".
            "<td>".$monsterType["monster_type_name"]."</td>".
            "<td>"."</tr>";
    }
    $monsterTypeOutput .= "</table";
    
    // -------------------------------------------------------------------------------------------
    // card_type

    // Select query
    $allCardTypeQuery = "SELECT * FROM card_type";
    $cardTypeResultset = $connection->query($allCardTypeQuery);
    
    // output
    $cardTypeOutput = "<table>
        <thead>
            <tr>
                <td>card_type_id</td>
                <td>card_type_name</td>
            </tr>
        </thead>
        <tbody>";
    while ($cardType = $cardTypeResultset->fetch()) {
        $cardTypeOutput .= "<tr>"."<td>".$cardType["card_type_id"]."</td>".
            "<td>".$cardType["card_type_name"]."</td>".
            "<td>"."</tr>";
    }
    $cardTypeOutput .= "</table";

    // -------------------------------------------------------------------------------------------
    // monster_junction_card_type
    // Select query
    $allmonster_junction_card_typeQuery = "SELECT * FROM monster_junction_card_type";
    $monsterJunctionCardTypeResultset = $connection->query($allmonster_junction_card_typeQuery);
    
    // output
    $monsterJunctionCardTypeOutput = "<table>
        <thead>
            <tr>
                <td>monster_id</td>
                <td>card_type_id</td>
            </tr>
        </thead>
        <tbody>";
    while ($monsterJunctionCardType = $monsterJunctionCardTypeResultset->fetch()) {
        $monsterJunctionCardTypeOutput .= "<tr>"."<td>".$monsterJunctionCardType["monster_id"]."</td>".
            "<td>".$monsterJunctionCardType["card_type_id"]."</td>".
            "<td>"."</tr>";
    }
    $monsterJunctionCardTypeOutput .= "</table";
    // pendulum
    $allPendulumQuery = "SELECT * FROM pendulum";
    $pendulumResultset = $connection->query($allPendulumQuery);
    
    // output
    $pendulumOutput = "<table>
        <thead>
            <tr>
                <td>pendulum_id</td>
                <td>pendulum_scale</td>
                <td>pendulum_effect</td>
                <td>fk_monster_id</td>
            </tr>
        </thead>
        <tbody>";
    while ($pendulum = $pendulumResultset->fetch()) {
        $pendulumOutput .= "<tr>"."<td>".$pendulum["pendulum_id"]."</td>".
            "<td>".$pendulum["pendulum_scale"]."</td>".
            "<td>".$pendulum["pendulum_effect"]."</td>".
            "<td>".$pendulum["fk_monster_id"]."</td>".
            "<td>"."</tr>";
    }
    $pendulumOutput .= "</table";

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Yugioh Cards - Database Design</title>
        <link rel="stylesheet" type="text/css" href="css/skeleton.css">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <header>
                <nav>
                    <a href="index.php">Yugioh Card Search</a>
                    <a href="design.php">Database Design</a>
                </nav>
            </header>
        </div>
        <div class="container">
            <div class="row">
                <div class="twelve columns">
                    <section class="diagram">
                        <h2>Class Diagram</h2>
                        <img src="images/class-diagram.PNG">
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="twelve columns">
                    <section class="diagram">
                        <h2>Physical Data Model</h2>
                        <img src="images/physical-data-model.PNG">
                    </section>
                </div>
            </div>
            
            <section class="table-data">
                <h2>monster</h2>
                <?php echo $monsterOutput; ?>
            </section>
            <section class="table-data">
                <h2>attribute</h2>
                <?php echo $attributeOutput; ?>
            </section>
            <section class="table-data">
                <h2>monster_type</h2>
                <?php echo $monsterTypeOutput; ?>
            </section>
            <section class="table-data">
                <h2>card_type</h2>
                <?php echo $cardTypeOutput; ?>
            </section>
            <section>
                <h2>monster_junction_card_type</h2>
                <?php  echo $monsterJunctionCardTypeOutput; ?>
            </section>
            <section>
                <h2>pendulum</h2>
                <?php  echo $pendulumOutput; ?>
            </section>
        </div>
        <?php 

        // Output database tables
        
        // monster
        
        // attribute
        
        // monster_type
        
        // card_type
        
        // monster_junction_card_type
        
        // pendulum

        ?>
    </body>
</html>