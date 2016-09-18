<?php
namespace Alicecore\Handle;

use Symfony\Component\Routing\Generator\UrlGenerator;

class PaginatorHandler
{
    protected $page;
    protected $args;
    protected $routeName;
    protected $urlGenerator;

    public function __construct($page, $routeName, UrlGenerator $urlGenerator, $args)
    {
        $this->args = $args ? $args : [];
        $this->page = $page;
        $this->routeName = $routeName;
        $this->urlGenerator = $urlGenerator;
    }

    public function pageNavIndex($total, $pagesize)
    {
        if($total < 1 || $total<=$pagesize)
            return '';

        $baseurl = $this->urlGenerator->generate($this->routeName, $this->args);
        $pages = ceil($total/$pagesize);
        $page = min($pages, $this->page);
        $pagenav = '<div class="pagination"><ul>';
        $pagenav .= ($page-1) ? "<li class=\"prev-page\"><a href='$baseurl'>首页</a></li>" : '';
        for($i=-10; $i<=10; $i++){
            $pageTmp = $page+$i;
            $url = $this->urlGenerator->generate($this->routeName, array_merge($this->args, ['page' => $pageTmp]));
            if($pageTmp < 1 || $pageTmp > $pages)
                continue;
            if($i != 0){
                $pagenav .= ($pageTmp == 1 ? "<li><a href='$baseurl'>$pageTmp</a></li>" : "<li><a href='$url'>$pageTmp</a></li>");
            }else if($i == 0){
                $pagenav .= "<li class='active'><a href='$url'>$pageTmp</a></li>";
            }
        }
        $url = $this->urlGenerator->generate($this->routeName, array_merge($this->args, ['page' => $pages]));
        $pagenav .= $page == $pages ? "<li><span>共".$pages."页</span></li></ul></div>":"<li class=\"next-page\"><a href='$url'>尾页</a></li><li><span>共 ".$pages." 页</span></li></ul></div>";

        return $pagenav;
    }
}