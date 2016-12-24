<?php

class StatusTableSeeder extends Seeder {

  public function run()
  {
    DB::table('ticket_status')->insert(
      ['name' => 'New'],
      ['name' => 'Updated'],
      ['name' => 'Pending Reply'],
      ['name' => 'Closed'],
      ['name' => 'None'],
      ['name' => 'Unknown']
    );
  }
}
``
