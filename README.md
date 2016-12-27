# Spark Tickets

Adds the ability to have a trouble ticket system integrated with Laravel Spark.

## Planned / Desired Features

* Users can submit tickets
* Users can comment on their tickets
* Staff can view tickets
* Staff can comment on tickets
* Notify submitter when ticket is commented on
* Internal/External Comments
	- Allows staff to make comments not visible to submitter


## Installation

This package is still in initial development. Feel free to contribute to speed up the process. These docs still need a lot of work.


```html
/*
 * Package Service Providers...
 */
      PureIntellect\Tickets\TicketsServiceProvider::class,


<!-- Tickets Link -->
<li role="presentation">
    <a href="#tickets" aria-controls="tickets" role="tab" data-toggle="tab">
        <i class="fa fa-fw fa-btn fa-ticket"></i>Tickets
    </a>
</li>

<!-- Ticket Management -->
<div role="tabpanel" class="tab-pane" id="tickets">
     @include('tickets::tickets')
</div>

require('./spark-kiosk-tickets');

php artisan vendor:publish --provider="PureIntellect\Tickets\TicketsServiceProvider"
```


## Contributing

Please feel free to contribute. This project gets worked on in my spare time, so anyone who can help move it along is greatly appreciated.
