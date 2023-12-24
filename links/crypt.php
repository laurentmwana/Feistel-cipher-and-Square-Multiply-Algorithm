<?php

use App\Handle\Generator;
use App\Helper\Form;
use App\Helper\Session;
use App\Helper\Validator;

$keys = Session::get('keys');
$errors = null;
$crypt = [];

if (!empty($_POST)) {
    $validator = (new Validator($_POST))->required(['n'])->regex('n', '/^[01]{8}$/', '0-1');
    $errors = $validator->errors;
    if ($validator->isValid()){
        $crypt = (new Generator($_POST['g-message'], (int)$_POST['g-order-1'], (int)$_POST['g-order-2']))
            ->apply();
    } 
}


$form = new Form($_POST, $errors);
?>
<div class="mb">
    <h2 class="h-title">Chiffrement</h2>
    <p class="h-para">
        Pour générer une clé, vous devez simplement inserer une valeur d'entrée, Lorem ipsum dolor sit amet consectetur adipisicing elit. In minus ut veritatis dicta, beatae odio a. Odio dicta, aliquid odit, nesciunt quaerat cum aspernatur ut ad excepturi maiores reprehenderit iste.
    </p>
</div>
<div class="output">
    Les clés générées : <strong><?= separator($keys) ?></strong>
</div>
<div class="mb">
<a href="" class="link">supprimer la clé</a>
</div>

<?php if (!empty($keys)): ?>
<form action="" method="post" class="form">
    <div class="form-group">
        <?= $form->input('N', 'n', ['type' => 'number'])  ?>
    </div>
    <?= $form->button('Chiffrer le message', ['type' => 'submit', 'class' => 'button'])  ?>

    <?php if (!empty($keys)): ?>
    <div class="output mb">
        message crypté : <strong><?= toString('', $crypt) ?></strong>
    </div>
    <?php endif ?>
</form>
<?php else: ?>
    <div class="warning">
        Pour Chiffrer un message binaire avec cet algorithme, vous devez d'abord, commencer par <a href="<?= generateUrl('/generator') ?>">générer les clés</a>
    </div>
<?php endif; ?>


