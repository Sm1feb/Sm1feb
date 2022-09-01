<?php
$connect=mysqli_connect("localhost","root","","sm") or die("connection failed");
if(!empty($_REQUEST['Save']))
{
    $getname=$_REQUEST['name'];
    $getclass=$_REQUEST['class'];
    $getmarks=$_REQUEST['m'];
    $getmarks2=$_REQUEST['marks2'];
    $getmarks3=$_REQUEST['marks3'];

    if(!empty($_REQUEST['editID']))
    {
        $ID=$_REQUEST['editID'];
        $query="update smr set name='$getname',class='$getclass', marks='$getmarks',marks2='$getmarks2',marks3='$getmarks3' where ID=$ID";
    }
    else{
    $query="insert into smr(name,class,marks,marks2,marks3)values('$getname','$getclass',$getmarks,$getmarks2,$getmarks3)";
    }
    if(mysqli_query($connect,$query))
    {
    echo "Record Inserted";
    }
    else
    {
   echo "Record not inserted";
    }
}
if(!empty($_GET['did']))
{
    $id=$_GET['did'];
    $query="delete from smr where id=$id";
    if(mysqli_query($connect,$query))
    {
        echo "Record deleted";
    }
    else{
        echo "record not deleted";
    }
}
if(!empty($_GET['eid']))
{
    $id=$_GET['eid'];
    $query="select * from smr where ID=$id";
    $result=mysqli_query($connect,$query);
    $ro=mysqli_fetch_assoc($result);
}
?>
<html>
    <head>
</head>
<body>
    <form>
    Enter ID <input type="text" name="editID" value="<?php if(!empty($ro['ID'])) echo $ro['ID']?>"><br><br/>
        Enter name <input type="text" value="<?php if(!empty($ro['name'])) echo $ro['name']?>" name="name"><br><br>
        Enter class <input type="text" value="<?php if(!empty($ro['class'])) echo $ro['class']?>" name="class"><br><br>
        Enter marks <input type="text" value="<?php if(!empty($ro['marks'])) echo $ro['marks']?>"name="m"><br><br>
        Enter marks2 <input type="text" value="<?php if(!empty($ro['marks2'])) echo $ro['marks2']?>"name="marks2"><br><br>
        Enter marks3 <input type="text" value="<?php if(!empty($ro['marks3'])) echo $ro['marks3']?>"name="marks3"><br><br>
        <input type="submit" name="Save" value="submit">
        <input type="reset" name="delete" value="cancel">
    </form>
    <table border="1" width=80%>
        <tr>
            <th> ID </th>
            <th> Name</th>
            <th>Class</th>
            <th>Marks</th>
            <th>Marks2</th>
            <th> Marks3</th>
            <th> Delete</th>
            <th> edit </th>
</tr>
<?php
if(!empty ($_REQUEST['s']))
{   
   $searchname=$_GET['s'];  
   $query= "select * from smr where name like '%$searchname%'";  
}
 else if(!empty ($_REQUEST['class']))
{   
   $searchclass=$_GET['class'];   
   $query= "select * from smr where class like '%$searchclass%'";  
}
else
{
    $query="select * from smr ";
}
$result=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($result))
     {
?>
    <tr>
        <td><?php echo $row['ID']?></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['class']?></td>
        <td><?php echo $row['marks']?></td>
        <td><?php echo $row['marks2']?></td>
        <td><?php echo $row['marks3']?></td>
        <td><a href="assignment2.php?did=<?php echo $row['ID'] ?>">Delete</a></td>
        <td><a href="assignment2.php?eid=<?php echo $row['ID'] ?>">Edit</a></td>
        <?php   
}
?>
</tr>
</table>
<br>
<form method="get">
Enter Name <input type="text" name="s"> <br/><br/>
Enter Class <input type="text" name="class"><br><br>
 <input type ="submit" value="search...">
</form>
</body>
</html>