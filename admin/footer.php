<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/layer/layer.js"></script>
<script src="../assets/js/ozui.min.js"></script>
    <?php $path = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
    if(strpos($path, 'post.php?act=') || strpos($path, 'page.php?act=')) {
        ?>
      <script src="./style/tinymce/tinymce.min.js"></script>
      <script src="./style/js/tinymceConfig.js"></script>
        <?php
    }
?>
<script src="./style/js/ajax.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
</body>
</html>