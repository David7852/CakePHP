<?=$this->assign('title',"Contratos de los trabajadores")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="usu" id="seleccion"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Trabajador'), ['controller' => 'Trabajadores', 'action' => 'view', $this->request->session()->read('Auth.User.id')]) ?></li>
            <li><?= $this->Html->link(__('Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Agregar Contrato'), ['action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>

    </ul>
</nav>
<div class="contratos index large-9 medium-8 columns content">
    <h3><?= __('Contratos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('trabajador_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_de_inicio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_de_culminacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo_de_contrato')?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratos as $contrato): ?>
            <tr>
                <td><?= $contrato->has('trabajador') ? $this->Html->link($contrato->trabajador->titulo, ['controller' => 'Trabajadores', 'action' => 'view', $contrato->trabajador->id]) : '' ?></td>
                <td><?= h($contrato->fecha_de_inicio) ?></td>
                <td><?= h($contrato->fecha_de_culminacion) ?></td>
                <td><?= h($contrato->tipo_de_contrato) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $contrato->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $contrato->id]) ?>

                    <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $contrato->id], ['confirm' => __('¿Confirma querer eliminar el contrato {0}?', $contrato->titulo)]) ?>
                <?php endif; ?>
                    </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('<')) ?>
            <?= str_replace("of","de",$this->Paginator->numbers()) ." ". str_replace("of","de",$this->Paginator->counter()) ?>
            <?= $this->Paginator->next(__('>') . ' >') ?>
        </ul>

    </div>
</div>
