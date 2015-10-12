<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $jsLibraries;
    protected $cssLibraries;
    
    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        
        $jsLibraries = array();
        $cssLibraries = array();
    }
    
    public function __get_content()
    {
        $data = array();
        return '';
    }
    
    public function __get_active_menu_item()
    {
        return '';
    }
    
    public function __addJsLibrary($name, $version, $path)
    {
        $this->jsLibraries[] = array(
            'jsName' => $name,
            'jsVersion' => $version,
            'jsPath' => $path
        );
    }
    
    public function __addCssLibrary($name, $version, $path)
    {
        $this->cssLibraries[] = array(
            'cssName' => $name,
            'cssVersion' => $version,
            'cssPath' => $path
        );
    }
    
    public function __addLibraries()
    {
    }
    
    public function __get_page_name()
    {
    }
    
    public function __get_sidebar()
    {
        $data = array(
            'histogram' => '直方图'
        );
        //TODO 设置公共侧边栏（文本与链接）
        $subscriptIndex = "active_" . $this->__get_active_menu_item();
        $data[ $subscriptIndex ] = 'active';
        return $this->parser->parse('sidebar', $data, TRUE);
    }
    
    public function __get_header()
    {
        $data = array();
        return $this->parser->parse('header', $data, TRUE);
    }

    public function index()
    {
        $header = $this->__get_header();
        $sidebar = $this->__get_sidebar();
        $content = $this->__get_content();
        
        //TODO 从config获取
        $data = array(
            'application' => 'Lottery Observer',
            'version' => '0.0.1-SNAPSHOT',
            'company' => 'UND软件基金会',
            'company_link' => 'http://www.undsf.com'
        );
        $footer = $this->parser->parse('footer', $data, TRUE);
        
        //css
        $this->__addCssLibrary('Bootstrap', '3.3.5', '/assets/bootstrap/css/bootstrap.min.css');
        $this->__addCssLibrary('Font Awesome', '4.4.0', '/assets/font-awesome/css/font-awesome.min.css');
        $this->__addCssLibrary('AdminLTE', '2.3.0', '/assets/AdminLTE/dist/css/AdminLTE.min.css');
        $this->__addCssLibrary('AdminLTE Skins', 'blue', '/assets/AdminLTE/dist/css/skins/skin-blue.min.css');
        //js
        $this->__addJsLibrary('jQuery', '2.1.4', '/assets/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js');
        $this->__addJsLibrary('Bootstrap', '3.3.5', '/assets/bootstrap/js/bootstrap.min.js');
        $this->__addJsLibrary('AdminLTE', '2.3.0', '/assets/AdminLTE/dist/js/app.min.js');
        
        $this->__addLibraries();
        
        $data = array(
            'page_name' => $this->__get_page_name(),
            'header' => $header,
            'sidebar' => $sidebar,
            'content' => $content,
            'footer' => $footer,
            'cssLibraries' => $this->cssLibraries,
            'jsLibraries' => $this->jsLibraries
        );
        $this->parser->parse('framework', $data);
    }
}
