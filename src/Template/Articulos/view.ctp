<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar este Articulo'), ['action' => 'edit', $articulo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar este Articulo'), ['action' => 'delete', $articulo->id], ['confirm' => __('¿Confirma querer eliminar el articulo {0}?', $articulo->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Modelos'), ['controller' => 'Modelos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Modelo'), ['controller' => 'Modelos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Accesorios'), ['controller' => 'Accesorios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Accesorio'), ['controller' => 'Accesorios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Formar Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Formar Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="articulos view large-9 medium-8 columns content">

    <div class="imagedisplay">
        <table >
            <tr>
                <td>
                    <h4><?= h($articulo->modelo->tipo_de_articulo) ?></h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h4><?= "Marca: ". h($articulo->modelo->marca) ?></h4><br>
                </td>
            </tr>
            <tr>
                <td>
                    <h4><?= "Modelo: ". h($articulo->modelo->modelo) ?></h4><br>
                </td>
            </tr>
            <tr>
                <td>
                    <h4 style="color:#be140b;text-shadow: 0 0 2px rgba(190,20,11,0.2)"><?= "Serial: ". h($articulo->titulo) ?></h4><br>
                </td>
            </tr>
        </table>
        <figure>
            <img src="/WIT/webroot/img/Modelos/<?= h($articulo->modelo->imagen) ?>">
        </figure>
    </div>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Usuario asignado') ?></th>
            <td><?= $articulo->asignadoid!='' ? $this->Html->link($articulo->asignado, ['controller' => 'Trabajadores', 'action' => 'view', $articulo->asignadoid]) :'Articulo sin asignar'  ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ubicacion Actual') ?></th>
            <td><?= h($articulo->ubicacion) ?></td>
        </tr>
        <?php if($articulo->datos!=''||$articulo->modelo->abstracto!=''): ?>
            <tr>
                <th scope="row"><?php if($articulo->modelo->abstracto=='') echo('Datos adicionales'); else echo(h($articulo->modelo->abstracto));?></th>
                <td><?= h($articulo->datos) ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __('Fecha De Compra') ?></th>
            <td><?= h($articulo->fecha_de_compra) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($articulo->estado) ?></td>
        </tr>
    </table>
    <?php if (!empty($articulo->accesorios)): ?>
    <div class="related">
        <h4><?= __('Accesorios') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Descripcion') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($articulo->accesorios as $accesorios): ?>
            <tr>
                <td><?= h($accesorios->descripcion) ?></td>
                <td><?= h($accesorios->estado) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Accesorios', 'action' => 'view', $accesorios->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Accesorios', 'action' => 'edit', $accesorios->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Accesorios', 'action' => 'delete', $accesorios->id], ['confirm' => __('¿Confirma querer eliminar el accesorio: {0}?', $accesorios->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($articulo->asignaciones)): ?>
    <div class="related">
        <h4><?= __('Historial De Asignaciones') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Proceso Id') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($articulo->asignaciones as $asignaciones): ?>
            <tr>
                <td><?= h($asignaciones->proceso_id) ?></td>
                <td><?= h($asignaciones->articulo_id) ?></td>
                <td><?= h($asignaciones->hasta) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Asignaciones', 'action' => 'view', $asignaciones->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Asignaciones', 'action' => 'edit', $asignaciones->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Asignaciones', 'action' => 'delete', $asignaciones->id], ['confirm' => __('¿Confirma querer eliminar la asignacion {0}?', $asignaciones->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($articulo->devoluciones)): ?>
    <div class="related">
        <h4><?= __('Historial De Devoluciones') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Proceso Id') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($articulo->devoluciones as $devoluciones): ?>
            <tr>
                <td><?= h($devoluciones->proceso_id) ?></td>
                <td><?= h($devoluciones->articulo_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Devoluciones', 'action' => 'view', $devoluciones->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Devoluciones', 'action' => 'edit', $devoluciones->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Devoluciones', 'action' => 'delete', $devoluciones->id], ['confirm' => __('¿Confirma querer eliminar la devolucion {0}?', $devoluciones->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($articulo->lineas)): ?>
    <div class="related">
        <h4><?= __('Lineas asociadas') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Operadora') ?></th>
                <th scope="col"><?= __('Numero') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Observaciones') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($articulo->lineas as $lineas): ?>
            <tr>
                <td><?= h($lineas->operadora) ?></td>
                <td><?= h($lineas->numero) ?></td>
                <td><?= h($lineas->estado) ?></td>
                <td><?= h($lineas->observaciones) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Lineas', 'action' => 'view', $lineas->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Lineas', 'action' => 'edit', $lineas->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Lineas', 'action' => 'delete', $lineas->id], ['confirm' => __('¿Confirma querer eliminar la linea {0}?', $lineas->numero)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
