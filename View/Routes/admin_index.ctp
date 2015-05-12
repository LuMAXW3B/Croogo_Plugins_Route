<?php
    if (!$this->request->is('ajax') && isset($this->request->params['admin'])):
        $this->Html->script('Route.admin', array('inline' => false));
    endif;

    $this->extend(DS . 'Common' . DS . 'admin_index');
    $this->Html->addCrumb('', DS . 'admin', array('icon' => 'home'))
    ->addCrumb(__d('croogo', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
    ->addCrumb(__d('route', 'List Routes'),  array('plugin' => 'route', 'controller' => 'routes', 'action' => 'index'));

    $this->append('actions');
    echo $this->Croogo->adminAction(
        __d('route', 'Add'),
        array('action' => 'add'),
        array('button' => 'success')
    )
    . $this->Croogo->adminAction(
        __d('route', 'Enable All'),
        array('action' => 'admin_enable_all'),
        array('button' => 'default')
    )
    . $this->Croogo->adminAction(
        __d('route', 'Disable All'),
        array('action' => 'admin_disable_all'),
        array('button' => 'warning')
    )
    . $this->Croogo->adminAction(
        __d('route', 'Delete All'),
        array('action' => 'admin_delete_all'),
        array('button' => 'danger')
    )
    . $this->Croogo->adminAction(
        __d('route', 'Regenerate File'),
        array('action' => 'regenerate_custom_routes_file'),
        array('button' => 'default')
    );
    $this->end();
    
    $this->append('search', $this->element('admin' . DS . 'routes_search'));
?>

<?php echo $this->Form->create('Route', array('url' => array('plugin' => 'route', 'controller' => 'routes', 'action' => 'process'))); ?>    
<table class="table table-striped"> 
    <?php
        $tableHeaders = $this->Html->tableHeaders(array(
            $this->Form->checkbox('checkAllAuto'),
            $this->Paginator->sort('id'),
            $this->Paginator->sort('alias'),
            __d('route', 'Body'),
            $this->Paginator->sort('status'),
            __d('route', 'Actions'),
        ));
    ?>   
    <thead>
	<?php echo $tableHeaders; ?>
    </thead>
    
    <?php
        $rows = array();
        foreach ($routes as $route) {
            $actions = array();
            $actions[] = $this->Croogo->adminRowActions($route['Route']['id']);
            $actions[] = $this->Croogo->adminRowAction('',
                array('action' => 'edit', $route['Route']['id']),
                array('icon' => 'pencil', 'tooltip' => __d('route', 'Edit this Route'))
            );
            $actions[] = $this->Croogo->adminRowAction('',
                '#Route' . $route['Route']['id'] . 'Id',
                array('icon' => 'trash', 'tooltip' => __d('route', 'Delete this Route'), 'rowAction' => 'delete'),
                __d('route', 'Are you sure you want to delete # %s?', $route['Route']['id'])
            );
            $actions = $this->Html->div('item-actions', implode(' ', $actions));
            
            $rows[] = array(
                $this->Form->checkbox('Route.' . $route['Route']['id'] . '.id'),
                h($route['Route']['id']),
                h($route['Route']['alias']),
                h($route['Route']['body']),
                $this->Layout->status($route['Route']['status']),
                $actions,
            );
        }
        echo $this->Html->tableCells($rows);
    ?>
</table>
<div class="row-fluid">
    <div id="bulk-action" class="control-group">
        <?php
            echo $this->Form->input('Route.action', array(
                'label' => false,
                'div' => 'input inline',
                'options' => array(
                    'enable_routes' => __d('route', 'Enable Routes'),
                    'disable_routes' => __d('route', 'Disable Routes'),
                    'delete' => __d('route', 'Delete Routes'),
                ),
                'empty' => true,
            ));
        ?>
        <div class="controls">
            <?php echo $this->Form->end(__d('route', 'Submit')); ?>
        </div>
    </div>
</div>
