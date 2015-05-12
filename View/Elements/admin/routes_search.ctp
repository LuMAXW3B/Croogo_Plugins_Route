<?php
    $url = isset($url) ? $url : array('action' => 'index');
?>
<div class="clearfix filter">
    <?php
        echo $this->Form->create('Route', array(
            'class' => 'form-inline',
            'url' => $url,
            'inputDefaults' => array(
                'label' => false,
            ),
        ))
        . $this->Form->input('alias', array(
            'title' => __d('route', 'Alias'),
            'placeholder' => __d('route', 'Alias...'),
            'tooltip' => false,
        ))
        . $this->Form->submit(__d('route', 'Filter'), array(
                    'button' => 'default',
                    'div' => false,
        ))
        . '&nbsp;'
        . $this->Html->link(__d('route', 'Reset'),
                array('action' => 'index'),
                array(
                    'button' => 'default',
                    'escape' => false,
                )
        )
        . $this->Form->end();
    ?>
</div>
