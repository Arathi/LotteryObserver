<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Histogram extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('draw_result_model');
    }
    
    public function __get_content()
    {
        //TODO 展示直方图
        $counter = array();
        //生成标签
        $labelsRed = '';
        $labelsBlue = '';
        for ($index=1; $index<=33; $index++)
        {
            $counter[ $index ] = 0;
            if ($index != 1) $labelsRed .= ',';
            $labelsRed .= $index;
        }
        for ($index=1; $index<=16; $index++)
        {
            $counter[ 100+$index ] = 0;
            if ($index != 1) $labelsBlue .= ',';
            $labelsBlue .= $index;
        }
        //取出数据
        $drawResults = $this->draw_result_model->get_all_draw_results();
        foreach ($drawResults as $id => $drawResult)
        {
            $counter[$drawResult['red_ball_1']]++;
            $counter[$drawResult['red_ball_2']]++;
            $counter[$drawResult['red_ball_3']]++;
            $counter[$drawResult['red_ball_4']]++;
            $counter[$drawResult['red_ball_5']]++;
            $counter[$drawResult['red_ball_6']]++;
            $counter[$drawResult['blue_ball']+100]++;
        }
        //TODO 生成频数
        $countersCSVRed = '';
        $countersCSVBlue = '';
        for ($index=1; $index<=33; $index++)
        {
            if ($index != 1) $countersCSVRed .= ',';
            $countersCSVRed .= $counter[$index];
        }
        for ($index=1; $index<=16; $index++)
        {
            if ($index != 1) $countersCSVBlue .= ',';
            $countersCSVBlue .= $counter[100+$index];
        }
        
        $data = array(
            'labelsRed' => $labelsRed,
            'countersRed' => $countersCSVRed,
            'labelsBlue' => $labelsBlue,
            'countersBlue' => $countersCSVBlue
        );
        return $this->parser->parse('histogram_content', $data, TRUE);
    }
    
    public function __addLibraries()
    {
        $this->__addJsLibrary('ChartJS', '', '/assets/AdminLTE/plugins/chartjs/Chart.min.js');
        $this->__addJsLibrary('Fast Click', '', '/assets/AdminLTE/plugins/fastclick/fastclick.min.js');
    }
    
    public function __get_active_menu_item()
    {
        return 'histogram';
    }
}
