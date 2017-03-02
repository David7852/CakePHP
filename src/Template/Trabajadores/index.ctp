<?=$this->assign('title',"Trabajadores de Fertinitro")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="usu" id="seleccion"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Trabajadores'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Agregar Trabajador'), ['action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Contrato'), ['controller' => 'Contratos', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'Usuarios', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="trabajadores index large-9 medium-8 columns content">
    <h3><?= __('Trabajadores') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gerencia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cargo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('area') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sede') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extension') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trabajadores as $trabajador): ?>
            <tr>
                <td><?= h($trabajador->nombre).' '.$trabajador->apellido ?></td>
                <td><?=$this->Text->autoParagraph(h($trabajador->gerencia))?></td>
                <td><?=$this->Text->autoParagraph(h($trabajador->cargofix))?></td>
                <td><?=$this->Text->autoParagraph(h($trabajador->area))?></td>
                <td>
                <?php if ($trabajador->sede==0): ?>
                <?= h('Sede del complejo Jose') ?>
                <?php else: ?>
                <?= h('Sede edificio Laguna') ?>
                <?php endif; ?>
                </td>
                <td><?=$this->Text->autoParagraph(h($trabajador->extension))?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $trabajador->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $trabajador->id]) ?>
                    <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $trabajador->id], ['confirm' => __('¿Confirma querer eliminar al trabajador {0}?', $trabajador->titulo)]) ?>
                <?php endif; ?></td>
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
