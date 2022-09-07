<?php
    $cnn = mysqli_connect("localhost","root", "" ,"employees")or die ("cant connect to database");
    if(isset($_REQUEST["btnsave"]))
    {
        $Name = $_REQUEST["txtname"];
        $Age = $_REQUEST["txtage"];
        $Emailid = $_REQUEST["txtemail"];
        $Password = $_REQUEST["txtpwd"];

        $strIns = "insert into tblemp values (null,'$Name','$Age','$Emailid','$Password')";
        mysqli_query($cnn,$strIns);
    }

    if(isset($_REQUEST["DelID"]))
    {
        $DID = $_REQUEST["DelID"];
        $strDel = "delete from tblemp where empid=$DID";
        mysqli_query($cnn,$strDel) or
        die(mysqli_error($cnn));
    }
    // update
    if(isset($_REQUEST["UpID"])){
        $strSel = "select * from tblemp where empid=".$_REQUEST["UpID"];
        $rsSel = mysqli_query($cnn,$strSel) or die(mysqli_error($cnn));
        $recSel = mysqli_fetch_array($rsSel);
    }
    if(isset($_REQUEST["btnupdate"]))
    {
        $Empid = $_REQUEST["UpID"];
        $Name = $_REQUEST["txtname"];
        $Age = $_REQUEST["txtage"];
        $Emailid = $_REQUEST["txtemail"];
        $Password = $_REQUEST["txtpwd"];
        

        $strUp = "update tblemp set ename='$Name',age='$Age',emailid='$Emailid',password='$Password' where empid='$Empid' ";
        mysqli_query($cnn,$strUp) or
        die(mysqli_error($cnn));
    }
?>
<html>
    <head>
        <style>
            table{
                border: 2px groove;
                margin-left:470px;
                margin-right:300px;
                padding-top:30px;
                padding-bottom:30px;
            }
            .btn {
                background-color: gray;
                color: rgb(255, 255, 255);
                padding-bottom: 6px;
                padding-top: 6px;
                padding-left: 20px;
                padding-right: 20px;
                border: 2px white;
            }
        </style>
    </head>
    <body>
        <form method="post">
            <table cellspacing="10" cellpadding="10" align="center" bgcolor="yellowgreen">
                <tr>
                    <td>Name :</td>
                    <td><input type="text" name="txtname" value="<?php if(isset($recSel)) echo $recSel["ename"];?>"></td>
                </tr>
                <tr>
                    <td>Age :</td>
                    <td><input type="text" name="txtage" value="<?php if(isset($recSel)) echo $recSel["age"];?>"></td>
                </tr>
                <tr>
                    <td>Emailid :</td>
                    <td><input type="email" name="txtemail" value="<?php if(isset($recSel)) echo $recSel["emailid"];?>"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="password" name="txtpwd" value="<?php if(isset($recSel)) echo $recSel["password"];?>"></td>
                </tr>
                <tr>
                    <td colspan=2 align="center">
                        <input type="submit" value="Insert" name="btnsave" class="btn">
                        <input type="submit" value="Update" name="btnupdate" class="btn">
                    </td>
                </tr>
                
            </table><br><br>
            <table border="2" align="center" bgcolor="orange">
                <tr>
                    <td>Search Value</td>
                    <td><input type="text" name="txtsearch"></td>
                </tr>

                <tr>
                    <td colspan=2 align="center">
                        <input type="submit" name="btnsearch" value="Go" class="btn">
                    </td>
                </tr>
            </table>
            <br>
            <table border='2' align="center" bgcolor="pink">
            <tr>
                <td>Emp Id</td>
                <td>Emp Name</td>
                <td>Age</td>
                <td>Email Id</td>
                <td>Password</td>
                <td>Delete</td>
                <td>Update</td>
            </tr>
            <?php
                $strEmp = "select * from tblemp";

                if(isset($_REQUEST["btnsearch"]))
                {
                    $val=$_REQUEST["txtsearch"];
                    $strEmp = "select * from tblemp where ename like '%$val%' ";
                }
                $rs = mysqli_query($cnn,$strEmp);
                while($rec = mysqli_fetch_array($rs))
                {
            ?>
            <tr>
            <td><?php echo $rec["empid"]; ?></td>
                <td><?php echo $rec["ename"]; ?></td>
                <td><?php echo $rec["age"]; ?></td>
                <td><?php echo $rec["emailid"]; ?></td>
                <td><?php echo $rec["password"]; ?></td>

                <td><a href="?DelID=<?php echo $rec["empid"];?>" class="link">Delete</a></td>
                <td><a href="?UpID=<?php echo $rec["empid"];?>" class="link">Update</a></td>
            </tr>
            <?php
                }
            ?>
            </table>
        </form>
    </body>
</html>