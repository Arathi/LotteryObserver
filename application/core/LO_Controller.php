<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . 'libraries/Draw_result_rbb.php' );

class LO_Controller extends MY_Controller {
    protected $counter;
    protected $drawResults;
    
    public function __construct(){
        parent::__construct();
        mt_srand();
        $this->load->helper('color');
        $this->load->model('draw_result_model');
        $this->__get_counter();
    }
    
    public function __get_counter()
    {
        $counter = array();
        for ($index=1; $index<=33; $index++) $counter[ $index ] = 0;
        for ($index=1; $index<=16; $index++) $counter[ 100+$index ] = 0;
        $drawResultArrays = $this->draw_result_model->get_all_draw_results();
        $this->drawResults = array();
        foreach ($drawResultArrays as $id => $drawResultArray)
        {
            $drawResult = new Draw_result_rbb($drawResultArray);
            $counter[$drawResult->redBall1]++;
            $counter[$drawResult->redBall2]++;
            $counter[$drawResult->redBall3]++;
            $counter[$drawResult->redBall4]++;
            $counter[$drawResult->redBall5]++;
            $counter[$drawResult->redBall6]++;
            $counter[$drawResult->blueBall+100]++;
            $this->drawResults[$drawResult->id] = $drawResult;
        }
        $this->counter = $counter;
    }
    
    public function __addLibraries()
    {
        //$this->__addJsLibrary('ChartJS', '', '/assets/AdminLTE/plugins/chartjs/Chart.min.js');
        //$this->__addJsLibrary('Fast Click', '', '/assets/AdminLTE/plugins/fastclick/fastclick.min.js');
        $this->__addJsLibrary('ECharts', '2.2.7', '/assets/echarts.min.js');
    }
}
