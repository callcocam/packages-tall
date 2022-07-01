<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Menus;

use Countable;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Arr;
use Illuminate\View\Factory as ViewFactory;

class MenuBuilder implements Countable
{
    /**
     * Menu name.
     *
     * @var string
     */
    protected $menu;

    /**
     * Array menu items.
     *
     * @var array
     */
    protected $items = [];


    /**
     * Prefix URL.
     *
     * @var string|null
     */
    protected $prefixUrl;

    /**
     * The name of view presenter.
     *
     * @var string
     */
    protected $view = 'menus::tailwind.sidebar';

    /**
     * The laravel view factory instance.
     *
     * @var \Illuminate\View\Factory
     */
    protected $views;

    /**
     * Determine whether the ordering feature is enabled or not.
     *
     * @var boolean
     */
    protected $ordering = false;

    /**
     * Resolved item binding map.
     *
     * @var array
     */
    protected $bindings = [];
    /**
     * @var Repository
     */
    private $config;

    /**
     * Constructor.
     *
     * @param string $menu
     * @param Repository $config
     */
    public function __construct($menu, Repository $config)
    {
        $this->menu = $menu;
        $this->config = $config;
    }

    /**
     * Get menu name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->menu;
    }

    /**
     * Find menu item by given its title.
     *
     * @param  string        $title
     * @param  callable|null $callback
     * @return mixed
     */
    public function whereTitle($title, callable $callback = null)
    {
        $item = $this->findBy('title', $title);

        if (is_callable($callback)) {
            return call_user_func($callback, $item);
        }

        return $item;
    }

    /**
     * Find menu item by given key and value.
     *
     * @param  string $key
     * @param  string $value
     * @return \Tall\Menus\MenuItem
     */
    public function findBy($key, $value)
    {
        return collect($this->items)->filter(function ($item) use ($key, $value) {
            return $item->{$key} == $value;
        })->first();
    }

