<?php include_once WEBPATH . '/Apps/View/common/header.php'; ?>
    测试模板
    <input type="text" value="" name="abc" class="">
    <img src="<?php echo WEBROOT . '/test/validateimage' ?>">
    <script>
        ef.init();
        ef.eventbind('img', 'click', '', function () {
            $(this).attr('src', '<?php echo WEBROOT . '/test/validateimage' ?>');
        });
    </script>
<?php include_once WEBPATH . '/Apps/View/common/footer.php'; ?>