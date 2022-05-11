<?php

/*
 * This file is part of blomstra/post-by-mail.
 *
 * Copyright (c) 2022 Blomstra Ltd.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\PostByMail\Listener;

use Flarum\Post\Event\Saving;
use Illuminate\Support\Arr;

class SavePostSourceToDatabase
{
    public function handle(Saving $event): void
    {
        $source = Arr::get($event->data, 'attributes.source');

        if ($source) {
            $event->post->source = $source;
        }
    }
}