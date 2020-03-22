<?php


namespace App\Http\Controllers\admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;

class CustomController  extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function destroy($id)
    {
        // receive model name in use controller
        $model_name="App\\Model\\".$this->model;
        $row =$model_name::withTrashed()->findOrFail($id);
        if ($row->deleted_at==null)
        {
            $row->delete();
        }else
        {
            $row->forceDelete();
        }

        return redirect('c/a/'.$this->route_params.'?trashed=true')->with('message',"$this->title  انتخاب شده به سطل زباله انتقال یافت");
    }
    // this function for remove item in select check box
    public function remove_items(Request $request)
    {
        // receive model name in use controller
        $model_name="App\\Model\\".$this->model;
        $ids=$request->get('category_id',array());
        foreach($ids as $key=>$value)
        {
            $row=$model_name::withTrashed()->where('id',$value)->firstOrFail();
            if ($row->deleted_at==null)
            {
                $row->delete();
            }else
            {
                $row->forceDelete();
            }
        }
        return redirect('c/a/'.$this->route_params.'?trashed=true')->with('message',"حذف $this->title ها با موفقیت انجام شد");
    }
    //this function for restore items
    public function restore_items(Request $request)
    {
        // receive model name in use controller
        $model_name="App\\Model\\".$this->model;
        $ids=$request->get('category_id',array());
        foreach($ids as $key=>$value)
        {
            $row=$model_name::withTrashed()->where('id',$value)->firstOrFail();
            $row->restore();
        }
        return redirect('c/a/'.$this->route_params.'?trashed=true')->with('message',"بازیابی $this->title ها با موفقیت انجام شد");

    }
    // restore single item
    public function restore($id)
    {
        // receive model name in use controller
        $model_name="App\\Model\\".$this->model;
        $row=$model_name::withTrashed()->where('id',$id)->firstOrFail();
        $row->restore();
        return redirect('c/a/'.$this->route_params.'?trashed=true')->with('message',"بازیابی $this->title با موفقیت انجام شد");
    }
}
