<?php
    //テーマサポート
    add_theme_support( 'menus' );//メニューのサポートを許可
    add_theme_support('title-tag');//タイトルタグのサポートを許可
    //タイトル出力
    function hamburger_title( $title ) {
        if ( is_front_page() && is_home() ) { //トップページなら
            $title = get_bloginfo( 'name', 'display' );
        } elseif ( is_singular() ) { //シングルページなら
            $title = single_post_title( '', false );
        }
            return $title;
        }
    add_filter( 'pre_get_document_title', 'hamburger_title' );
    
    //CSS や JavaScript の読込
    function hamburger_script() {
        wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.6.1/css/all.css', array(), '5.6.1');
        wp_enqueue_style( 'googlefonts', 'https://fonts.gstatic.com', array());
        wp_enqueue_style('googlemap', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap', array());
        wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0.0');
        wp_enqueue_style('hamburger', get_template_directory_uri() . '/css/hamburger.css', array(), '1.0.0');
        wp_enqueue_script('jQuery', 'https://code.jquery.com/jquery-3.5.1.min.js', array(), '3.5.1', true);
        wp_enqueue_script('sidebar-script', get_template_directory_uri() . '/js/sidebar.js', array(), '1.0.0', true);
    }
    //wp_enqueue_scriptsの処理の節目でhamburger_scriptを実行
    add_action( 'wp_enqueue_scripts', 'hamburger_script');

    function hamberger_setup_theme() {
        //メニューを登録する
        register_nav_menu( 'footer-navigation', 'Footer navigation' );

        //アイキャッチ画像の有効化
        add_theme_support('post-thumbnails');//サムネイル画像のサポートを許可する
        set_post_thumbnail_size(760, 300, true);
    }
    add_action('after_setup_theme', 'hamberger_setup_theme');
    
    //サイドバーを登録する
    function whitesnow_widgets_init() {
        // Register main sidebar
        register_sidebar( array(
          'name'          => 'Main Sidebar',//サイドバーの名前
          'id'            => 'sidebar-main',//サイドバーのID
          'description'   => 'Add widgets you want to display in sidebar.',//サイドバーの説明文
          'before_widget' => '<section id="%1$s" class="widget %2$s">',//ウィジットの前に表示する文字列
          'after_widget'  => '</section>',//ウィジットの後に表示する文字列
          'before_title'  => '<h5 class="widget-title">',//ウィジットのタイトルの前に表示する文字列
          'after_title'   => '</h5>',//ウィジットのタイトルの後に表示する文字列
        ) );
      }
      
      add_action( 'widgets_init', 'whitesnow_widgets_init' );

