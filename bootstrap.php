<?php 
namespace c78\MediaEmbed;
use Flarum\Event\ConfigureFormatter;
use Illuminate\Events\Dispatcher;
use s9e\TextFormatter\Configurator\Bundles\MediaPack;

function subscribe(Dispatcher $events)
{
    $events->listen(
        ConfigureFormatter::class,
        function (ConfigureFormatter $event)
        {
            $event->configurator->Autoimage;
            $event->configurator->MediaEmbed->add(
                'music163',
                [
                    'host'    => 'music.163.com',
                    'extract' => "!music\\.163\\.com/#/song\\?id=(?'id'\\d+)!",
                    'iframe'  => [
                        'width'  => 450,
                        'height' => 86,
                        'src'    => '//music.163.com/outchain/player?type=2&id={@id}&auto=0&height=66'
                    ]
                ]
            );
            $event->configurator->MediaEmbed->add(
                'bilibili',
                [   
                    'host'    => 'www.bilibili.com',
                    'extract' => "!www.bilibili.com/video/av(?'id'\\d+)/!",
                    'flash'  => [
                        'width'  => 760,
                        'height' => 450,
                        'src'    => 'https://static-s.bilibili.com/miniloader.swf?aid={@id}'
                    ]
                ]
            );
             $event->configurator->MediaEmbed->add(
                'qq',
                [
                    'host'    => 'qq.com',
                    'extract' => [
                       "!qq\\.com/x/cover/\\w+/(?'id'\\w+)\\.html!",
                       "!qq\\.com/x/cover/\\w+\\.html\\?vid=(?'id'\\w+)!",
                       "!qq\\.com/cover/[^/]+/\\w+/(?'id'\\w+)\\.html!",
                       "!qq\\.com/cover/[^/]+/\\w+\\.html\\?vid=(?'id'\\w+)!",
                       "!qq\\.com/x/page/(?'id'\\w+)\\.html!",
                       "!qq\\.com/page/[^/]+/[^/]+/[^/]+/(?'id'\\w+)\\.html!"
                    ],
                    'iframe'  => [
                        'width'  => 760,
                        'height' => 450,
                        'src'    => '//v.qq.com/iframe/player.html?vid={@id}&tiny=0&auto=0'
                    ]
                ]
            );
            (new MediaPack)->configure($event->configurator);
        }
    );
};

return __NAMESPACE__ . '\\subscribe';
