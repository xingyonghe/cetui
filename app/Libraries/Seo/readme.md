## TDK使用说明

> 直接使用

```
use SEO;
class ExampleController extends Controller{
    public function index(){
        SEO::setTitle('WEB_INDEX');
        SEO::setKeywords('WEB_INDEX');
        SEO::setDescription('WEB_INDEX');
    }
```
> 使用配置规则

```
use SEO;
class ExampleController extends Controller{
    public function index(){
        SEO::setRule('WEB_INDEX');
        SEO::setVariables([
            'sitename' => '着行搞搞',
            'sitemedia' => '自媒体',
            'siteads' => '广告主'
        ]);
    }
```
> 页面调用

```
{!! SEO::generate() !!}
```
