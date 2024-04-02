<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="content">Content</label>
            <textarea name="content" required></textarea>
        </div>



        <button type="submit">Submit</button>
    </form>

    <?php
        $logFile = file_get_contents('log.json');
        $data = json_decode($logFile, true);
        if(isset($_POST['name'])&& isset($_POST['content'])){


            $todayDate = date('Y-m-d H:i:s');
            $newData = [
                'name' => $_POST['name'],
                'content' => $_POST['content'],
                'post_date' => $todayDate,
            ];
            $data[] = $newData;

            file_put_contents('log.json', json_encode($data,JSON_PRETTY_PRINT));

        }
    ?>
    <?php if(isset($data)): ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Content</th>
                <th>Post Date</th>
            </tr>

            <?php
                foreach($data as $log):
            ?>
            <tr>
                <td><?=$log['name']?></td>
                <td><?=$log['content']?></td>
                <td><?=$log['post_date']?></td>
            </tr>
            <?php endforeach;?>
        </table>

    <?php endif; ?>
</body>
</html>