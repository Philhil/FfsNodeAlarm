<?php

namespace App\Console\Commands;

use App\Models\Node;
use App\Models\Nodestat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
     * @return int
     */
    public function handle()
    {
        $path = env('FREIFUNKNODES_JSON_URL', 'https://netinfo.freifunk-stuttgart.de/json/nodes.json');
        $data = json_decode(file_get_contents($path), true);

        if(count($data) > 0 && isset($data['nodes']) && isset($data['meta']['timestamp'])) {

            foreach($data['nodes'] as $nodeArr){

                //find or new node
                $node = Node::firstOrNew(['mac' => $nodeArr['id']]);
                if ($node->name != $nodeArr['name'])
                {
                    $node->name = $nodeArr['name'];
                    $node->save();
                }

                //find or new  nodestats
                $nodestat = Nodestat::firstOrNew(['node_id' => $node->id]);
                $online = $nodeArr['flags']['online'] == "true" ? 1 : 0;

                if ($nodestat->isonline != $online || $nodestat->clientcount != $nodeArr['clientcount']) {
                    $nodestat->isonline = $online;
                    $nodestat->clientcount = $nodeArr['clientcount'];
                    $nodestat->save();
                }
            }
        } else {
            //Some problems with the JSON download -> inform admin
            Mail::raw("Fehler beim herunterladen der NodeJson!", function (Illuminate\Mail\Message $message) {
                $message->to(env('ADMIN_MAIL'))
                    ->subject("Fehler NodeAlarm");
            });
        }

        return Command::SUCCESS;
    }
}
