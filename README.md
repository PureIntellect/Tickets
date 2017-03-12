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

**1. Add the following to the providers array in `config\app.php` **

`PureIntellect\Tickets\TicketsServiceProvider::class,`

**2. Add the HTML snippets **

File: `resources/views/vendor/spark/kiosk.blade.php`

Place a link to the notifications settings tab:

```html
<!-- Tickets Link -->
<li role="presentation">
    <a href="#tickets" aria-controls="tickets" role="tab" data-toggle="tab">
        <i class="fa fa-fw fa-btn fa-ticket"></i>Tickets
    </a>
</li>
```

Inside the `<!-- Tab Panels -->` section, place the code to load the notifications tab:

```html
<!-- Ticket Management -->
<div role="tabpanel" class="tab-pane" id="tickets">
     @include('tickets::tickets')
</div>
```

**3. Publish the Spark resources (views, VueJS components):**

`php artisan vendor:publish --provider="PureIntellect\Notifications\NotificationsServiceProvider"`

**4. Add the javascript components to your bootstrap.js file**

Add `require('./spark-kiosk-tickets.js');` to your `resources/assets/js/components/bootstrap.js` file.

And then compile javascript components
`npm run production` or `npm run dev`

## Contributing

Please feel free to contribute. This project gets worked on in my spare time, so anyone who can help move it along is greatly appreciated.
