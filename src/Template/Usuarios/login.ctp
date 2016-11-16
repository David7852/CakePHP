<h1>¡Bienvenido!</h1>
<?= $this->Form->create() ?>
<?= $this->Form->input('nombre_de_usuario') ?>
<?= $this->Form->input('clave') ?>
<?= $this->Form->button('Ingresar') ?>
<?= $this->Form->end() ?>