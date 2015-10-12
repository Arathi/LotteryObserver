<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LO_Controller extends MY_Controller {
    protected $counter;
    
    public function __construct(){
        parent::__construct();
        $this->load->model('draw_result_model');
        $this->__get_counter();
    }
    
    public function __get_counter()
    {
        $counter = array();
        for ($index=1; $index<=33; $index++) $counter[ $index ] = 0;
        for ($index=1; $index<=16; $index++) $counter[ 100+$index ] = 0;
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
        $this->counter = $counter;
    }
    
    public function __addLibraries()
    {
        $this->__addJsLibrary('ChartJS', '', '/assets/AdminLTE/plugins/chartjs/Chart.min.js');
        $this->__addJsLibrary('Fast Click', '', '/assets/AdminLTE/plugins/fastclick/fastclick.min.js');
    }
}
