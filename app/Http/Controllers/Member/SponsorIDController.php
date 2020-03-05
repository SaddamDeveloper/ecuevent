<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class SponsorIDController extends Controller
{
    public function searchSponsorID(Request $request){
        if($request->ajax()){
            $output = '';
            $member_id = $request->get('query');
            if (!empty($member_id)) {
                $member_data = DB::table('members')->where('member_id', $member_id)->first();
                if ($member_data) {
                    $tree_data = DB::table('tree')->where('user_id', $member_data->id)->first();
                    return response()->json($tree_data->left_id);
                }else{
                    return 1;
                }
            } else {
                return 1;
            }
            
                

            /*$total_row = $data->count();
            if($total_row > 0){
                foreach ($data as $row) {
                    $output .= '
                    <table class="table table-striped well">
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>DOB</th>
                        </tr>
                        <tr>
                            <td>'.$row->name.'</td>
                            <td>'.$row->mobile.'</td>
                            <td>'.$row->dob.'</td>
                        </tr>                                
                    </table>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Lag*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="radio" name="gender" value="left">Left
                              <input type="radio" name="gender" value="right"> Right
                        </div>
                      </div>
                    ';
                }
            }

            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
               );
            
            echo json_encode($data);*/
        }
    }
}
