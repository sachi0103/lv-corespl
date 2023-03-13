<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\CustomerPackage;
use DB;

class ExpirePlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expired plan remaining minutes will be set to zero';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            //code...
            $customer_package_list = CustomerPackage::where('remaining_minutes','!=',0)->where('expire_date',date('Y-m-d'))->get();
            if (!empty($customer_package_list)) {
                foreach ($customer_package_list as $key => $value) {
                    CustomerPackage::where('id','=',$value->id)->update(['remaining_minutes'=>0,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            } else {
                return false;
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
