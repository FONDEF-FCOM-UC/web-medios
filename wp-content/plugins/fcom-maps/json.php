<?php

add_action( 'pre_get_posts', function ($query ){
    global $wp;

    if ( !is_admin() && $query->is_main_query() ) {
        if ($wp->request == 'fcom-maps/json/data'){
        
            global $wpdb;
	        global $fcom_tags_db_version;

            // Artículos
            $args = array(
                'post_type' => 'post',
                'posts_per_page'=>-1
            );
            $post_query = new WP_Query($args);
            
            $x = 0; $y=0; $contador = 0;
            
            if($post_query->have_posts() )
            {
                while($post_query->have_posts() )
                {
                    $post_query->the_post();
                    $post_tags = get_tags();
                    $categories = get_the_category();
                    $grupo = '';
                    
                    foreach($categories as $category)
                        $grupo .= $category->term_id;
                                  
                    //crea el nodo
                    $nodos_array[] = array(
                        'name'=> get_the_title(),
                        'id' => $contador,
                        'postId' => get_the_ID(),
                        'group'=> $grupo,
                        'titulo' => get_the_title(), 
                        'bajada' => get_the_excerpt(),
                        'img_path' => wp_get_attachment_image_src( get_post_thumbnail_id(), array(100,100) ),
                        'path' => get_permalink(),
                        'fecha' => array('dia' => get_the_time('d'), 'mes'=> get_the_time('M'), 'agno' => get_the_time('Y'))
                        );
                    $tag_index++;
                    
                    //posicion inicial pre convergencia
                    ($x+$y)%2==0 ? $x++ : $y++; $contador++;
                }
            
            }   
            wp_reset_query();

            $links_array = array();
            $links_index = array();
            $prob = rand(0,10);
               
            // Creamos los links con todos
            foreach($nodos_array as $nodo_i)
            {
                foreach($nodos_array as $nodo_j)
                {
                    // Vemos si no existe el inverso
                    $edge = array($nodo_j['id'], $nodo_i['id']);
                        
                    if(!in_array($edge, $links_index) && $nodo_i['id'] != $nodo_j['id'] && $prob == 1)
                    {
                        // Agregamos el link
                        $links_array[] = array(
                            'source' => $nodo_i['id'],
                            'target' => $nodo_j['id'],
                            'value' => rand(1,10)
                        );
                        
                        // Agregamos la flecha creada
                        $links_index = array($nodo_i['id'], $nodo_j['id']);
                    }
                    
                    $prob = rand(0,5);
                }
            }
            
            // Devolvemos el arreglo
            $retorno = array("nodes"=>$nodos_array,"links"=>$links_array);
            wp_send_json($retorno);
           
            wp_die();
            
            exit;
        }
        elseif($wp->request == 'fcom-maps/json/post')
        {
            global $wpdb;
            global $more;
            
	        // Obtenemos el parametro
	        $queryURL = parse_url( html_entity_decode( esc_url( add_query_arg( $arr_params ) ) ) );
            parse_str( $queryURL['query'], $getVar );
            $postID = $getVar['id'];
	        
            // Artículos
            $args = array('post_type' => 'post');
            if($postID)
                $args["p"] = $postID;
            
            $post_query = new WP_Query($args);
            $post = array();
            
            if($post_query->have_posts() )
            {
                while($post_query->have_posts() )
                {
                    $post_query->the_post();
                    $post_tags = get_tags();
                    
                    $more = 0;
                    $bajada = get_the_content('', true);;
                    $more = 1;
                    $cuerpo = apply_filters('the_content', get_the_content('', true));
            
                    // Creamos el nodo
                    $post = array(
                        'name'=> get_the_title(),
                        'id' => get_the_ID(),
                        'group'=> rand(1,5),
                        'titulo' => get_the_title(), 
                        'bajada' => $bajada,
                        'img_path' => wp_get_attachment_image_src( get_post_thumbnail_id(), array(100,100) ),
                        'path' => get_permalink(),
                        'fecha' => array('dia' => get_the_time('d'), 'mes'=> get_the_time('M'), 'agno' => get_the_time('Y')),
                        'content' => $cuerpo
                    );
                }
            }   
            wp_reset_query();
            
            // Devolvemos el arreglo
            wp_send_json($post);
            wp_die();
            
            exit;
        }
    }
});
