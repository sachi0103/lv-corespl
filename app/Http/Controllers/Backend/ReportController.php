<?php



namespace App\Http\Controllers\Backend;



use App\Http\Controllers\Controller;

use App\Models\CallLog;
use App\Models\User;

use Illuminate\Http\Request;



class ReportController extends Controller
{

    public function index(Request $request)
    {
        $filterData = [];
        $users = User::where('Parent',auth()->user()->id)->whereOr('id',auth()->user()->id)->get()->toArray();

        $usersIds = array_column($users,'id');

        $callLogsQuery = CallLog::query();
        $callLogsQuery->whereIn('user_id',$usersIds);
        if(!empty($request->all())) {
          $filterData = $request->all();

          if (!empty($filterData['user_id'])) {
            $callLogsQuery->where('user_id',$filterData['user_id']);
          }

          if(!empty($filterData['filter_date'])) {
            $callLogsQuery->where('date',date('Y-m-d',strtotime($filterData['filter_date'])));
          }
        }
        
        $callLogs = $callLogsQuery->get();

        return view('backend.reports.index', compact('callLogs','users','filterData'));

    }

}

