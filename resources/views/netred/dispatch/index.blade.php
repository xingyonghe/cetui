@extends('netred.layouts.base')
@section('styles')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){

        })
    </script>
@endsection
@section('body')
    <div class="inner_c">
        <div class="touyy">
            <div class="tou_nav">
                <ul>
                    <li><a href="#">最新活动</a></li>
                    <li><a href="#">已参加活动</a></li>
                    <li class="end"><a href="#">邀请我参加的活动</a></li>
                </ul>
            </div>
            <div class="xiala">
                <table width="100%" border="0" cellspacing="5">
                    <tbody>
                    <tr>
                        <td align="right">排序：</td>
                        <td align="left"><select name="select" id="select">
                                <option>倒序</option>
                            </select></td>
                        <td align="right">产品类型：</td>
                        <td align="left"><select name="select2" id="select2">
                                <option>产品类型1</option>
                            </select></td>
                        <td align="right">投放类型：</td>
                        <td align="left"><select name="select3" id="select3">
                                <option>产品投放11</option>
                            </select></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="qingchu"></div>
        </div>
        @foreach($lists as $key=>$item)
            <div class="project">

                <div class="tg">
                    <div class="fl">
                        <h5><span>{{ $item['title'] }}</span></h5>
                    </div>
                    <div class="fr">
                        <img src="member/images/clock.png"/>起始日期：{{ $item['start_time']->format('Y年m月d日') }}
                        <b>一</b>
                        <img src="member/images/clock.png"/>结束日期：{{ $item['end_time']->format('Y年m月d日') }}
                    </div>
                </div>
                <div class="tupian fl">
                    <img src="{{ $item['logo'] }}" width="235" height="204"/>
                    <p><input type="button" value="我要参加" style="background-color:#ff6476" /></p>
                </div>
                <div class="introduce fl">
                    <table>
                        <tr>
                            <td width="300"><label>赏金：</label>{{ $item['money'] }}元</td>
                            <td width="300"><label>投放类型：</label>{{ $task_type_arr[$item['type']] }}</td>
                            <td width="300"><label>投放平台：</label>{{ $item['id'] }}</td>
                        </tr>
                        <tr>
                            <td width="300"><label>产品类型：</label>{{ $item['id'] }}</td>
                            <td width="300"><label>需要人数：</label>{{ $item['num'] }}人</td>
                            <td width="300"><label>广告形式：</label>{{ $item['id'] }}</td>
                        </tr>
                    </table>
                    <div class="duanluo">
                        <p><span>网红要求：</span>{{ $item['demand'] }}</p>
                        <p><span>活动要求：</span>{{ $item['notes'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="qingchu"></div>
        <div id="showpage" class="cpage">
            {{--{!! $lists->render() !!}--}}
        </div>
    </div>
    <div class="qingchu"></div>
@endsection
