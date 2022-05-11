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

use Blomstra\PostByMail\Event\EmailReceived;
use Blomstra\PostByMail\Jobs\Job;
use Blomstra\PostByMail\Jobs\ProcessReceivedEmail;
use Illuminate\Contracts\Queue\Queue;

class ReceivedEmailListener
{
    public function handle(EmailReceived $event): void
    {
        if (empty($event->messageUrl)) {
            return;
        }

        /** @var Queue */
        $queue = resolve('flarum.queue.connection');

        $queue->pushOn(Job::$onQueue, new ProcessReceivedEmail($event->messageUrl));
    }
}
