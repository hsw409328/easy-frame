<html>
<head>
    <title>view</title>
</head>
<body>
测试传值
<?php
foreach ($res as $k => $v) {
    ?>

    <h3><?php echo $v['actionid']; ?></h3>

    <?php
}
?>
</body>
</html>