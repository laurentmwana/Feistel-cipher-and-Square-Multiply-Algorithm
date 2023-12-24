<?php

use App\Handle\Generator;
use App\Helper\Form;
use App\Helper\Session;
use App\Helper\Validator;

$keys = [];
$errors = null;

if (!empty($_POST)) {
    $validator = (new Validator($_POST))
        ->required(['g-message', 'g-order-1', 'g-order-2'])
        ->regex('g-message', '/^[01]{8}$/', '0-1')
        ->regex('g-order-1', '/^[1-4]{1}$/', '1-4')->regex('g-order-2', '/^[1-4]{1}$/', '1-4');
    $errors = $validator->errors;

    if ($validator->isValid()){
        $keys = (new Generator($_POST['g-message'], (int)$_POST['g-order-1'], (int)$_POST['g-order-2']))
            ->apply();
    } 
}

if (isset($_POST['save'])){
    // enregistrer la clé dans la session
    Session::save('keys', $keys);
    // on fait une redirection vers la page de chiffrement
    // sachant que pour chiffrement, on aura besoin de k1, k2 qui sont enregistrées dans la session
    redirect('/crypt', ['to-generator' => true]);
}

$form = new Form($_POST, $errors);
?>
<div class="mb">
    <h2 class="h-title">Génération de clé</h2>
    <p class="h-para">
        Pour générer une clé, vous devez simplement inserer une valeur d'entrée, Lorem ipsum dolor sit amet consectetur adipisicing elit. In minus ut veritatis dicta, beatae odio a. Odio dicta, aliquid odit, nesciunt quaerat cum aspernatur ut ad excepturi maiores reprehenderit iste.
    </p>
</div>
<form action="" method="post" class="form">
    <div class="mb">
        <div class="form-group">
            <?= $form->input('Insérer le message', 'g-message', ['type' => 'number'])  ?>
        </div>
        <div class="form-group">
            <?= $form->input('Ordre de décalage pour K1 ', 'g-order-1', ['type' => 'number'])  ?>
        </div>
        <div class="form-group">
            <?= $form->input('Ordre de décalage pour K2', 'g-order-2', ['type' => 'number'])  ?>
        </div>
    </div>
    <?= $form->button('Générer', ['type' => 'submit', 'class' => 'button'])  ?>
    <?php if (!empty($keys)): ?>
    <div class="output mb">
        clé générée : <strong><?= separator($keys) ?></strong>
    </div>
    <?= $form->button('Enregistrer la clé', ['class' => 'button', 'name' => 'save'])  ?>
    <?php endif ?>
</form>

