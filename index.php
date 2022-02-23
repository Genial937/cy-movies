<?php
include 'connect.php';
include 'db/data.php';

//read from json
function show_contents()
{
    try {
        $data =  json_decode(read_json(), true);
        foreach ($data as $value) {
            save_contents($value);
        }
    } catch (\Throwable $th) {
        return 'Error: ' . $th;
    }
}

//save content
function save_contents($data)
{
    global $con;
    $movie_id = $data['movieID'];
    $title = $data['title'];
    $genre = $data['genre'];
    //check genre
    //check if exist
    $check = $con->query("SELECT FROM data films WHERE `movie_id` = '$movie_id'");
    if (!$check) {
        $con->query("INSERT INTO `films`(`movie_id`, `title`, `genre`) VALUES ('$movie_id','$title','$genre')");
    }
}

show_contents();
//fetch content
$data = $con->query("SELECT * FROM films GROUP BY films.genre");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Movie List</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Movie ID</th>
                        <th>Title</th>
                        <th>Genre</th>
                    </thead>
                    <tbody>
                        <?php while ($mydata = mysqli_fetch_assoc($data)) : ?>
                            <tr>
                                <td><?= $mydata['movie_id']; ?></td>
                                <td><?= $mydata['title']; ?></td>
                                <td><?= $mydata['genre']; ?></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>