    /**
     * Set view factory instance.
     *
     * @param ViewFactory $views
     *
     * @return $this
     */
    public function setViewFactory(ViewFactory $views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Set view.
     *
     * @param string $view
     *
     * @return $this
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Set Prefix URL.
     *
     * @param string $prefixUrl
     *
     * @return $this
     */
    public function setPrefixUrl($prefixUrl)
    {
        $this->prefixUrl = $prefixUrl;

        return $this;
    }

    

      /**
     * Set the resolved item bindings
     *
     * @param array $bindings
     * @return $this
     */
    public function setBindings(array $bindings)
    {
        $this->bindings = $bindings;

        return $this;
    }

    /**
     * Resolves a key from the bindings array.
     *
     * @param  string|array $key
     * @return mixed
     */
    public function resolve($key)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $key[$k] = $this->resolve($v);
            }
        } elseif (is_string($key)) {
            $matches = array();
            preg_match_all('/{[\s]*?([^\s]+)[\s]*?}/i', $key, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                if (array_key_exists($match[1], $this->bindings)) {
                    $key = preg_replace('/' . $match[0] . '/', $this->bindings[$match[1]], $key, 1);
                }
            }
        }

        return $key;
    }

     /**
     * Check if the menu exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return collect($this->items)->filter(function ($item) use($name){
            return $item->title == $name;
        })->first();
    }

     /**
     * Get instance of the given menu if exists.
     *
     * @param string $name
     *
     * @return string|null
     */
    public function instance($name)
    {
        return $this->has($name) ? $this->items[$name] : null;
    }

    /**
     * Resolves an array of menu items properties.
     *
     * @param  array  &$items
     * @return void
     */
    protected function resolveItems(array &$items)
    {
        $resolver = function ($property) {
            return $this->resolve($property) ?: $property;
        };

        $totalItems = count($items);
        $data = collect($items)->map(function ($item) {
            return $item->title;
        })->unique()->all();

        foreach($data as $title){
            $data = collect($items)->filter(function ($item) use($title){
                return $item->title == $title;
            })->all();
        }
       

        for ($i = 0; $i < $totalItems; $i++) {
           
            $items[$i]->fill(array_map($resolver, $items[$i]->getProperties()));
        }
       
    }

    /**
     * Add new child menu.
     *
     * @param array $attributes
     *
     * @return \Tall\Menus\MenuItem
     */
    public function add(array $attributes = array())
    {
        $item = MenuItem::make($attributes);

        $this->items[] = $item;

        return $item;
    }

    /**
     * Create new menu with dropdown.
     *
     * @param $title
     * @param callable $callback
     * @param array    $attributes
     *
     * @return $this
     */
    public function dropdown($title, \Closure $callback, $order = null, array $attributes = array())
    {
        $properties = compact('title', 'order', 'attributes');

        if (func_num_args() == 3) {
            $arguments = func_get_args();

            $title = Arr::get($arguments, 0);
            $attributes = Arr::get($arguments, 2);

            $properties = compact('title', 'attributes');
        }

        $item = MenuItem::make($properties);

        call_user_func($callback, $item);

        $this->items[] = $item;

        return $item;
    }

    /**
     * Register new menu item using registered route.
     *
     * @param $route
     * @param $title
     * @param array $parameters
     * @param array $attributes
     *
     * @return static
     */
    public function route($route, $title, $parameters = array(), $order = null, $attributes = array())
    {
        if (func_num_args() == 4) {
            $arguments = func_get_args();
            return $this->add([
                'route' => [Arr::get($arguments, 0), Arr::get($arguments, 2)],
                'title' => Arr::get($arguments, 1),
                'attributes' => Arr::get($arguments, 4),
                'order' => Arr::get($arguments, 3),
            ]);
        }
        $route = array($route, $parameters);

        $item = MenuItem::make(compact('route', 'title', 'parameters', 'attributes', 'order'));

        $this->items[] = $item;

        return $item;
    }

    /**
     * Format URL.
     *
     * @param string $url
     *
     * @return string
     */
    protected function formatUrl($url)
    {
        $uri = !is_null($this->prefixUrl) ? $this->prefixUrl . $url : $url;

        return $uri == '/' ? '/' : ltrim(rtrim($uri, '/'), '/');
    }

    /**
     * Register new menu item using url.
     *
     * @param $url
     * @param $title
     * @param array $attributes
     *
     * @return static
     */
    public function url($url, $title, $order = 0, $attributes = array())
    {
        if (func_num_args() == 3) {
            $arguments = func_get_args();

            return $this->add([
                'url' => $this->formatUrl(Arr::get($arguments, 0)),
                'title' => Arr::get($arguments, 1),
                'attributes' => Arr::get($arguments, 2),
            ]);
        }

        $url = $this->formatUrl($url);

        $item = MenuItem::make(compact('url', 'title', 'order', 'attributes'));

        $this->items[] = $item;

        return $item;
    }

    /**
     * Add new divider item.
     *
     * @param int $order
     * @return \Tall\Menus\MenuItem
     */
    public function addDivider($order = null)
    {
        $this->items[] = new MenuItem(array('name' => 'divider', 'order' => $order));

        return $this;
    }

    /**
     * Add new header item.
     *
     * @return \Tall\Menus\MenuItem
     */
    public function addHeader($title, $order = null)
    {
        $this->items[] = new MenuItem(array(
            'name' => 'header',
            'title' => $title,
            'order' => $order,
        ));

        return $this;
    }

    /**
     * Alias for "addHeader" method.
     *
     * @param string $title
     *
     * @return $this
     */
    public function header($title)
    {
        return $this->addHeader($title);
    }

    /**
     * Alias for "addDivider" method.
     *
     * @return $this
     */
    public function divider()
    {
        return $this->addDivider();
    }

    /**
     * Get items count.
     *
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Empty the current menu items.
     */
    public function destroy()
    {
        $this->items = array();

        return $this;
    }

    /**
     * Render the menu to HTML tag.
     *
     * @param string $presenter
     *
     * @return string
     */
    public function render($presenter = null)
    {
        $this->resolveItems($this->items);

        return $this->renderView($presenter);
    }

    /**
     * Render menu via view presenter.
     *
     * @return \Illuminate\View\View
     */
    public function renderView($presenter = null)
    {
        return $this->views->make($presenter ?: $this->view, [
            'items' => $this->getOrderedItems(),
        ]);
    }

    /**
     * Get original items.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get menu items as laravel collection instance.
     *
     * @return \Illuminate\Support\Collection
     */
    public function toCollection()
    {
        return collect($this->items);
    }

    /**
     * Get menu items as array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->toCollection()->toArray();
    }

    /**
     * Enable menu ordering.
     *
     * @return self
     */
    public function enableOrdering()
    {
        $this->ordering = true;

        return $this;
    }

    /**
     * Disable menu ordering.
     *
     * @return self
     */
    public function disableOrdering()
    {
        $this->ordering = false;

        return $this;
    }

    /**
     * Get menu items and order it by 'order' key.
     *
     * @return array
     */
    public function getOrderedItems()
    {
        if (config('menus.ordering') || $this->ordering) {
            return $this->toCollection()->sortByDesc(function ($item) {
                return $item->order;
            })->all();
        }

        return $this->items;
    }

  
}
