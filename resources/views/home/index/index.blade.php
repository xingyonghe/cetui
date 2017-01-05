@extends('home.layouts.base')
@section('styles')
    <link href="{{ asset('home/css/slider.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
    <script type='text/javascript' src="{{ asset('home/js/common.js') }}"></script>
    <script type='text/javascript' src="{{ asset('home/js/slider.js') }}"></script>
    <script type="text/javascript">
        $(function(){

        });
    </script>
@endsection
@section('body')
    <!--S顶部-->
    <div class="header-content home">
        @include('home.layouts.head')
        <div class="parallax-bg" id="slider-wrap">
            <div class="slider parallax-bg" id="slider">
                <div class="slider-sections sandbox">
                    <section class="first">
                        <div class="text" style="padding-top: 10px;"><h2>专业的网红自媒体广告投放平台</h2>
                            <p class="copy">精准营销从此开始</p>
                            <p class="button"><a href="{{ route('netred.login.form') }}">网络入住</a></p>
                            <p class="button"><a href="{{ route('ads.login.form') }}">广告投放</a></p>
                        </div>
                    </section>
                    <section>
                        <div class="text" style="padding-top: 10px;"><h2>专业的网红自媒体广告投放平台22</h2>
                            <p class="copy">单页面、单广告等模块。</p>
                            <p class="button">
                                <a href="http://www.lanrentuku.com/" onclick="_gaq.push(['_trackPageview', 'http://www.lanrentuku.com/']);">Download</a>
                                <a class="dimmed" onclick="_gaq.push(['_trackPageview', 'http://www.lanrentuku.com/']);" href="http://www.lanrentuku.com/">Learn
                                                                                                                                                           More</a>
                            </p></div>
                    </section>
                    <section>
                        <div class="text"><h2>专业的网红自媒体广</h2>
                            <p class="copy">全站生成纯静态页。</p>
                            <p class="button">
                                <a href="http://www.lanrentuku.com/" onclick="_gaq.push(['_trackPageview', 'http://www.lanrentuku.com/']);">Download</a>
                                <a class="dimmed" onclick="_gaq.push(['_trackPageview', 'http://www.lanrentuku.com/']);" href="http://www.lanrentuku.com/">Learn
                                                                                                                                                           More</a>
                            </p></div>
                    </section>
                </div>
            </div>
            <a class="slider-prev" href="javascript: void(0)">?</a>
            <a class="slider-next" href="javascript: void(0)"></a>
        </div>

    </div>
    <div class="qingchu"></div>
    <!--E顶部-->
    <!--S中间-->
    <div class="main">
        <div class="juzhongxia2">
            <div class="biaoti">精品网红资源展示</div>
            <div class="shang">
                @foreach($category as $key=>$item)
                    <div class="zuo">
                        <div class="tuiguang_wang">{{ $item['name'] }}</div>
                        <div class="xiao2">
                            @if(isset($item['_child']) && is_array($item['_child']))
                                @foreach($item['_child'] as $child)
                                    <a href="#">{{ $child['name'] }}</a>
                                @endforeach
                            @endif

                        </div>
                    </div>
                    @if($key < 3)
                        <div class="fengexian"><img src="/home/images/xian.jpg"/></div>
                    @endif
                @endforeach
                <div class="qingchu"></div>
            </div>

        </div>
    </div>
    <!--Emain-->
    <div class="tiantu">
        <div class="juzhongxia2">
            <div class="fenkai">
                <div class="tu">
                    <div class="tupian"><img src="/home/images/tu1.jpg" width="261" ; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">赖美慧</div>
                        <div class="tubiao">
                            <a href="#"><img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69" ; height="28"/></a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2"><img src="/home/images/tou1.jpg" width="36" ; height="36"/></td>
                            </tr>
                            <tr align="center">
                                <td>132159</td>
                                <td>11900次</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tu">
                    <div class="tupian"><img src="/home/images/tu2.jpg" width="261" ; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">赖美慧</div>
                        <div class="tubiao">
                            <a href="#"><img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69" ; height="28"/></a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2"><img src="/home/images/tou2.jpg" width="36" ; height="36"/></td>
                            </tr>
                            <tr align="center">
                                <td>132159</td>
                                <td>11900次</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tu">
                    <div class="tupian"><img src="/home/images/tu3.jpg" width="261" ; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">赖美慧</div>
                        <div class="tubiao">
                            <a href="#"><img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69" ; height="28"/></a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2"><img src="/home/images/tou3.jpg" width="36" ; height="36"/></td>
                            </tr>
                            <tr align="center">
                                <td>132159</td>
                                <td>11900次</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tu2">
                    <div class="tupian"><img src="/home/images/tu4.jpg" width="261" ; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">赖美慧</div>
                        <div class="tubiao">
                            <a href="#"><img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69" ; height="28"/></a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2"><img src="/home/images/tou4.jpg" width="36" ; height="36"/></td>
                            </tr>
                            <tr align="center">
                                <td>132159</td>
                                <td>11900次</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tu">
                    <div class="tupian"><img src="/home/images/tu5.jpg" width="261" ; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">赖美慧</div>
                        <div class="tubiao">
                            <a href="#"><img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69" ; height="28"/></a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2"><img src="/home/images/tou2.jpg" width="36" ; height="36"/></td>
                            </tr>
                            <tr align="center">
                                <td>132159</td>
                                <td>11900次</td>
                            </tr>
                            </tbody>
                        </table>


                    </div>
                </div>

                <div class="tu">
                    <div class="tupian"><img src="/home/images/tu6.jpg" width="261" ; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">赖美慧</div>
                        <div class="tubiao">
                            <a href="#"><img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69" ; height="28"/></a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2"><img src="/home/images/tou2.jpg" width="36" ; height="36"/></td>
                            </tr>
                            <tr align="center">
                                <td>132159</td>
                                <td>11900次</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tu">
                    <div class="tupian"><img src="/home/images/tu7.jpg" width="261" ; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">赖美慧</div>
                        <div class="tubiao">
                            <a href="#"><img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69" ; height="28"/></a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2"><img src="/home/images/tou2.jpg" width="36" ; height="36"/></td>
                            </tr>
                            <tr align="center">
                                <td>132159</td>
                                <td>11900次</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tu2">
                    <div class="tupian"><img src="/home/images/tu8.jpg" width="261" ; height="328"/></div>
                    <div class="order">
                        <div class="mingzi">赖美慧</div>
                        <div class="tubiao">
                            <a href="#"><img src="/home/images/anniu.png" onMouseOver="this.src='/home/images/anniu.png'" onMouseOut="this.src='/home/images/anniu.png'" width="69" ; height="28"/></a>
                        </div>
                    </div>
                    <div class="fen">
                        <table width="252" border="0" cellspacing="5">
                            <tbody>
                            <tr>
                                <td align="center">粉丝</td>
                                <td align="center">平均播放数</td>
                                <td width="36" rowspan="2"><img src="/home/images/tou2.jpg" width="36" ; height="36"/></td>
                            </tr>
                            <tr align="center">
                                <td>132159</td>
                                <td>11900次</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="qingchu"></div>
        </div>
    </div>
    <!--Scentre-->
    <div class="centre">
        <div class="juzhongxia2">
            <div class="biaoti">平台优势</div>
            <div class="fenkai">
                <div class="biao">
                    <div class="tupp"><img src="/home/images/biao1.png"/></div>
                    <div class="dazib">丰富</div>
                    <div class="wenziw">丰富的推广资源，数以万计的主播
                                        艺人资源，覆盖各行各业各种垂直
                                        领域
                    </div>
                </div>
                <div class="biao">
                    <div class="tupp"><img src="/home/images/biao2.png"/></div>
                    <div class="dazib">专业</div>
                    <div class="wenziw">专业的大数据运营团队，有针对性
                                        的为各类广告客户提供切实可行的
                                        推广营销方案
                    </div>
                </div>
                <div class="biao">
                    <div class="tupp"><img src="/home/images/biao3.png"/></div>
                    <div class="dazib">安全</div>
                    <div class="wenziw">平台第三方托管资金，确保资金安
                                        全，让广告主安心投放，网红也不
                                        必担心推广结束后无法获得报酬
                    </div>
                </div>
                <div class="biao2">
                    <div class="tupp"><img src="/home/images/biao4.png"/></div>
                    <div class="dazib">互动</div>
                    <div class="wenziw">告别枯燥乏味的传统广告形式，新<br/>
                                        兴媒体互动式的推广，更有助于用<br/>
                                        户对产品更深入的了解
                    </div>
                </div>
                <div class="qingchu"></div>
            </div>
        </div>

    </div>
    <!--Ecentre-->
    <!--Sbelow-->
    <div class="below">
        <div class="juzhongxia2">
            <div class="biaoti">解决方案</div>
            <div class="bbiao">精准推广，不止是说说而已！</div>
            <div class="fenkai">
                <div class="kuang">
                    <div class="tupp"><img src="/home/images/kuang1.png"/></div>
                    <div class="dazib">独特的标签分析系统</div>
                    <div class="wenziw">性别、兴趣、关注点、年龄分布、消费能力等，运用此类数据，可以精准为广告投放定位人群！</div>
                </div>
                <div class="kuang">
                    <div class="tupp"><img src="/home/images/kuang2.png"/></div>
                    <div class="dazib">独特的标签分析系统</div>
                    <div class="wenziw">性别、兴趣、关注点、年龄分布、消费能力等，运用此类数据，可以精准为广告投放定位人群！</div>
                </div>
                <div class="kuang">
                    <div class="tupp"><img src="/home/images/kuang3.png"/></div>
                    <div class="dazib">独特的标签分析系统</div>
                    <div class="wenziw">性别、兴趣、关注点、年龄分布、消费能力等，运用此类数据，可以精准为广告投放定位人群！</div>
                </div>
                <div class="kuang2">
                    <div class="tupp"><img src="/home/images/kuang4.png"/></div>
                    <div class="dazib">独特的标签分析系统</div>
                    <div class="wenziw">性别、兴趣、关注点、年龄分布、消费能力等，运用此类数据，可以精准为广告投放定位人群！</div>
                </div>
                <div class="qingchu"></div>
            </div>
        </div>

    </div>
    <!--Ebelow-->
    <!--Skehu-->
    <div class="kehu">
        <div class="juzhongxia2">
            <div class="biaoti">我们的客户</div>
            <div class="bbiao">基于专业的大数据分析，为广告主量身打造最为高效的推广方案，因此，以下客户选择了我们！</div>
        </div>
        <div class="wangzhan">
            <div class="qitawangzhan"><a href="#"><img src="/home/images/jd.jpg"/></a>
                <a href="#"><img src="/home/images/1haodian.jpg"/></a> <a href="#"><img src="/home/images/ls.jpg"/></a> <a href="#"><img src="/home/images/taobao.jpg"/></a>
                <a href="#"><img src="/home/images/snyg.jpg"/></a> <a href="#"><img src="/home/images/wph.jpg"/></a>
                <a href="#"><img src="/home/images/jmyp.jpg"/></a> <a href="#"><img src="/home/images/haier.jpg"/></a>
                <a href="#"><img src="/home/images/mi.jpg"/></a> <a href="#"><img src="/home/images/cqly.jpg"/></a>
                <div class="qingchu"></div>
            </div>
        </div>
        <div class="qingchu"></div>
    </div>
    <!--Ekehu-->
@endsection
