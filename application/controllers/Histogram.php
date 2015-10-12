<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . 'core/LO_Controller.php' );

class Histogram extends LO_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    public function __get_content()
    {
        //生成标签
        $labelsRed = '';
        $labelsBlue = '';
        for ($index=1; $index<=33; $index++)
        {
            if ($index != 1) $labelsRed .= ',';
            $labelsRed .= $index;
        }
        for ($index=1; $index<=16; $index++)
        {
            if ($index != 1) $labelsBlue .= ',';
            $labelsBlue .= $index;
        }
        //生成频数
        $countersCSVRed = '';
        $countersCSVBlue = '';
        for ($index=1; $index<=33; $index++)
        {
            if ($index != 1) $countersCSVRed .= ',';
            $countersCSVRed .= $this->counter[$index];
        }
        for ($index=1; $index<=16; $index++)
        {
            if ($index != 1) $countersCSVBlue .= ',';
            $countersCSVBlue .= $this->counter[100+$index];
        }
        
        $data = array(
            'labelsRed' => $labelsRed,
            'countersRed' => $countersCSVRed,
            'labelsBlue' => $labelsBlue,
            'countersBlue' => $countersCSVBlue
        );
        return $this->parser->parse('histogram_content', $data, TRUE);
    }
    
    public function __get_active_menu_item()
    {
        return 'histogram';
    }
    
    public function __get_page_name()
    {
        return '频数直方图';
    }
}
