<?php
    $errors ="";

    $database = new PDO('mysql:host=localhost;dbname=todolist;','root','12345'); 

    if(isset($_POST['submit'])){
        $task = $_POST['task'];
        if(empty($task)){
            $errors = "Campo vazio.";
        }else{
            $database->query("INSERT INTO todo (task) VALUES ('$task')");
        }
    }

    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        $database->query("DELETE FROM todo WHERE id='$id'");
    }
    
    $sql = 'SELECT * FROM todo';
    $sth = $database->prepare($sql);
    $sth->execute();
    $tasks = $sth->fetchAll(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>To do List</title>
</head>
<body>
    <header>
    </header>
    <section>
        <h1>To do List</h1>
        <form method="POST" action="index.php">
            <input type="text" placeholder="Digite aqui..." name="task" class="task_input">
            <button type="submit" name="submit" class="task_btn">Add</button>
            <p><?php echo $errors; ?></p>
        </form>

        <table>
            <thead>
                <tr>
                    <th>nº</th>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $key=>$task): ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td class="task"><?php echo $task['task']; ?></td>
                        <td class="delete"><a href="index.php?del_task=<?php echo $task['id']; ?>" onclick="return confirm('Você realmente concluiu essa tarefa?')">x</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
    <footer>
        Desenvolvidor por <a href="https://github.com/bnagano">@bnagano.</a>
    </footer>
</body>
</html>