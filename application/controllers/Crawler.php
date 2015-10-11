<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crawler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('rbball_crawler');
        $this->load->model('draw_result_model');
    }

    public function index()
    {
        echo "<h2>Crawl Result: </h2>";
        $page = 1;
        $goonCrawl = TRUE;
        do
        {
            $drawResults = $this->rbball_crawler->crawl_page($page);
            //TODO 新抓取的记录如果在数据库中已经存在，那么停止抓取下一页
            $this->draw_result_model->add_draw_results_not_exists($drawResults);
            if (false) break;
            $page++;
        }
        while ($page <= $this->rbball_crawler->get_last_page());

        //$drawResults = $this->rbball_crawler->get_draw_results();
        //echo '抓取' . count($drawResults) . '条开奖结果！';
        //$this->draw_result_model->add_all_draw_results($drawResults);
    }
}
