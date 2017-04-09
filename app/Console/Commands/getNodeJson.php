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
        $data = json_decode(file_get_contents('https://netinfo.freifunk-stuttgart.de/json/nodes.json'), true);

        if(count($data) > 0 && isset($data['nodes']) && isset($data['meta']['timestamp'])) {

            foreach($data['nodes'] as $nodeArr){

                //find or new node
                $node = \App\Node::firstOrNew(['mac' => $nodeArr['id']]);
                if ($node->name != $nodeArr['name'])
                {
                    $node->name = $nodeArr['name'];
                    $node->save();
                }

                //find or new  nodestats
                $nodestat = \App\Nodestat::firstOrNew(['node_id' => $node->id]);
                $online = $nodeArr['flags']['online'] == "true" ? 1 : 0;

                if ($nodestat->isonline != $online || $nodestat->clientcount != $nodeArr['clientcount']) {
                    $nodestat->isonline = $online;
                    $nodestat->clientcount = $nodeArr['clientcount'];
                    $nodestat->save();
                }
            }
        } else {
            //TODO mail to admin -> json kaputt
        }
    }
}
