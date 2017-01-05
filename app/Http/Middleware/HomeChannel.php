<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Channel;

class HomeChannel
{

    public function handle($request, Closure $next)
    {
        view()->share('channels',$this->getChannel());//share()，分享数据给所有视图，参数一代表键，参数二代表值
        return $next($request);
    }

    /**
     * 返回网站导航
     * @return array
     */
    public function getChannel()
    {
        $channel = Channel::where('status',1)
            ->orderBy('sort','asc')
            ->get(['id','title', 'remark','url','sort','status','target'])
            ->toArray();
        return $channel;
    }
}
