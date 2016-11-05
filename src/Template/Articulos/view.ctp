<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Articulo'), ['action' => 'edit', $articulo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Articulo'), ['action' => 'delete', $articulo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articulo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Articulos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Articulo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Modelos'), ['controller' => 'Modelos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Modelo'), ['controller' => 'Modelos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Accesorios'), ['controller' => 'Accesorios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accesorio'), ['controller' => 'Accesorios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="articulos view large-9 medium-8 columns content">
    <h3><?= h($articulo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Serial') ?></th>
            <td><?= h($articulo->serial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modelo') ?></th>
            <td><?= $articulo->has('modelo') ? $this->Html->link($articulo->modelo->id, ['controller' => 'Modelos', 'action' => 'view', $articulo->modelo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datos') ?></th>
            <td><?= h($articulo->datos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ubicacion') ?></th>
            <td><?= h($articulo->ubicacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($articulo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Compra') ?></th>
            <td><?= h($articulo->fecha_de_compra) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($articulo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($articulo->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Estado') ?></h4>
        <?= $this->Text->autoParagraph(h($articulo->estado)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Accesorios') ?></h4>
        <?php if (!empty($articulo->accesorios)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Descripcion') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($articulo->accesorios as $accesorios): ?>
            <tr>
                <td><?= h($accesorios->id) ?></td>
                <td><?= h($accesorios->descripcion) ?></td>
                <td><?= h($accesorios->estado) ?></td>
                <td><?= h($accesorios->articulo_id) ?></td>
                <td><?= h($accesorios->created) ?></td>
                <td><?= h($accesorios->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Accesorios', 'action' => 'view', $accesorios->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Accesorios', 'action' => 'edit', $accesorios->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Accesorios', 'action' => 'delete', $accesorios->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accesorios->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Asignaciones') ?></h4>
        <?php if (!empty($articulo->asignaciones)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Proceso Id') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($articulo->asignaciones as $asignaciones): ?>
            <tr>
                <td><?= h($asignaciones->id) ?></td>
                <td><?= h($asignaciones->titulo) ?></td>
                <td><?= h($asignaciones->proceso_id) ?></td>
                <td><?= h($asignaciones->articulo_id) ?></td>
                <td><?= h($asignaciones->hasta) ?></td>
                <td><?= h($asignaciones->created) ?></td>
                <td><?= h($asignaciones->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Asignaciones', 'action' => 'view', $asignaciones->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Asignaciones', 'action' => 'edit', $asignaciones->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Asignaciones', 'action' => 'delete', $asignaciones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asignaciones->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Devoluciones') ?></h4>
        <?php if (!empty($articulo->devoluciones)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Proceso Id') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($articulo->devoluciones as $devoluciones): ?>
            <tr>
                <td><?= h($devoluciones->id) ?></td>
                <td><?= h($devoluciones->titulo) ?></td>
                <td><?= h($devoluciones->proceso_id) ?></td>
                <td><?= h($devoluciones->articulo_id) ?></td>
                <td><?= h($devoluciones->created) ?></td>
                <td><?= h($devoluciones->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Devoluciones', 'action' => 'view', $devoluciones->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Devoluciones', 'action' => 'edit', $devoluciones->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Devoluciones', 'action' => 'delete', $devoluciones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devoluciones->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Lineas') ?></h4>
        <?php if (!empty($articulo->lineas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Operadora') ?></th>
                <th scope="col"><?= __('Numero') ?></th>
                <th scope="col"><?= __('Puk') ?></th>
                <th scope="col"><?= __('Pin') ?></th>
                <th scope="col"><?= __('Codigo Sim') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Observaciones') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($articulo->lineas as $lineas): ?>
            <tr>
                <td><?= h($lineas->id) ?></td>
                <td><?= h($lineas->operadora) ?></td>
                <td><?= h($lineas->numero) ?></td>
                <td><?= h($lineas->puk) ?></td>
                <td><?= h($lineas->pin) ?></td>
                <td><?= h($lineas->codigo_sim) ?></td>
                <td><?= h($lineas->articulo_id) ?></td>
                <td><?= h($lineas->estado) ?></td>
                <td><?= h($lineas->observaciones) ?></td>
                <td><?= h($lineas->created) ?></td>
                <td><?= h($lineas->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Lineas', 'action' => 'view', $lineas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Lineas', 'action' => 'edit', $lineas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lineas', 'action' => 'delete', $lineas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lineas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
