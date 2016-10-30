<?php

/**
 * @copyright Copyright (c) Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2016
 */

$enc = $this->encoder();

$listTarget = $this->config( 'client/html/catalog/lists/url/target' );
$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$listConfig = $this->config( 'client/html/catalog/lists/url/config', array() );


$total = $this->total;
$current = $this->current;
$last = ( $total != 0 ? ceil( $total / $this->size ) : 1 );
$params = $this->get( 'params', array() );


$sort = ( isset( $params['f_sort'] ) ? $params['f_sort'] : 'relevance' );
$sortname = ltrim( $sort, '-' );
$nameDir = $priceDir = '';

if( $sort === 'name' ) {
	$nameSort = $this->translate( 'client', '▼ Name' ); $nameDir = '-';
} else if( $sort === '-name' ) {
	$nameSort = $this->translate( 'client', '▲ Name' );
} else {
	$nameSort = $this->translate( 'client', 'Name' );
}

if( $sort === 'price' ) {
	$priceSort = $this->translate( 'client', '▼ Price' ); $priceDir = '-';
} else if( $sort === '-price' ) {
	$priceSort = $this->translate( 'client', '▲ Price' );
} else {
	$priceSort = $this->translate( 'client', 'Price' );
}


?>
<nav class="pagination">

	<div class="sort">
		<span><?php echo $enc->html( $this->translate( 'client', 'Sort by:' ), $enc::TRUST ); ?></span>
		<ul>
			<li><a class="option-relevance <?php echo ( $sort === 'relevance' ? 'active' : '' ); ?>" href="<?php echo $enc->attr( $this->url( $listTarget, $listController, $listAction, array( 'f_sort' => 'relevance' ) + $params, array(), $listConfig ) ); ?>"><?php echo $enc->html( $this->translate( 'client', 'Relevance' ), $enc::TRUST ); ?></a></li>
			<li><a class="option-name <?php echo ( $sortname === 'name' ? 'active' : '' ); ?>" href="<?php echo $enc->attr( $this->url( $listTarget, $listController, $listAction, array( 'f_sort' => $nameDir . 'name' ) + $params, array(), $listConfig ) ); ?>"><?php echo $enc->html( $nameSort, $enc::TRUST ); ?></a></li>
			<li><a class="option-price <?php echo ( $sortname === 'price' ? 'active' : '' ); ?>" href="<?php echo $enc->attr( $this->url( $listTarget, $listController, $listAction, array( 'f_sort' => $priceDir . 'price' ) + $params, array(), $listConfig ) ); ?>"><?php echo $enc->html( $priceSort, $enc::TRUST ); ?></a></li>
		</ul>
	</div>

	<?php if( $last > 1 ) : ?>
		<div class="browser">
			<a class="first" href="<?php echo $enc->attr( $this->url( $listTarget, $listController, $listAction, array( 'l_page' => 1 ) + $params, array(), $listConfig ) ); ?>"><?php echo $enc->html( $this->translate( 'client', '◀◀' ), $enc::TRUST ); ?></a>
			<a class="prev" href="<?php echo $enc->attr( $this->url( $listTarget, $listController, $listAction, array( 'l_page' => ( $current > 1 ? $current - 1 : 1 ) ) + $params, array(), $listConfig ) ); ?>" rel="prev"><?php echo $enc->html( $this->translate( 'client', '◀' ), $enc::TRUST ); ?></a>
			<span><?php echo $enc->html( sprintf( $this->translate( 'client', 'Page %1$d of %2$d' ), $current, $last ) ); ?></span>
			<a class="next" href="<?php echo $enc->attr( $this->url( $listTarget, $listController, $listAction, array( 'l_page' => ( $current < $last ? $current + 1 : $last ) ) + $params, array(), $listConfig ) ); ?>" rel="next"><?php echo $enc->html( $this->translate( 'client', '▶' ), $enc::TRUST ); ?></a>
			<a class="last" href="<?php echo $enc->attr( $this->url( $listTarget, $listController, $listAction, array( 'l_page' => $last ) + $params, array(), $listConfig ) ); ?>"><?php echo $enc->html( $this->translate( 'client', '▶▶' ), $enc::TRUST ); ?></a>
		</div>
	<?php endif; ?>

</nav>
