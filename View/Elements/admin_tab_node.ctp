<?php
    $haveRouteValidationErrors = true;

    $routeAlias = '';
    $routeStatus = true;
    
    if ($this->action == 'admin_edit') {
        if (empty($this->validationErrors['Node'])) {
            $haveRouteValidationErrors = false;
        }
        
        if ($haveRouteValidationErrors == true) {
            
            $routeAlias = $this->request->data['Node']['route_alias'];
            $routeStatus = $this->request->data['Node']['route_status'];
            
        } else {
            
            if(isset($this->request->data['Route']['Route'])) {
                $routeAlias = $this->request->data['Route']['Route']['alias'];
                $routeStatus = $this->request->data['Route']['Route']['status'];
            }
            
        }
    }

    echo $this->Form->input('route_alias', array(
        'label' => __d('route', 'Route Alias'),
        'value' => $routeAlias,
        'class' => 'input-block-level slug',
    ))
    . $this->Form->input('route_status', array(
        'label' => __d('route', 'Route Status'),
        'value' => $routeStatus,
        'type' => 'checkbox',
        'checked' => $routeStatus,
        'class' => false
    ));
?>