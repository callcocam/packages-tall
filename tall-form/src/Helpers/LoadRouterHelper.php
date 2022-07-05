<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Form\Helpers;

use Tall\Acl\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class LoadRouterHelper
{

    /**
     * @var array
     */
    private $ignore = ['auth', 'store', 'remove-file', 'auto-route', 'translate', 'profile'];

    /**
     * @var array
     */
    private $required = ['admin','app','list', 'show'];


    public static function make()
    {

        $make = new static();

        return $make->load();
    }

    public static function index()
    {

        $make = new static();

        $make->ignore = ['create','edit','show','auth', 'store', 'remove-file', 'auto-route', 'translate', 'profile'];
        $routes = $make->load();
        $options=[];
        foreach ($routes as $route) {
            $options[$route] = $route;
        }
        unset($options['admin.']);
        return $options;
    }


    public static function save(){

        $permissions = self::make();

        foreach ($permissions as $permission) {

            if(!Permission::query()->where('slug', $permission)->count()){
                $permissionArr = explode(".", $permission);
                $last = \Arr::last($permissionArr);
                if(!in_array($last, ['edit','create','show'])){
                    $last = "index";
                }
                $name = str_replace(".", " ", \Illuminate\Support\Str::title($permission));
                Permission::factory()->create([
                    'name' => $name,
                    'slug' => $permission,
                    'group' => $last,
                    'status_id' => data_get(published(), 'status_id'),
                    'description' => $name
                ]);
            }
        }
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    private function load()
    {
        //$this->permission->slug_fixed = true;

        $options = [];

        foreach (\Route::getRoutes() as $route) {

            if (isset($route->action['as'])) :

                $data = explode(".", $route->action['as']);

                if ($this->getIgnore($data)) :

                    if ($this->getRequired($data)) :
                        if (!in_array($route->action['as'], $options)) {
                            array_push($options, $route->action['as']);
                        }
                    endif;

                endif;

            endif;
        }
        return $options;
    }

    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public static  function datalhes()
    {
       
        return \Route::getRoutes();
    }

    private function getIgnore($value)
    {

        $result = true;

        foreach ($this->ignore as $item) {

            if (in_array($item, $value)) {

                $result = false;
            }
        }

        return $result;
    }


    private function getRequired($value)
    {

        $result = false;

        foreach ($this->required as $item) {

            if (in_array($item, $value)) {

                $result = true;
            }
        }

        return $result;
    }

    public static function icons()
    {
        return [
            "activity",
            "airplay",
            "alert-circle",
            "alert-octagon",
            "alert-triangle",
            "align-center",
            "align-justify",
            "align-left",
            "align-right",
            "anchor",
            "archive",
            "at-sign",
            "award",
            "aperture",
            "bar-chart",
            "bar-chart-2",
            "battery",
            "battery-charging",
            "bell",
            "bell-off",
            "bluetooth",
            "book-open",
            "book",
            "bookmark",
            "box",
            "briefcase",
            "calendar",
            "camera",
            "cast",
            "circle",
            "clipboard",
            "clock",
            "cloud-drizzle",
            "cloud-lightning",
            "cloud-rain",
            "cloud-snow",
            "cloud",
            "codepen",
            "codesandbox",
            "code",
            "coffee",
            "columns",
            "command",
            "compass",
            "copy",
            "corner-down-left",
            "corner-down-right",
            "corner-left-down",
            "corner-left-up",
            "corner-right-down",
            "corner-right-up",
            "corner-up-left",
            "corner-up-right",
            "cpu",
            "credit-card",
            "crop",
            "crosshair",
            "database",
            "delete",
            "disc",
            "dollar-sign",
            "droplet",
            "edit",
            "edit-2",
            "edit-3",
            "eye",
            "eye-off",
            "external-link",
            "facebook",
            "fast-forward",
            "figma",
            "file-minus",
            "file-plus",
            "file-text",
            "film",
            "filter",
            "flag",
            "folder-minus",
            "folder-plus",
            "folder",
            "framer",
            "frown",
            "gift",
            "git-branch",
            "git-commit",
            "git-merge",
            "git-pull-request",
            "github",
            "gitlab",
            "globe",
            "hard-drive",
            "hash",
            "headphones",
            "heart",
            "help-circle",
            "hexagon",
            "home",
            "image",
            "inbox",
            "instagram",
            "key",
            "layers",
            "layout",
            "link",
            "link-2",
            "linkedin",
            "list",
            "lock",
            "log-in",
            "log-out",
            "mail",
            "map-pin",
            "map",
            "maximize",
            "maximize-2",
            "meh",
            "menu",
            "message-circle",
            "message-square",
            "mic-off",
            "mic",
            "minimize",
            "minimize-2",
            "minus",
            "monitor",
            "moon",
            "more-horizontal",
            "more-vertical",
            "mouse-pointer",
            "move",
            "music",
            "navigation",
            "navigation-2",
            "octagon",
            "package",
            "paperclip",
            "pause",
            "pause-circle",
            "pen-tool",
            "percent",
            "phone-call",
            "phone-forwarded",
            "phone-incoming",
            "phone-missed",
            "phone-off",
            "phone-outgoing",
            "phone",
            "play",
            "pie-chart",
            "play-circle",
            "plus",
            "plus-circle",
            "plus-square",
            "pocket",
            "power",
            "printer",
            "radio",
            "refresh-cw",
            "refresh-ccw",
            "repeat",
            "rewind",
            "rotate-ccw",
            "rotate-cw",
            "rss",
            "save",
            "scissors",
            "search",
            "send",
            "settings",
            "share-2",
            "shield",
            "shield-off",
            "shopping-bag",
            "shopping-cart",
            "shuffle",
            "skip-back",
            "skip-forward",
            "slack",
            "slash",
            "sliders",
            "smartphone",
            "smile",
            "speaker",
            "star",
            "stop-circle",
            "sun",
            "sunrise",
            "sunset",
            "tablet",
            "tag",
            "target",
            "terminal",
            "thermometer",
            "thumbs-down",
            "thumbs-up",
            "toggle-left",
            "toggle-right",
            "tool",
            "trash",
            "trash-2",
            "triangle",
            "truck",
            "tv",
            "twitch",
            "twitter",
            "type",
            "umbrella",
            "unlock",
            "user-check",
            "user-minus",
            "user-plus",
            "user-x",
            "user",
            "users",
            "video-off",
            "video",
            "voicemail",
            "volume",
            "volume-1",
            "volume-2",
            "volume-x",
            "watch",
            "wifi-off",
            "wifi",
            "wind",
            "x-circle",
            "x-octagon",
            "x-square",
            "x",
            "youtube",
            "zap-off",
            "zap",
            "zoom-in",
            "zoom-out",
        ];
    }
}
