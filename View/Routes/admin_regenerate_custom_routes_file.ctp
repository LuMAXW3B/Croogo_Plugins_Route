<?php
    $this->set('showActions', false);
    $this->extend(DS . 'Common' . DS . 'admin_index');
    $this->Html
    ->addCrumb('', DS . 'admin', array('icon' => 'home'))
    ->addCrumb(__d('route', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
    ->addCrumb(__d('route', 'List Routes'),  array('plugin' => 'route', 'controller' => 'routes', 'action' => 'index'))
    ->addCrumb(__d('route', 'Regenerating Custom Routes File'));
?>

<div class="row-fluid">
    <div class="span8">
        <ul class="nav nav-tabs">
            <li><a href="#route-main" data-toggle="tab"><?php echo $title_for_layout; ?></a></li>
        </ul>
        <div class="tab-content">
            <div id="route-main" class="tab-pane">
                <textarea style="width: 98%; margin: 25px 0 25px 0; font-size: 14px;" readonly="readonly"><?php echo $code_for_layout; ?></textarea><br />
                <br />
                <?php echo $output_for_layout; ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <?php
            echo $this->Html->beginBox(__d('route', 'Actions'))
            . $this->Html->link(__d('route', 'Back'), array('action' => 'index'), array('button' => 'success'))
            . $this->Html->endBox();
        ?>
    </div>
</div>