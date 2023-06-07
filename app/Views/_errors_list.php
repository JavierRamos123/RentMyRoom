<?php if (! empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger alert-danger-form-errors" role="alert">
        <?= esc($error) ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
    <?php endforeach ?>
<?php endif ?>