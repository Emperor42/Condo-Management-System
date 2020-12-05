<!--Khadija SUBTAIN-40040952 -->
<?php $this->flash('success', 'alert alert-success');  ?>
<?php $this->flash('failure', 'alert alert-warning'); ?>

<script>
setTimeout(function() {
    let alert = document.querySelector(".alert-success");
    alert.remove();
}, 3000);

setTimeout(function() {
    let alert = document.querySelector(".alert-warning");
    alert.style.display = 'none';
}, 3000);
</script>
