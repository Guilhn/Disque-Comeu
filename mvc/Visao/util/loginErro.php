<?php if ($this->temErro($campo)): ?>
    <p class="helper-text red-text" data-error="wrong" data-success="right"><?= $this->getErro($campo) ?></p>
<?php endif ?>