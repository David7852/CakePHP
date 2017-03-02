<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Mis Lineas'), ['action' => 'index',$this->request->session()->read('Auth.User.trabajador_id')]) ?></li>
            <li><?= $this->Html->link(__('Mis Celulares'), ['controller' => 'Articulos', 'action' => 'inventario','0Celular']) ?></li>
        <?php else: ?>
            <li><?= $this->Html->link(__('Dar Consumo'), ['controller'=> 'Consumos', 'action' => 'add',$linea->id],['style'=>'color:#D7782E']) ?></li>
            <li><?= $this->Html->link(__('Lineas'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Celulares'), ['controller' => 'Articulos', 'action' => 'inventario','0Celular']) ?></li>
            <li><?= $this->Html->link(__('Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="lineas view large-9 medium-8 columns content">
    <h3><?= h($linea->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($linea->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Codigo Sim') ?></th>
            <td><?= h($linea->codigo_sim) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $linea->has('articulo') ? $this->Html->link($linea->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $linea->articulo->id]) : 'Sin asignar' ?>
            <?= $linea->has('articulo') ? "<img style='float: none; width: 3rem; margin-top: -7px; padding: 0.3rem;' src='/WIT/webroot/img/Modelos/".$linea->articulo->imagen."'>" : '' ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Propietario') ?></th>
            <td><?= $linea->has('articulo')&&$linea->articulo->asignado!='' ? $this->Html->link($linea->articulo->asignado, ['controller' => 'Trabajadores', 'action' => 'view', $linea->articulo->asignadoid]) : 'Sin asignar' ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observaciones') ?></th>
            <td><?= h($linea->observaciones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Puk') ?></th>
            <td><?= $this->Number->format($linea->puk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pin') ?></th>
            <td><?= $this->Number->format($linea->pin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Operadora') ?></th>
            <td><?= h($linea->operadora) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($linea->estado) ?></td>
        </tr>

    </table>
    <?php if (!empty($linea->rentas)): ?>
        <div class="related">
            <h4><?= __('Rentas y planes asignados') ?></h4>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Nombre') ?></th>
                    <th scope="col"><?= __('Monto Basico') ?></th>
                    <th scope="col"><?= __('Operadora') ?></th>
                    <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
                <?php foreach ($linea->rentas as $rentas): ?>
                    <tr>
                        <td><?= h($rentas->nombre) ?></td>
                        <td><?= h($rentas->monto_basico) ?></td>
                        <td><?= h($rentas->operadora) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'Rentas', 'action' => 'view', $rentas->id]) ?>
                            <?= $this->Html->link(__('Editar'), ['controller' => 'Rentas', 'action' => 'edit', $rentas->id]) ?>
                    <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Rentas', 'action' => 'delete', $rentas->id], ['confirm' => __('¿Confirma querer eliminar la renta o plan {0}?', $rentas->nombre)]) ?>
                        <?php endif; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
    <?php if (!empty($linea->facturas)): ?>
    <div class="related">
        <h4><?= __('Facturas de esta linea') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Balance') ?></th>
                <th scope="col"><?= __('Desde') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($linea->facturas as $facturas): ?>
            <tr>
                <td><?= h($facturas->titulo) ?></td>
                <td><?= h($facturas->balance) ?></td>
                <td><?= h($facturas->desde) ?></td>
                <td><?= h($facturas->hasta) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Facturas', 'action' => 'view', $facturas->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Facturas', 'action' => 'edit', $facturas->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Facturas', 'action' => 'delete', $facturas->id], ['confirm' => __('Confirma querer eliminar la factura {0}?', $facturas->titulo)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($consumos)): ?>
        <div class="related">
            <h4><?= __('Consumos del mes') ?></h4>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Factura') ?></th>
                    <th scope="col"><?= __('Cupo') ?></th>
                    <th scope="col"><?= __('Consumido') ?></th>
                    <th scope="col"><?= __('Excedente') ?></th>
                    <th scope="col"><?= __('Monto por exceso') ?></th>
                    <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
                <?php foreach ($consumos as $consumo): ?>
                    <tr>
                        <td><?= $this->Html->link($consumo->facturatitulo,
                                ['controller' => 'Facturas', 'action' => 'view', $consumo->factura_id]) ?></td>
                        <td><?= h($consumo->cupo) ?></td>
                        <td><?= h($consumo->consumido) ?></td>
                        <td><?= h($consumo->excedente) ?></td>
                        <td><?= h($consumo->monto_bs) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'Consumos', 'action' => 'view', $consumo->id]) ?>
                            <?= $this->Html->link(__('Editar'), ['controller' => 'Consumos', 'action' => 'edit', $consumo->id]) ?>
                    <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Consumos', 'action' => 'delete', $consumo->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumo->titulo)]) ?>
                        <?php endif; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</div>
