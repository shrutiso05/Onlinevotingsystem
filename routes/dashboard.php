<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }
    
    $userdata = $_SESSION['userdata']; 
    $groupsdata= $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">No Voted</b>';
    }
    else{
        $status = '<b style="color:green"> Voted</b>';
    }
?>

<html>
    <head>
        <title> Online Voting System - Dashboard</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>
  
    <body>
        <div id="mainSection">
            <center>
            <div id="headerSection">
                <button id="backbtn"><a href="../">Back</button></a>
                <button id="logoutbtn"> <a href="logout.php">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
            </center>
            <hr>

            <div id="mainpanel">

                    <div id="Profile"><center><img src="../uploads/<?php echo $userdata['photo'] ?>" height = "100" width ="100"></center><br><br>
                        <b>Name: </b><?php echo $userdata['name']?><br><br>
                        <b>Mobile: </b><?php echo $userdata['mobile']?><br><br>
                        <b>Address: </b><?php echo $userdata['address']?><br><br>
                        <b>Status: </b><?php echo $status ?> <br><br>
                    </div>
                    <div id="Group">
                        <?php 
                            if($_SESSION['groupsdata']){
                                for($i=0; $i<count($groupsdata); $i++){
                                    ?>
                                    <div>
                                        <img style = "float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height ="100" width="100">
                                        <b>Group Name: </b><?php echo $groupsdata[$i]['name']?><br><br>
                                        <b>Group Votes: </b><?php echo $groupsdata[$i]['votes']?><br><br>
                                        <form action="../api/vote.php" method="POST">
                                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                            <?php 
                                                if($_SESSION['userdata']['status']==0){
                                                    ?>
                                                <input type="submit" name="votebtn" value="vote" id="votebtn">
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <button disabled type="button" name="votebtn" value="vote" id='voted'>Voted</button>
                                                        <?php
                                                }
                                            ?>
                                        </form>
                                    </div>

                                    <?php
                                }
                            }
                            else{

                            }
                         ?>
                    </div>
            </div>
        </div>
    </body>
</html>