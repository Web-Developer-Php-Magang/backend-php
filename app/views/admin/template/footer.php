</div>
</body>
<script src="<?= BASE_URL ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/feather.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<?php
if (!empty($data['js'])) {
    echo '<script>' . $data . '</script>';
} else if (!empty($data['sc'])) {
    foreach ($data['sc'] as $sc) {
        echo $sc . PHP_EOL;
    }
}
?>
<script src="<?= BASE_URL ?>assets/js/script.js"></script>

</html>