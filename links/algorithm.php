<?php

use App\Handle\Generator;
use App\Helper\Form;
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
    <?= $form->button('Générer', ['type' => 'submit'])  ?>

    <div class="output">
        clé générée : <strong><?= separator($keys) ?></strong>
    </div>
</form>