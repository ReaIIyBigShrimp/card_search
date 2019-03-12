<?php 
    // Database connection
    try{
     $connection = new PDO('mysql:host=46.32.240.43;dbname=u1476-h4w-u-199454', 'u1476-h4w-u-199454', 'Bongletree3?');
    }
    catch (PDOException $exception) 
    {
        echo "Oh no, there was a problem. Error: " . $exception->getMessage();
    }
    
    // Avoid errors
    $search_term = "";
    $msg = "";
    $monster_type_option = "";
    // Check if form has been submitted
    if (isset($_GET["submitBtn"])) {
        $search_term=$_GET["search"];
        // Check for an answer being present
        $monster_type_option = $_GET['monster_type'];
        if($search_term===""){
            $msg = "No search term has been entered.";
        }
        
    }

    // Monster type form list
    $monsterTypeQuery = "SELECT * FROM `monster_type`";
    $monsterTypeResultset = $connection->query($monsterTypeQuery);
    
    $monsterTypeOutputList = "";
    $monsterTypeOutputList .='<select id="monster_type" name="monster_type">';
    $monsterTypeOutputList .= '<option value="any">Any</option>';
    while ($row = $monsterTypeResultset->fetch()) {
        if ($monster_type_option === $row['monster_type_id']) {
            $monsterTypeOutputList .= '<option value="'.$row['monster_type_id'].'"'.'selected'.'>'.$row['monster_type_name'].'</option>';
        } else {
            $monsterTypeOutputList .= '<option value="'.$row['monster_type_id'].'">'.$row['monster_type_name'].'</option>';
        }
       
        
    }

    $monsterTypeOutputList .= '</select>';
    //=============================================================================================

    // echo $_GET["search"];
    // echo $_GET["monster_type"];
    
    // Search string
    //$search_term = $_GET["search"];
    // Monster type dropdown
    //$monster_type = $_GET["monster_type"];
    // 
    $monster_type_id = "any";
    if (isset($_GET['submitBtn'])) {
        $monster_type_id = $_GET['monster_type'];
    };

    //query for search
    $query = "";
    if ($monster_type_id != "any") {
        $query = "SELECT * FROM monster WHERE monster.name LIKE :search_term AND monster.fk_monster_type_id = :monster_type_id";
        $prep_stmt = $connection->prepare($query);
        $prep_stmt -> bindValue(':monster_type_id', $monster_type_id);
    } else {
        $query = "SELECT * FROM monster WHERE monster.name LIKE :search_term";
        $prep_stmt = $connection->prepare($query);
    }
    
    $prep_stmt -> bindValue(':search_term', '%'.$search_term.'%');
    
    
    $prep_stmt -> execute();
    
    
    // $resultset = $connection->query($query);
    
    //Search feedback
    $search_feedback = function() {
        if (isset($_GET["submitBtn"])) {
            $search_term = $_GET["search"];
        } else {
            $search_term = "";
        }
        $feedback = "";
        if ($search_term === "") {
            $feedback = "<p>"."No search was entered."."</p>";
        } else {
            $feedback = "<p>"."Entered search: ".$search_term."</p>";
        }
        return $feedback;
    };
    
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Search results</title>
        <link rel="shortcut icon" href="card.ico" />
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
            <!-- Search Form-->
            <div class="row">
                <div class="twelve columns form-div">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" class="card-search-form">
                        <label for="search">Enter a search term:</label>
                        <input type="text" name="search" id="search" value="<?php echo $search_term?>">

                        <label for="monster_type">Monster Type</label>
                        <?php echo $monsterTypeOutputList; ?>
                        <input type="submit" id="submitBtn" name="submitBtn" value="Search">
                    </form>
                </div>
            </div>
            <!-- Results -->
            <div class="row">
                <div class="twelve columns search-results">
                    <h2>Search Results</h2>
                    <?php 
                        $total_results_query = "";
                        if ($monster_type_id != "any") {
                            $total_results_query = "SELECT COUNT(*) AS 'Number of results' FROM monster WHERE monster.name LIKE :search_term AND monster.fk_monster_type_id = :monster_type_id";
                            $prepare_total_results = $connection->prepare($total_results_query);
                            $prepare_total_results->bindValue(":search_term", "%".$search_term."%");
                            $prepare_total_results->bindValue(":monster_type_id", $monster_type_id);
                            
                        } else {
                            $total_results_query = "SELECT COUNT(*) AS 'Number of results' FROM monster WHERE monster.name LIKE :search_term";
                            $prepare_total_results = $connection->prepare($total_results_query);
                            $prepare_total_results->bindValue(":search_term", "%".$search_term."%");
                        }
                        
                        
                        $prepare_total_results->execute();
                        while ($totalResult = $prepare_total_results->fetch()) {
                            echo "<p>"."Number of results: ".$totalResult['Number of results']."</p>";
                        }
                        
                    
                        echo $search_feedback();
                        while ($monster = $prep_stmt->fetch()) {
                            $result = "";
                            //$result .= "<p>";
                            $result .= "<a href='details.php?id=".$monster["monster_id"]."'>";
                            $result .="<img src='"."images/card-images/".$monster["image"]."'>";
                            $result .= "<p>".$monster["name"]."</p>";
                            $result .= "</a>";
                            //$result .= "</p>";
                            echo $result;
                        } 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>