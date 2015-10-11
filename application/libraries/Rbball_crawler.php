<?php
/**
 * Created by PhpStorm.
 * User: Arathi
 * Date: 2015/10/11
 * Time: 16:14
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once( APPPATH . 'third_party/simple_html_dom.php' );

class Rbball_crawler
{
    public $doc;
    public $urlFormat;
    public $lastPage;

    public $drawResults;

    public function __construct(){
        $this->doc = new simple_html_dom();
        $this->urlFormat = 'http://kaijiang.zhcw.com/zhcw/html/ssq/list_%d.html';
        $this->drawResults = array();
    }

    public function crawl_page($page, $updateLastPage = FALSE)
    {
        $page_url = sprintf($this->urlFormat, $page);
        $this->doc->load_file($page_url);

        $table = $this->doc->find('table.wqhgt', 0);
        $trs = $table->find('tr');
        $trAmount = count($trs);

        $drawResultsInPage = array();

        for ($index = 2; $index < $trAmount - 1; $index++)
        {
            $tr = $trs[ $index ];
            $drawResult = $this->get_draw_result($tr);
            $drawResultsInPage[ $drawResult['id'] ] = $drawResult;
        }

        if ($updateLastPage==TRUE || $this->lastPage <= 0)
        {
            //pg
            $tr = $trs[$trAmount-1];
            $p = $tr->find('.pg', 0);
            $text = $p->plaintext;
            $pattern = "/.*?(\\d+).*?/";
            //echo $text;
            //echo '<br/>';
            if (preg_match($pattern, $text, $matches) != 0)
            {
                $this->lastPage = $matches[1];
                echo "设置最后一页的ID为" . $this->lastPage;
                echo '<br/>';
            }
        }

        $this->doc->clear();

        $this->drawResults = array_merge( $this->drawResults, $drawResultsInPage );
        return $drawResultsInPage;
    }

    public function get_draw_results()
    {
        return $this->drawResults;
    }

    public function get_last_draw_result()
    {
        if (is_array($this->drawResults))
        {
            $resultAmount = count($this->drawResults);
            if ($resultAmount > 0)
            {
                return $this->drawResults[$resultAmount-1];
            }
        }
        return NULL;
    }

    public function get_last_id()
    {
        $lastDrawResult = get_last_draw_result();
        if ($lastDrawResult == NULL)
        {
            return 0;
        }
        return $lastDrawResult['id'];
    }

    public function get_last_page()
    {
        return $this->lastPage;
    }

    function get_draw_result($tr)
    {
        //tds[0] 开奖日期
        //tds[1] 期号
        //tds[2] 中奖号码
        //  ems[0] 红球1
        //  ems[1] 红球2
        //  ems[2] 红球3
        //  ems[3] 红球4
        //  ems[4] 红球5
        //  ems[5] 红球6
        //  ems[6] 蓝球
        //tds[3] 销售额(有逗号格式)
        $tds = $tr->find('td');
        $drawDate = $tds[0]->plaintext;
        $id = $tds[1]->plaintext;
        $ems = $tds[2]->find('em');
        $redBalls = array();
        $redBalls[0] = $ems[0]->plaintext;
        $redBalls[1] = $ems[1]->plaintext;
        $redBalls[2] = $ems[2]->plaintext;
        $redBalls[3] = $ems[3]->plaintext;
        $redBalls[4] = $ems[4]->plaintext;
        $redBalls[5] = $ems[5]->plaintext;
        $blueBall = $ems[6]->plaintext;
        $salesVolume = $tds[3]->plaintext;
        //$salesVolume去掉逗号
        $salesVolume = str_replace(",", "", $salesVolume);

        $drawResult = array(
            'id' => $id,
            'draw_date' => $drawDate,
            'red_ball_1' => $redBalls[0],
            'red_ball_2' => $redBalls[1],
            'red_ball_3' => $redBalls[2],
            'red_ball_4' => $redBalls[3],
            'red_ball_5' => $redBalls[4],
            'red_ball_6' => $redBalls[5],
            'blue_ball' => $blueBall,
            'sales_volume' => $salesVolume
        );
        return $drawResult;
    }
}
