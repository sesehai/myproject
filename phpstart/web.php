<form action="web.php?act=show" method="POST">
    Name:  <input type="text" name="username"><br />
    Email: <input type="text" name="email"><br />
    <input type="submit" name="submit" value="Submit me!" />
</form>

<?php
echo "act:".$_GET['act'],",<br>";
echo "username:".$_POST['username'],",<br>";
echo "email:".$_POST['email'],",<br>";
?>

