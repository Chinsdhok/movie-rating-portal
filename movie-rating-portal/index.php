<!DOCTYPE html>
<html lang="en">
<head>
    <title>Movie Review Website</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="sec1">
    <div class="sec1-1">
        <h1>Welcome to Movie Review Portal</h1>
        <h3>Submit your review!!</h3>
        <form method="post" action="index.php#sec2">
            <select name="movie">
                <option value="3 Idiots">3 Idiots</option>
                <option value="Aquaman">Aquaman</option>
                <option value="Avengers Endgame">Avengers Endgame</option>
                <option value="Batman Vs Superman">Batman Vs Superman</option>
                <option value="Commando 3">Commando 3</option>
                <option value="Dolittle">Dolittle</option>
                <option value="Iron Man">Iron Man</option>
                <option value="Johnny English">Johnny English</option>
                <option value="Pirates of the Caribbean">Pirates of the Caribbean</option>
                <option value="Thor">Thor</option>
            </select><br>
            <select name="rating">
                <option value="1">1 Star</option>
                <option value="2">2 Star</option>
                <option value="3">3 Star</option>
                <option value="4">4 Star</option>
                <option value="5">5 Star</option>
            </select><br>
            <input type="submit" value="Submit" name="submit">
        </form>
        <?php
        if(isset($_POST['submit'])){

            $movie = $_POST['movie'];
            $rating = $_POST['rating'];
            $avg = 0;

            $conn = new mysqli('localhost','root','','project');

            if($conn->connect_error){
                die("Connection Failed".$conn->connect_error);
            }
            else{

                $sql = "SELECT * FROM movies WHERE name='$movie'";
                $result = mysqli_query($conn, $sql);
                while($data = mysqli_fetch_array($result)){

                    $avg = ($data['rating'] + $rating) / 2;
                }

                $sql1 = "UPDATE movies SET rating = '$avg' WHERE name = '$movie';";

                if($conn->query($sql1)){
                    echo "<p>Data Updated</p>";
                }

                $conn->close();
            }
        }
        ?>
    </div>

</div>

<div class="sec2" id="sec2">
    <div class="sec2-1">
        <?php
        $conn = new mysqli('localhost','root','','project');

        if($conn->connect_error){
            die("Connection Error". $conn->connect_error);
        }
        else{
            $sql = "SELECT * FROM movies";
            $result = mysqli_query($conn, $sql);
            while($data = mysqli_fetch_array($result)){

                echo '<div class="card">';
                echo '<img src="img/',$data['image'],'">';
                echo '<h3>',$data['name'],'</h3>';
                echo '<h3>Rating: ',$data['rating'],' Stars</h3>';
                echo '</div>';
            }
            $conn->close();
        }
        ?>
    </div>
</div>

</body>
</html>
