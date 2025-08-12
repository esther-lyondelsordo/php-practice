<!DOCTYPE html>
<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php echo '<p>Hello World</p>'; ?>
        <?php require 'noFileExists.php';
        echo "I have a $color $car.";
        ?>
        <?php phpinfo(); ?>
        <?php include 'footer.php';?>
    </body>
</html>
