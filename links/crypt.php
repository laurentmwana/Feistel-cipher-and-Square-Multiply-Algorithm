<?php

use App\Handle\Crypt;
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
        $crypt = (new Crypt($_POST['n'], $keys))
            ->apply();
    } 
}

if (isset($_GET['delete-key'])) {
    // on supprime les clés
    Session::delete('keys');
    // on recharge la page
    redirect('/crypt');
}

$form = new Form($_POST, $errors);
?>
<?php if (!empty($keys)): ?>

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
    <a href="<?= generateUrl('/crypt', ['delete-key' => true]) ?>" class="link">Supprimer la clé</a>
</div>
<?php endif ?>

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
    <div class="warning mt" style="margin-top: 50px;">
        Pour Chiffrer un message binaire avec cet algorithme, vous devez d'abord, commencer par <a href="<?= generateUrl('/generator') ?>">générer les clés</a>
    </div>
<?php endif; ?>


