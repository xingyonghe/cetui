@extends('member.layouts.base')
@section('style')
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            highlight_subnav("{{ route('member.account.notes') }}");
        })
    </script>
@endsection
@section('body')
    <!--container start-->
    <div class="container">
        <div class="row">
            @include('member.layouts.nav')
            <div class="col-lg-10 col-sm-10">
                <h5 class="member-title">提现记录</h5>
                <div class="contact-form">
                    @if($lists->total())
                        <table class="table table-striped sortable">
                            <thead>
                            <tr>
                                <th>流水号</th>
                                <th>金额</th>
                                <th>收支类型</th>
                                <th>时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $data)
                                <tr>
                                    <td>{{ $data->order_id }}</td>
                                    <td>{{ $data->money }}</td>
                                    <td>{{ $data->type_text }}</td>
                                    <td>{{ $data->crteated_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $lists->render() !!}
                        </div>
                    @else
                        <table class="table table-striped sortable">
                            <thead>
                            <tr>
                                <th>头像</th>
                                <th>昵称</th>
                                <th>直播平台</th>
                                <th>平台ID</th>
                                <th>时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="7">抱歉，您还没有任何收支记录</td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--container end-->
@endsection
