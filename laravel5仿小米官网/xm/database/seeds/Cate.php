<?php

use Illuminate\Database\Seeder;

class Cate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cates = [
            '手机 平板'=>["小米手机5", "小米Max", "小米手机4c", "红米Note 3", "红米手机3S", "红米手机3", "小米平板2", "合约机", "定制版手机", "对比手机", "小米移动 电话卡",],
            '电视 盒子'=>["小米平板2  64GB Windows版", "小米电视3S 43英寸", "小米电视3S 48英寸", "小米电视3 55英寸", "小米电视3 60英寸", "小米电视3S 65英寸 曲面", "小米电视3 70英寸", "小米盒子mini版", "小米盒子3", "小米盒子3 增强版", ],
            '智能 硬件'=>["小米低音炮", "蓝牙手柄", "家庭音响", "电视盒子配件", "小米无人机", "小米路由器", "九号平衡车", "米家压力IH电饭煲", "米家恒温电水壶", "米兔儿童电话手表", "血压计", "净化器及滤芯", "净水器及滤芯", "摄像机", "智能灯", "智能家庭组合", "手环及配件", "体重秤", "WiFi放大器", "全部智能硬件",],
            '电源 线板'=>["小米移动电源", "小米插线板", "品牌移动电源", "移动电源附件","智能插座 基础版",],
            '耳机 音箱'=>["小米头戴式耳机", "小米圈铁耳机", "小米胶囊耳机", "小米活塞耳机 基础版", "小米蓝牙耳机", "品牌耳机", "小米蓝牙音箱", "小米随身蓝牙音箱", "小钢炮音箱 2", "小钢炮音箱 青春版", "小米方盒子音箱", "网络收音机", "品牌音箱",],
            '电池 存储卡'=>["电池", "充电器", "线材", "存储卡", "彩虹5号电池", "彩虹7号电池",],
            '保护套 后盖'=>["保护套/保护壳", "后盖", ],
            '其他配件'=>[ "贴膜","自拍杆", "贴纸", "防尘塞", "手机支架", "随身WiFi",],
            '米兔 服饰'=>["米兔", "服装", "变形金刚特别版声波",],
            '其他 周边'=>["箱包", "90分旅行箱", "小米鼠标垫", ],
        ];
        $a = 0;
        foreach ($cates as $key => $value) {
            $cate = new \App\Cate();
            $cate -> name = $key;
            $cate -> pid = '0';
            $cate -> path = '0';
            $cate -> status = 1;
            $cate -> save();
            $a++;
            $b = 0;
            foreach ($value as $k => $v) {
                $cate = new \App\Cate();
                $cate -> name = $v;
                $cate -> pid = '1';
                $cate -> path = '0,'.$a;
                $cate -> status = 1;
                $cate -> save();
                $b++;
            }
            $a += $b;
        }


        $array = [
            "",
            "//c1.mifile.cn/f/i/15/goods/list/mi5list140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/maxbar140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/mi4c!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/note3!70x70.jpg",
            "http://c1.mifile.cn/f/i/g/2015/video/hm3s140x140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/hongmi3!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/pad2.png",
            "//c1.mifile.cn/f/i/15/goods/list/heyue!70x70.jpg",
            "http://c1.mifile.cn/f/i/g/2015/video/3X140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/compare!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/mimobile!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/15/goods/list/43140list!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/mitv3s48!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/tv355!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/tv60!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/65140list!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/tv701.png",
            "//c1.mifile.cn/f/i/15/goods/list/tvzj!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/hezizengqiang140list!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/hezis!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/hezimini!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/15/goods/list/diyinpao!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/shb!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/zuheyinxiang140list!70x70.jpg",
            "",
            "http://c1.mifile.cn/f/i/g/2015/video/wurenji140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/luyouqi-120!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/sidebar/scooter!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/dianfanbao-120!70x70.jpg",
            "http://c1.mifile.cn/f/i/g/2015/video/shuihu140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/shoubiao3-140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/xueyaji-140!70x70.jpg",
            "http://c1.mifile.cn/f/i/g/2015/video/jinghuaqilvxin140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/jingshuiqiandlvxin-140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/xiaoyi!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/zhinengdeng-140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/zhinengjiatingtaozhuang-140!70x70.jpg",
            "http://c1.mifile.cn/f/i/g/2015/video/shouhuan2140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/scale!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/wifiplus!70x70.jpg",
            "//c1.mifile.cn/f/i/g/doodle/znyjdaohang!70x70.jpg",
            "http://c1.mifile.cn/f/i/15/goods/list/scoket140list!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/15/goods/list/powerstrip!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/pinpaidianyuan!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/dianyuanfujian!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/15/goods/list/headphone!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/headphone!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/quantie!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/jiaonang140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/jichuban-140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/bluetoothheadset!70x70.jpg",
            "http://c1.mifile.cn/f/i/g/2015/video/pinpai140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/pocketaudio.png",
            "//c1.mifile.cn/f/i/g/2015/cn-index/suishen-140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/xiaogangpao2-hei-160!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/qignchungangpao-140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/fanghezi!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/radio140list!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/pinpaiyinxiang!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/g/2015/video/charger140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/chongdianqi-140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/xiancai!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/cunchu!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/5Battery2!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/7Battery2!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/15/goods/list/baohutao!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/hougai!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/15/goods/list/tiemo!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/zipaigan!70x70.jpg",
            "http://c1.mifile.cn/f/i/g/2015/video/tiezhi140!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/fangchen!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/zhijia!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/wifi!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/g/2015/cn-index/mitu-140!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/fuzhuang-120!70x70.jpg",
            "http://c1.mifile.cn/f/i/g/2015/video/bianxing140!70x70.jpg",
            "",
            "//c1.mifile.cn/f/i/g/2015/cn-index/xiangbao-120!70x70.jpg",
            "//c1.mifile.cn/f/i/15/goods/list/lvxingxiang!70x70.jpg",
            "//c1.mifile.cn/f/i/g/2015/cn-index/shubiaodian-120!70x70.jpg",

        ];

        $a = 1;
        foreach ($array as $key => $value) {
            $cate = \App\Cate::find($a);
            $cate -> img = $value;
            $cate -> save();
            $a++;
        }

    }
}
