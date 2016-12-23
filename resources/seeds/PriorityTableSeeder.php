<?php

class PriorityTableSeeder extends Seeder {

  public function run()
  {
    DB::table('ticket_priority')->insert(
      ['name' => 'Urgent'],
      ['name' => 'High'],
      ['name' => 'Medium'],
      ['name' => 'Low'],
      ['name' => 'None']
    );
  }
}
