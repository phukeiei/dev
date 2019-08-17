<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

</head>

<body>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


    <div class="col-md-12">
        <div class="panel panel-green" data-widget='{"draggable": "false"}'>
            <div class="panel-heading">
                <h2>
                    <center>????????????????????</center>
                </h2>
                <form method="POST" action="./index">
                    <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body, .panel-footer"}'></div>
            </div>
            <div class="panel-body" style="height: 148px">
                <div class="form-group">
                    <label class="col-sm-2 control-label">????????????</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="id">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">???????????</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="rg_date">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">????????????</label>
                    <div class="col-sm-2">
                        <select class="form-control">
                            <optgroup label="????????????">
                                <option value="AK">???</option>
                                <option value="AK">???</option>
                                <option value="AK">??????</option>
                                <option value="HI">???????</option>
                                <option value="AK">????????</option>
                            </optgroup>
                        </select>
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">????</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="fname">
                    </div>
                </div> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">???????</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="lname">
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">???????</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="birthday">
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">????</label>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" name="age">
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">?????</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="job">
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">?????????????</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="tel">
                    </div>
                </div><br>
                <p style=" border-bottom: 1px solid black ">
                    <center>?????????????</center>
                </p>
                <p style=" border-bottom: 1px solid black "></p>
                <div class="form-group">
                    <label class="col-sm-2 control-label">???????????????</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="address" placeholder="123/456">
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">????</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="tambon" placeholder="??????">
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">?????</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="aumpor" placeholder="?????">
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">???????</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="province" placeholder="???????????">
                    </div>
                </div><br>

                <p style=" border-bottom: 1px solid black ">
                    <center>?????????????????????????????</center>
                </p>
                <p style=" border-bottom: 1px solid black "></p>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">????</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="dfname">
                    </div>
                </div> <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">???????</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="dlname">
                    </div>
                </div><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">?????????????</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="dtel">
                    </div>
                </div><br>
                <input style="margin-left:1125px;" type="submit" value="??????" class="btn btn-success">



            </div>

            <div class="panel-footer" style="background-color: white">

            </div>
            </form>
        </div>
    </div>

</body>

</html>