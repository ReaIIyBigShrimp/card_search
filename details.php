<?php 

    //checks to see if there is an id in the query string
    if(!isset($_GET['id']))
    {
        echo "You shouldn't have got to this page";
        exit;
    }
    // Database connection
    try{
     $connection = new PDO('mysql:host=46.32.240.43;dbname=u1476-h4w-u-199454', 'u1476-h4w-u-199454', 'Bongletree3?');
    }
    catch (PDOException $exception) 
    {
        echo "Oh no, there was a problem" . $exception->getMessage();
    }

    $monsterId=$_GET['id'];
    
    // echo $monsterId;
    // Test
    $stmt = $connection->prepare("SELECT * FROM monster WHERE monster.monster_id = :monster_id");

    // Card Details query 
    $stmt1 = $connection->prepare("
        SELECT * FROM monster
        INNER JOIN attribute ON attribute.attribute_id = monster.fk_attribute_id
        INNER JOIN monster_type ON monster_type.monster_type_id = monster.fk_monster_type_id
        LEFT JOIN pendulum ON monster.monster_id = pendulum.fk_monster_id
        WHERE monster.monster_id = :monster_id;
    ");
    // Bind
    // Test
    $stmt->bindValue(':monster_id', $monsterId);
    $stmt->execute();

    $stmt1->bindValue('monster_id', $monsterId);
    $stmt1->execute();
    
    
    
    $connection = NULL;

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Search results</title>
        <link rel="stylesheet" type="text/css" href="css/skeleton.css">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="twelve columns">
                    <header>
                        <nav>
                            <a href="index.php">Yugioh Card Search</a>
                            <a href="design.php">Database Design</a>
                        </nav>
                    </header>
                </div>
            </div>
            <div class="row">
                <div class="twelve columns details">
                    <h2>Card Details</h2>
                    <?php 
                        //Display film details
                        if($monster=$stmt1->fetch()){
                            $details = "";
                            $details .= "<img src='images/card-images/".$monster['image']."'>";
                            $details .= "<h1>"."Card name: ".$monster['name']."</h1>";
                            $details .= "<p>"."Level: ".$monster['level']."</p>";
                            $details .= "<p>"."Attack: ".$monster['attack']."</p>";
                            $details .= "<p>"."Defence: ".$monster['defence']."</p>";
                            $details .= "<p>"."Card text: ".$monster['card_text']."</p>";
                            $details .= "<p>"."Attribute: ".$monster['attribute_name']."</p>";
                            $details .= "<p>"."Monster Type: ".$monster['monster_type_name']."</p>";
                            // Display Pendulum details, if relevant.
                            if(isset($monster['pendulum_id'])){
                                $details .= "<p>"."Pendulum Scale: ".$monster['pendulum_scale']."</p>";
                                $details .= "<p>"."Pendulum Effect: ".$monster['pendulum_effect']."</p>";
                            };
                            echo $details;
                        }
                        else
                        {
                            echo "<p>Can't find any card details.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
        
        
    </body>
</html>