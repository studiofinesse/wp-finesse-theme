<?php

function splide_init( $args ) {
	echo '<div' . fin_attr( $args ) . '>';
	echo '<div class="splide__track">';
	echo '<div class="splide__list">';
}

function splide_end() {
	echo '</div></div></div>';
}

function splide_slide_start() {
	echo '<div class="splide__slide">';
}

function splide_slide_end() {
	echo '</div>';
}