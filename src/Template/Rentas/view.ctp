<?=$this->assign('title',"Rentas y Planes")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">

        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $renta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $renta->id], ['confirm' => __('¿Confirma querer eliminar la renta {0}?', $renta->nombre)]) ?> </li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="rentas view large-9 medium-8 columns content">
    <h3><?= h($renta->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Monto Basico') ?></th>
            <td><?= $this->Number->format($renta->monto_basico)." Bs" ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Operadora') ?></th>
            <td><?= $this->Text->autoParagraph(h($renta->operadora)) ?></td>
        </tr>
    </table>
    <?php if (!empty($renta->servicios)): ?>
    <div class="related">
        <h4><?= __('Servicios ofrecidos') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Nombre y descripción') ?></th>
                <th scope="col"><?= __('Cupo') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($renta->servicios as $servicios): ?>
            <tr>
                <td><?= h($servicios->nombre) ?></td>
                <td><?= h($servicios->cupo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Consumos', 'action' => 'view', $servicios->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Consumos', 'action' => 'edit', $servicios->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Consumos', 'action' => 'delete', $servicios->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $servicios->titulo)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($renta->lineas)&&$this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
    <div class="related">
        <h4><?= __('Lineas con ').h($renta->nombre) ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('operadora') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Equipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Propietario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observaciones') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($renta->lineas as $lineas): ?>
            <tr>
                <td><?= h($lineas->operadora) ?></td>
                <td><?= h($lineas->numero) ?></td>
                <td><?= $lineas->altarticulo!=null ? $this->Html->link($lineas->altarticulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $lineas->altarticulo->id]) : 'Sin asignar' ?>
                    <?= $lineas->altarticulo!=null ? "<img style='float: none; width: 3rem; margin-top: -7px; padding: 0.3rem;' src='/WIT/webroot/img/Modelos/".$lineas->altarticulo->imagen."'>" : '' ?>
                </td>
                <td>
                    <?= $lineas->altarticulo!=null ? $this->Html->link($lineas->altarticulo->asignado, ['controller' => 'Trabajadores', 'action' => 'view', $lineas->altarticulo->asignadoid]) : 'Sin asignar' ?>
                </td>
                <td>
                    <?= h($lineas->estado) ?>
                </td>
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
