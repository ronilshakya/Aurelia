<?php
/**
 * Bootstrap 5 WordPress Nav Walker
 */
class Bootstrap_WP_Navwalker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $submenu_class = $depth > 0 ? ' dropdown-submenu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu_class depth_$depth\">\n";
    }

   public function start_el(  &$output, $item, $depth = 0, $args = null, $id = 0  ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'nav-item';

    $has_children = in_array('menu-item-has-children', $classes);

    if ( $has_children && $depth === 0 ) {
        $classes[] = 'dropdown';
    }

    // Add 'active' to <li> if it's current
    if ( in_array('current-menu-item', $classes) || in_array('current_page_item', $classes) || in_array('current-menu-ancestor', $classes) || in_array('current-menu-parent', $classes) ) {
        $classes[] = 'active';
    }

    $class_names = join( ' ', array_filter( $classes ) );
    $class_names = ' class="' . esc_attr( $class_names ) . '"';

    $output .= $indent . '<li' . $class_names . '>';

    $atts = array();
    $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

    $link_classes = 'nav-link';
    if ( $has_children && $depth === 0 ) {
        $link_classes .= ' dropdown-toggle';
        $atts['id'] = 'menu-item-dropdown-' . $item->ID;
        $atts['role'] = 'button';
        // $atts['data-bs-toggle'] = 'dropdown';
        $atts['aria-expanded'] = 'false';
    }

    // Apply .active to <a> tag if current
    if ( in_array('current-menu-item', $classes) || in_array('current_page_item', $classes) || in_array('current-menu-ancestor', $classes) || in_array('current-menu-parent', $classes) ) {
        $link_classes .= ' active';
    }

    $atts['class'] = $link_classes;

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
        if ( ! empty( $value ) ) {
            $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
            $attributes .= ' ' . $attr . '="' . $value . '"';
        }
    }

    $title = apply_filters( 'the_title', $item->title, $item->ID );
    $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

    $item_output  = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . $title . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}


    public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args = null, &$output = '' ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        }

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

/**
 * Bootstrap 5 WordPress Nav Walker
 */
class Offcanvas_Bootstrap_WP_Navwalker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= "</ul>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes );

        $classes[] = 'nav-item';
        if ( $has_children && $depth === 0 ) $classes[] = 'dropdown';

        if ( in_array( 'current-menu-item', $classes ) ) $classes[] = 'active';

        $class_names = join( ' ', array_filter( $classes ) );
        $output .= $indent . '<li class="' . esc_attr( $class_names ) . '">';

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $url = ! empty( $item->url ) ? esc_url( $item->url ) : '#';

        if ( $has_children && $depth === 0 ) {
            // Navigation link + toggle
            $output .= '<div class="d-flex align-items-center justify-content-between">';
            $output .= '<a href="' . $url . '" class="nav-link">' . $title . '</a>';
            $output .= '<button class="btn dropdown-toggle nav-link px-2" type="button" aria-label="Toggle submenu"></button>';
            $output .= '</div>';
        } else {
            $output .= '<a href="' . $url . '" class="nav-link">' . $title . '</a>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }

    public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args = null, &$output = '' ) {
        if ( ! $element ) return;

        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) )
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}
