<?php
/*
|--------------------------------------------------------------------------
| SEO class
| @author xingyonghe
| @date 2016-11-22
|--------------------------------------------------------------------------
|
| SEO类库
|
*/
namespace App\Libraries\Seo;

class SEO
{
    protected $title = '';
    protected $keywords = '';
    protected $description = '';
    protected $variables = [];//变量
    protected $key = '';

    /**
     * 设置 title
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * 设置 keywords
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param string $keywords
     * @return $this
     */
    public function setKeywords(string $keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * 设置 description
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * 设置SEO规则,管理后台设置规则
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param string $callKey
     * @return $this
     */
    public function setRule(string $key)
    {
        $this->key = strtoupper($key);
        return $this;
    }

    /**
     * 单个设置变量
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param string $variableName
     * @param string $value
     * @return $this
     */
    public function setVariable(string $variableName, string $value)
    {
        $this->variables[strtolower($variableName)] = $value;
        return $this;
    }

    /**
     * 批量设置变量
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param array $variables
     * @return $this
     */
    public function setVariables(array $variables)
    {
        foreach ($variables as $variableName => $variableValue){
            $this->setVariable($variableName,$variableValue);
        }
        return $this;
    }

    /**
     * 生成TDK HTML
     * @author: xingyonghe
     * @date: 2016-11-22
     * @return string
     */
    public  function generate()
    {
        $this->compile();
        return sprintf('<title>%s</title>' . PHP_EOL
            . '    <meta name="keywords" content="%s">'. PHP_EOL
            . '    <meta name="description" content="%s">'. PHP_EOL ,
            $this->title,
            $this->description,
            $this->keywords
        );
    }

    /**
     * 把SEO中的变量替换
     * @author: xingyonghe
     * @date: 2016-11-22
     * @param string $key
     */
    protected function compile()
    {
        if (empty($this->key)) {
            return;
        }
        $pattens = [];
        $replacements = [];
        foreach ($this->variables as $variableName => $variableValue) {
            $pattens[] = '~\{'.$variableName.'\}~is';
            $replacements[] = $variableValue;
        }

        $pattens[] = '~\{.*?\}~is';
        $replacements[] = '';
        $this->setTitle(preg_replace($pattens, $replacements , $this->title));
        $this->setKeywords(preg_replace($pattens, $replacements , $this->keywords));
        $this->setDescription(preg_replace($pattens, $replacements , $this->description));
        return;
    }
}