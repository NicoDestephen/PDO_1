<?php
require_once '_connect.php';

$pdo = new \PDO(DSN, USER, PASS);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']); 
    $lastname = trim($_POST['lastname']);
    if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && strlen($_POST["firstname"]) < 45 && strlen($_POST["lastname"]) < 45) {
        $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->execute();
        header('Location: index.php');
        die();
    }
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);


?>
<html>
    <body>
        <main>
            <ul>
                <?php 
                foreach($friendsArray as $friend) {
                ?>
                <li>
                    <?php 
                    echo $friend['firstname'] . ' ' . $friend['lastname'];}
                    ?>
                </li>
            </ul>

        <form action="index.php" method="POST" class=new_friend>
            <div class="firstname">
                <label for="firstname">Enter your firstname :</label>
                <input type="text" name="firstname" id="firstname" required/>
            </div>
            <div class="lastname">
                <label for="lastname">Enter your lastname :</label>
                <input type="text" name="lastname" id="lastname" required/>
            </div>
            <div class="submit">
                <input type="submit" value="Submit"/>
            </div>
        </form>    
        </main>
    </body>
</html>



