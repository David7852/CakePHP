<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>

        <li class="inv" id="seleccion"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Solicitar'), ['controller'=>'Procesos','action' => 'solicitar']) ?></li>
            <li><?= $this->Html->link(__('Articulos'), ['action' => 'index']) ?> </li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $articulo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $articulo->id], ['confirm' => __('¿Confirma querer eliminar el articulo: {0}?', $articulo->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Articulos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Modelos'), ['controller' => 'Modelos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Accesorios'), ['controller' => 'Accesorios', 'action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>

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
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Accesorios', 'action' => 'delete', $accesorios->id], ['confirm' => __('¿Confirma querer eliminar el accesorio: {0}?', $accesorios->titulo)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($articulo->asignaciones)&&$this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
    <div class="related">
        <h4><?= __('Historial De Asignaciones') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('proceso_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Solicitante') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($articulo->asignaciones as $asignaciones): ?>
            <tr>
                <td><?= $asignaciones->altproceso!=null ? $this->Html->link($asignaciones->altproceso->titulo, ['controller' => 'Procesos', 'action' => 'view', $asignaciones->altproceso->id]) : '' ?></td>
                <td>
                    <?= $asignaciones->altproceso!=null ? $this->Html->link($asignaciones->altproceso->solicitante, ['controller' => 'Trabajadores', 'action' => 'view', $asignaciones->altproceso->solicitanteid]) : 'Sin asignar' ?>
                </td>
                <td><?= h($asignaciones->hasta) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Asignaciones', 'action' => 'view', $asignaciones->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Asignaciones', 'action' => 'edit', $asignaciones->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Asignaciones', 'action' => 'delete', $asignaciones->id], ['confirm' => __('¿Confirma querer eliminar la asignacion {0}?', $asignaciones->titulo)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($articulo->devoluciones)&&$this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
    <div class="related">
        <h4><?= __('Historial De Devoluciones') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('proceso_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Solicitante') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($articulo->devoluciones as $devoluciones): ?>
            <tr>
                <td><?= $devoluciones->altproceso!=null ? $this->Html->link($devoluciones->altproceso->titulo, ['controller' => 'Procesos', 'action' => 'view', $devoluciones->altproceso->id]) : '' ?></td>
                <td>
                    <?= $devoluciones->altproceso!=null ? $this->Html->link($devoluciones->altproceso->solicitante, ['controller' => 'Trabajadores', 'action' => 'view', $devoluciones->altproceso->solicitanteid]) : 'Sin asignar' ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Devoluciones', 'action' => 'view', $devoluciones->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Devoluciones', 'action' => 'edit', $devoluciones->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Devoluciones', 'action' => 'delete', $devoluciones->id], ['confirm' => __('¿Confirma querer eliminar la devolucion {0}?', $devoluciones->titulo)]) ?>
                <?php endif; ?></td>
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
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Lineas', 'action' => 'delete', $lineas->id], ['confirm' => __('¿Confirma querer eliminar la linea {0}?', $lineas->numero)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
