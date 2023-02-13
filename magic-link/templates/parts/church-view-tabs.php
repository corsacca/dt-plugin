<div class="container">
     <dt-button context="<?php echo empty( $action ) ? 'parimary' : 'inactive'; ?>" href="<?php echo esc_url( $app_url ); ?>">
        Church Health
    </dt-button>
    <dt-button context="<?php echo $action === 'tree' ? 'parimary' : 'inactive'; ?>" href="<?php echo esc_url( $app_url . "?" . http_build_query( [ 'action' => 'tree' ] ) ); ?>">
       Tree
    </dt-button>
    <dt-button context="<?php echo $action === 'genmap' ? 'parimary' : 'inactive'; ?>" href="<?php echo esc_url( $app_url . "?" . http_build_query( [ 'action' => 'genmap' ] ) ); ?>">
        Genmap
    </dt-button>
</div>