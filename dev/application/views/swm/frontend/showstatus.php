<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Member</title>
</head>

<body>
    
    <table  class="table table-bordered table-hover table-striped m-n" cellspacing="0" >
        <thead>
            <th>?????</th>
            <th>??????????</th>
            <th>???? - ???????</th>
            <th>????</th>
            <th>?????</th>
            <th>?????????</th>
        </thead>
        <tbody>
            <tr style="text-align: center;">
                <td>1</td>
                <td><?php echo $id[0]; ?></td>
                <td><?php echo $name[0]." ".$lname[0]; ?></td>
                <td><?php echo $age[0]; ?></td>
                <td style="background-color:yellow" >?????????</td>
                <td><span><input type="submit" value="??????????" class="btn btn-warning"></span></td>
            </tr>
            <tr style="text-align: center;">
                <td>2</td>
                <td><?php echo $id[1]; ?></td>
                <td><?php echo $name[1]." ".$lname[1]; ?></td>
                <td><?php echo $age[1]; ?></td>
                <td style="background-color:green" >??????</td>
                <td><span><input type="submit" value="??????????" class="btn btn-warning"></span></td>
                
            </tr>
            <tr style="text-align: center;">
                <td>3</td>
                <td><?php echo $id[2]; ?></td>
                <td><?php echo $name[2]." ".$lname[2]; ?></td>
                <td><?php echo $age[2]; ?></td>
                <td style="background-color:black ; color:white;">?????????</td>
                <td><span><input type="submit" value="??????????" class="btn btn-warning"></span></td>

            </tr>
            <tr style="text-align: center;">
                <td>4</td>
                <td><?php echo $id[3]; ?></td>
                <td><?php echo $name[3]." ".$lname[3]; ?></td>
                <td><?php echo $age[3]; ?></td>
                <td style="background-color:yellow" >?????????</td>
                <td><span><input type="submit" value="??????????" class="btn btn-warning"></span></td>
            </tr>

        </tbody>
    </table>
</body>
</html>