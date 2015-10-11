<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class getNodeJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getNodeJson';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the nodes Json and fill the Database with fresh data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = json_decode(file_get_contents('http://karte.freifunk-stuttgart.de/json/nodes.json'), true);

        if(count($data) > 0 && isset($data['nodes']) && isset($data['meta']['timestamp'])) {

            foreach($data['nodes'] as $nodeArr){

                //find or new node
                $node = \App\Node::firstOrNew(['mac' => $nodeArr['id']]);
                $node->name = $nodeArr['name'];
                $node->save();

                //find or new  nodestats
                $nodestat = \App\Nodestat::firstOrNew(['node_id' => $node->id]);
                $nodestat->isonline = $nodeArr['flags']['online'] == "true" ? 0 : 1;
                $nodestat->clientcount = $nodeArr['clientcount'];
                $nodestat->save();
            }
        } else {
            //TODO mail to admin -> json kaputt
        }
    }
}
