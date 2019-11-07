<?php if ($this->temErro($campo)): ?>
    <span class="helper-text red-text" data-error="wrong" data-success="right"><?= $this->getErro($campo) ?></span>
<?php endif ?>